<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login'); // Create this view to show login form
    }

    /**
     * Handle a login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            // Authentication passed
            $userId = Auth::user()->id; // Get the authenticated user's ID

            // Check if the user has already voted
            $hasVoted = \DB::table('votes') // Assuming your table is named 'votes'
                ->where('user_id', $userId) // Assuming 'user_id' is the column for user in votes table
                ->exists(); // Check if any record exists

            if ($hasVoted) {
                // If the user has already voted, redirect to already_vote page
                return redirect()->route('already_vote');
            } else {
                // If the user has not voted, redirect to the vote page
                return redirect()->route('vote', ['id' => $userId]);
            }
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username')); // Retain the username in case of error
    }

    /**
     * Log the user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
