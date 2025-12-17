<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewVote;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function toggleHelpful($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $review = Review::findOrFail($id);
        $userId = Auth::id();

        $vote = ReviewVote::where('user_id', $userId)
                          ->where('review_id', $id)
                          ->first();

        if ($vote) {
            $vote->delete();
            $message = 'Vote removed';
        } else {
            ReviewVote::create([
                'user_id' => $userId,
                'review_id' => $id
            ]);
            $message = 'Marked as helpful';
        }

        return redirect()->back()->with('success', $message);
    }
}
