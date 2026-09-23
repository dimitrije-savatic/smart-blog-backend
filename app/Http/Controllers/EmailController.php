<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Mail\ContactFromMail;
use Brick\Math\Exception\MathException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

class EmailController extends Controller
{
    protected array $emailRules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'message' => 'required|string'
    ];

    public function sendEmail(Request $request)
    {
        $data = validate($request, $this->emailRules);
        try {
            Mail::to($data['email'])->send(new ContactFromMail($data));
            return response()->json([], 200);
        }catch (\Throwable $e) {
            throw new ApiException('MAIL_SEND_FAILED', $e->getMessage(), 500);
        }
    }
}
