<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'comment' => 'required|string',
        ]);

        Review::create([
            'order_id' => $request->order_id,
            'comment' => $request->comment,
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}
