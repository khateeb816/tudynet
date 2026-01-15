<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $query = User::query();

        if ($user->isManager()) {
            $query->whereIn('role', ['client', 'writer']);
        }

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = [];
        if (auth()->user()->isSuperAdmin()) {
            $roles = ['manager', 'writer'];
        } elseif (auth()->user()->isManager()) {
            $roles = ['writer'];
        }

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:manager,writer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'referral_code' => $this->generateUniqueReferralCode(),
            'status' => $request->role === 'writer' ? 'disabled' : 'active',
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => $user->status === 'active' ? 'disabled' : 'active',
        ]);

        return redirect()->back()->with('success', 'User status updated!');
    }

    private function generateUniqueReferralCode()
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }
}
