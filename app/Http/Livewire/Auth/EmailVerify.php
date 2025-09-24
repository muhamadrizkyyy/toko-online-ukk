<?php

namespace App\Http\Livewire\Auth;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailVerify extends Component
{
    public function mount()
    {
        if (auth()->check() && Auth::user()->email_verified_at != null) {
            return redirect()->route('home');
        }
    }

    public function render()
    {
        return view('livewire.auth.email-verify')->layout('layouts.auth');
    }

    public function verifyHandler(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route("home");
    }

    public function resendVerificationLink(Request $request)
    {
        dd($request);
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }
}
