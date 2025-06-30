<?php

namespace App\Http\Controllers;

use App\Mail\ContactFromMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        try {
            Mail::to('smart.blog@example.com')->send(new ContactFromMail($data));
            return response()->json(['message' => 'Email sent successfully'], 200);
        }catch (\Exception $e) {
            return response()->json(['message'=>'Email could not be sent', 'error' => $e->getMessage()], 500);
        }
    }
}
