<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Vehicle $vehicle)
    {
        $comment = new Comment();
        $comment->vehicle_id = $vehicle->id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        $comments = Comment::query()
            ->whereNull('parent_id')
            ->where('comments.vehicle_id', $vehicle->id)
            ->with('user')
            ->with('replies')
            ->orderBy('comments.created_at', 'desc')
            ->get();

        // echo 'ovde';
        // return redirect()->back();
        return view('comments.comments_section', ['comments' => $comments]);
    }

    public function reply(Request $request)
    {
        $parentComment = Comment::find($request->commentId);

        $comment = new Comment();
        $comment->vehicle_id = $parentComment->vehicle_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->commentId;
        $comment->comment = $request->reply;
        $comment->save();

        $comments = Comment::query()
            ->whereNull('parent_id')
            ->where('comments.vehicle_id', $parentComment->vehicle_id)
            ->with('user')
            ->with('replies')
            ->orderBy('comments.created_at', 'desc')
            ->get();

        return view('comments.comments_section', ['comments' => $comments]);
    }

    public function search(Request $request)
    {
        if (in_array($request->selectedValue, ['asc', 'desc'])) {
            $comments = Comment::query()
                ->whereNull('parent_id')
                ->where('comments.vehicle_id', $request->vehicleId)
                ->with('user')
                ->with('replies')
                ->orderBy('comments.created_at', $request->selectedValue)
                ->get();
        }
        return view('comments.comments_section', ['comments' => $comments]);
    }
}
