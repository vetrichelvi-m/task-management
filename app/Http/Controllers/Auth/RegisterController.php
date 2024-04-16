<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;


class RegisterController extends Controller
{


    public function create()
    {

        // echo"hii";
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // dd($request);
        // Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        // dd($user);

        $user->save();
        return redirect()->route('auth.login');
    }

    public function login()
    {

        // echo"hii";
        return view('auth.login');
    }

    public function loginaction(Request $request)
    {
        // dd($request);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            $user = Auth::user(); // Retrieve the authenticated user
            $tasks = Task::where('user_id', $user->id)->get();

            // dd($tasks );// Fetch all users

            return view('dashboard', compact('tasks'));

            return "Welcome, {$user->name}!";
        } else {
            // Authentication failed
            return "Invalid credentials. Please try again.";
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $users = User::where('id', $user->id)->get();
        // dd($users);
        return view('dashboard', compact('users'));
    }

    public function logout()
    {
        Auth::logout(); // Log out the currently authenticated user
        return redirect()->route('auth.login')->with('status', 'Logged out successfully');
    }
}
