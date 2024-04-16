<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    public function index(){
        $comments = comment::all(); // Fetch all users
        // dd($comments);
        return view('comment.index', compact('comments'));
    }

    public function create(){

        return view('comment.add');

    }

    public function store(Request $request){

        $request->validate([
            'description' => 'required|string',
        ]);


        $user = Auth::user();
        $comment = new Comment();
        $comment->content = $request->description;
        $comment->user_id = $user->id;
        $comment->task_id  = $request->task_id;
        $comment->save();
        return redirect()->route('comment.index');

        // return redirect()->back()->with('success', 'Comment added successfully');

        // dd($request);

    }

    public function show(string $id)
    {
        $comment = Comment::findOrFail($id);
        // dd($comment);
        $users = User::all();
        return view('comment.show', compact('comment'));
    }


    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);

        // dd($comment);
        return view('comment.edit', compact('comment'));
    }


    public function update(Request $request, string $id)
    {
        // dd($request);
        // Validate the request data
        $request->validate([
            'content' => 'required|string',
        ]);
        $c = Comment::findOrFail($id);
        $c->content = $request->content;
        $c->save();

        // dd($c);


        return redirect()->route('comment.index')->with('success', 'Comment updated successfully.');
    }




}
