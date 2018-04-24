<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => Auth::id(),
            'comment' => $request->input('comment')
        ]);
        if ($comment->ticket->user->id !== Auth::id()) {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }
        return redirect()->back()->with('status', 'Your comment has been submitted.');
    }
}
