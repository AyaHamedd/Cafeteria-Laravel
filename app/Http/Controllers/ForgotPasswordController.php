<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        //create forgor password class
        // $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'message'=>'Email sent',
            'response'=>$response
        ], 200);
        // return $request->wantsJson()
        //             ? new JsonResponse(['message' => trans($response)], 200)
        //             : back()->with('status', trans($response));
    }
    
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'message'=>'Failed to send email',
            'response'=>$response
        ], 500);
        // if ($request->wantsJson()) {
        //     throw ValidationException::withMessages([
        //         'email' => [trans($response)],
        //     ]);
        // }

        // return back()
        //         ->withInput($request->only('email'))
        //         ->withErrors(['email' => trans($response)]);
    }
}
