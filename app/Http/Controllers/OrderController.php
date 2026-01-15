<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Subject;
use App\Models\OrderStatus;
use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Order::with(['subject', 'creator', 'assignedWriter']);

        if ($user->isClient()) {
            $query->where('created_by', $user->id);
        } elseif ($user->isWriter()) {
            $query->where('assigned_to', $user->id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(15);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $wordOptions = [250, 500, 750, 1000, 1250, 1500, 1750, 2000, 2500, 3000];
        return view('orders.create', compact('subjects', 'wordOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expiry_date' => 'required|date|after:today',
            'words' => 'required|in:250,500,750,1000,1250,1500,1750,2000,2500,3000',
            'description' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,mp4|max:10240',
        ]);

        $pricePerWord = Setting::getValue('price_per_word', 0.10);
        $totalAmount = $request->words * $pricePerWord;

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('orders/attachments', 'public');
                $attachments[] = $path;
            }
        }

        $order = Order::create([
            'expiry_date' => $request->expiry_date,
            'words' => $request->words,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'total_amount' => $totalAmount,
            'attachments' => $attachments,
            'status' => 'pending',
            'created_by' => Auth::id(),
        ]);

        OrderStatus::create([
            'order_id' => $order->id,
            'status' => 'pending',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order created successfully!');
    }

    public function show($id)
    {
        $order = Order::with(['subject', 'creator', 'assignedWriter', 'statusHistory.createdBy', 'reviews.createdBy'])
            ->findOrFail($id);

        $user = Auth::user();

        // Check access
        if ($user->isClient() && $order->created_by !== $user->id) {
            abort(403);
        }
        if ($user->isWriter() && $order->assigned_to !== $user->id) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function uploadHalfPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->created_by !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'half_payment_image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('half_payment_image')) {
            $path = $request->file('half_payment_image')->store('orders/payments', 'public');
            $order->update([
                'half_payment_image' => $path,
                'status' => 'half_payment_uploaded',
            ]);

            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'half_payment_uploaded',
                'created_by' => Auth::id(),
            ]);

            // Notify managers and super admins
            $this->notifyManagers($order, 'Half payment uploaded for order #' . $order->id);
        }

        return redirect()->back()->with('success', 'Half payment uploaded successfully!');
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if (!$user->isManager() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $order->update(['status' => 'approved']);

        OrderStatus::create([
            'order_id' => $order->id,
            'status' => 'approved',
            'created_by' => Auth::id(),
        ]);

        $this->notifyUser($order->creator, $order, 'Your order #' . $order->id . ' has been approved.');

        return redirect()->back()->with('success', 'Order approved successfully!');
    }

    public function assignWriter(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if (!$user->isManager() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $request->validate([
            'writer_id' => 'required|exists:users,id',
        ]);

        $order->update([
            'assigned_to' => $request->writer_id,
            'status' => 'assigned_to_writer',
        ]);

        OrderStatus::create([
            'order_id' => $order->id,
            'status' => 'assigned_to_writer',
            'created_by' => Auth::id(),
        ]);

        $writer = \App\Models\User::find($request->writer_id);
        $this->notifyUser($writer, $order, 'You have been assigned to order #' . $order->id);

        return redirect()->back()->with('success', 'Writer assigned successfully!');
    }

    public function uploadHalfFile(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->assigned_to !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'half_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('half_file')) {
            $path = $request->file('half_file')->store('orders/files', 'public');
            $order->update([
                'half_file' => $path,
                'status' => 'half_file_uploaded',
            ]);

            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'half_file_uploaded',
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->back()->with('success', 'Half file uploaded successfully!');
    }

    public function uploadFullFile(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->assigned_to !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'full_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('full_file')) {
            $path = $request->file('full_file')->store('orders/files', 'public');
            $order->update([
                'full_file' => $path,
                'status' => 'full_file_uploaded',
            ]);

            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'full_file_uploaded',
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->back()->with('success', 'Full file uploaded successfully!');
    }

    public function markCompleted($id)
    {
        $order = Order::findOrFail($id);

        if ($order->assigned_to !== Auth::id()) {
            abort(403);
        }

        $order->update(['status' => 'completed']);

        OrderStatus::create([
            'order_id' => $order->id,
            'status' => 'completed',
            'created_by' => Auth::id(),
        ]);

        $this->notifyManagers($order, 'Order #' . $order->id . ' has been completed.');

        return redirect()->back()->with('success', 'Order marked as completed!');
    }

    public function toggleHalfFileVisibility($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if (!$user->isManager() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $order->update([
            'half_file_visible' => !$order->half_file_visible,
        ]);

        if ($order->half_file_visible) {
            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'half_file_visible',
                'created_by' => Auth::id(),
            ]);
            $this->notifyUser($order->creator, $order, 'You can now view the half file for order #' . $order->id);
            $message = 'Half file is now visible to client!';
        } else {
            $message = 'Half file is now hidden from client!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function toggleFullFileVisibility($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if (!$user->isManager() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $order->update([
            'full_file_visible' => !$order->full_file_visible,
        ]);

        if ($order->full_file_visible) {
            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'full_file_visible',
                'created_by' => Auth::id(),
            ]);
            $this->notifyUser($order->creator, $order, 'You can now view the full file for order #' . $order->id);
            $message = 'Full file is now visible to client!';
        } else {
            $message = 'Full file is now hidden from client!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function uploadFullPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->created_by !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'full_payment_image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('full_payment_image')) {
            $path = $request->file('full_payment_image')->store('orders/payments', 'public');
            $order->update([
                'full_payment_image' => $path,
                'status' => 'full_payment_uploaded',
            ]);

            OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'full_payment_uploaded',
                'created_by' => Auth::id(),
            ]);

            $this->notifyManagers($order, 'Full payment uploaded for order #' . $order->id);
        }

        return redirect()->back()->with('success', 'Full payment uploaded successfully!');
    }

    public function verifyFullPayment($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if (!$user->isManager() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $order->update([
            'status' => 'full_payment_verified',
            'full_file_visible' => true,
        ]);

        OrderStatus::create([
            'order_id' => $order->id,
            'status' => 'full_payment_verified',
            'created_by' => Auth::id(),
        ]);

        // Process referral reward if applicable
        $this->processReferralReward($order);

        $this->notifyUser($order->creator, $order, 'Full payment verified for order #' . $order->id . '. You can now access complete files.');

        return redirect()->back()->with('success', 'Full payment verified! Full file is now visible to client.');
    }

    private function notifyManagers($order, $message)
    {
        $managers = \App\Models\User::whereIn('role', ['manager', 'super_admin'])->get();

        foreach ($managers as $manager) {
            Notification::create([
                'order_id' => $order->id,
                'message' => $message,
                'by' => Auth::id(),
                'to' => $manager->id,
            ]);
        }
    }

    private function notifyUser($user, $order, $message)
    {
        Notification::create([
            'order_id' => $order->id,
            'message' => $message,
            'by' => Auth::id(),
            'to' => $user->id,
        ]);
    }

    private function processReferralReward($order)
    {
        $client = $order->creator;

        if ($client->referred_by) {
            $rewardAmount = Setting::getValue('referral_reward_amount', 10.00);

            \App\Models\Referral::create([
                'referrer_id' => $client->referred_by,
                'referred_user_id' => $client->id,
                'order_id' => $order->id,
                'reward_amount' => $rewardAmount,
                'status' => 'pending',
            ]);
        }
    }
}
