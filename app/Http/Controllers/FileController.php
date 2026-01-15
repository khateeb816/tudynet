<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function downloadOrderFile($orderId, $fileType)
    {
        $order = Order::findOrFail($orderId);
        $user = Auth::user();

        // Check access permissions
        $hasAccess = false;

        if ($user->isSuperAdmin() || $user->isManager()) {
            $hasAccess = true;
        } elseif ($user->isWriter() && $order->assigned_to === $user->id) {
            $hasAccess = true;
        } elseif ($user->isClient() && $order->created_by === $user->id) {
            // For clients, check visibility flags
            if ($fileType === 'half_file' && $order->half_file_visible) {
                $hasAccess = true;
            } elseif ($fileType === 'full_file' && $order->full_file_visible) {
                $hasAccess = true;
            } elseif (in_array($fileType, ['half_payment_image', 'full_payment_image', 'attachments'])) {
                // Clients can always see their own payment receipts and attachments
                $hasAccess = true;
            }
        }

        if (!$hasAccess) {
            abort(403, 'You do not have permission to access this file.');
        }

        // Get the file path based on type
        $filePath = null;
        switch ($fileType) {
            case 'half_file':
                $filePath = $order->half_file;
                break;
            case 'full_file':
                $filePath = $order->full_file;
                break;
            case 'half_payment_image':
                $filePath = $order->half_payment_image;
                break;
            case 'full_payment_image':
                $filePath = $order->full_payment_image;
                break;
            default:
                abort(404, 'File type not found.');
        }

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function downloadAttachment($orderId, $attachmentIndex)
    {
        $order = Order::findOrFail($orderId);
        $user = Auth::user();

        // Check access permissions
        $hasAccess = false;

        if ($user->isSuperAdmin() || $user->isManager()) {
            $hasAccess = true;
        } elseif ($user->isWriter() && $order->assigned_to === $user->id) {
            $hasAccess = true;
        } elseif ($user->isClient() && $order->created_by === $user->id) {
            $hasAccess = true;
        }

        if (!$hasAccess) {
            abort(403, 'You do not have permission to access this file.');
        }

        if (!$order->attachments || !isset($order->attachments[$attachmentIndex])) {
            abort(404, 'Attachment not found.');
        }

        $filePath = $order->attachments[$attachmentIndex];

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($filePath);
    }
}
