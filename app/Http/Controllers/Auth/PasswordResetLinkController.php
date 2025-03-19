<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class PasswordResetLinkController extends Controller
{
    /**
     * Show the password reset link request page.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('auth/forgot-password', [
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *Api Key
     *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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = User::where('email',$request->email)->firstorfail();
        $resetLink = url("/reset-password/".Password::createToken($user)."?email=".urlencode($user->email));
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => "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",
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/emailCampaigns',
        [
            'sender'=> ['name'=>'SogaDurojaiye','email'=>'durojaiyesoga@gmail.com'],
            'to'=> [['name'=> $user->name,'email'=>$user->email]],
            'subject'=> 'Password Reset Request',
            'htmlContent'=> "<h1> Click below link to reset your password</h1><a href='{$resetLink}'>Reset Password</a>",
        ]);
       return $response->successful()
       ? back()->with('status','A password reset link has been sent to your email')
       : back()->withErrors(['email'=>'Failed to Send the reset link']); 

    }
}
