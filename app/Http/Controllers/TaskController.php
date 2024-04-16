<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index()
    {
        $user = $user = Auth::user();
        // dd($user->id);

        $tasks = Task::where('user_id', $user->id)->get(); // Fetch all users
        // dd($tasks);
        return view('task.index', compact('tasks', 'user'));
    }

    public function create()
    {
        $users = User::all(); // Fetch all users
        return view('task.add', compact('users'));
    }


    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:open,in_progress,completed',
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $task = new Task();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        // dd($task);
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('task_files'), $fileName);
            // dd($file);

        } else {
            return "No file uploaded!";
        }
        // $attachment = $request->file('file');

        // if ($attachment) {
        //     $name    = $attachment->getClientOriginalName();
        //     $type    = $attachment->getClientMimeType();
        //     $size    = $attachment->getSize();
        //     $tmpName = $attachment->getPathname();
        //     $error   = $attachment->getError();

        //     if ($name != '' && $error == 0) {
        //         $array        =  explode('.', $name);
        //         $fileExt      =  end($array);
        //         $current_time =  now()->format('Y_m_d');
        //         $newfile      =  "task_" . $current_time . "." . $fileExt;
        //         $tempFile     =  $tmpName;
        //         $targetPath   =  'uploads/task_files/';
        //         $targetFile   =  $targetPath . $newfile;

        //         // Move the uploaded file to the target directory
        //         $attachment->move($targetPath, $newfile);

        //         // Optionally, you can store the file information in the database here
        //     }
        // }
        // dd($file);

        $task->file = $fileName;

        $task->save();
        return view('dashboard');
    }


    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        return view('task.show', compact('task', 'users'));
    }


    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::all(); // Fetch all users

        // dd($task);
        return view('task.edit', compact('task', 'users'));
    }


    public function update(Request $request, string $id)
    {
        // dd($request);
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:open,in progress,completed',
        ]);

        // Find the task
        $task = Task::findOrFail($id);
        // dd($task);
        // Update the task with the request data
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        $task->status = $request->status;

        $task->save();

        // Redirect with success message
        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }



    public function destroy(string $id)
    {
    }
}
