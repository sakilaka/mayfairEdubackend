<?php

namespace App\Http\Controllers\Backend\Expo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationCustom;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ExpoCaptchaController extends Controller
{
    public function generateCaptcha()
    {
        // $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $characters = '0123456789';
        $fontFile = public_path('fonts/captcha.ttf');
        $padding = 10;
        $maxWidth = 200;
        $maxHeight = 50;
        $maxCharacters = 4;

        $captchaCode = substr(str_shuffle($characters), 0, rand(4, $maxCharacters));
        Session::put('captcha', $captchaCode);

        $fontSize = 16;
        $boundingBox = imagettfbbox($fontSize, 0, $fontFile, $captchaCode);
        $width = abs($boundingBox[2] - $boundingBox[0]) + $padding * 2;
        $height = abs($boundingBox[1] - $boundingBox[7]) + $padding * 2;

        while ($width > $maxWidth && $fontSize > 10) {
            $fontSize--;
            $boundingBox = imagettfbbox($fontSize, 0, $fontFile, $captchaCode);
            $width = abs($boundingBox[2] - $boundingBox[0]) + $padding * 2;
            $height = abs($boundingBox[1] - $boundingBox[7]) + $padding * 2;
        }

        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

        $x = $padding;
        $y = $height - $padding;

        for ($i = 0; $i < strlen($captchaCode); $i++) {
            $angle = rand(-15, 15);
            imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $fontFile, $captchaCode[$i]);
            $x += ($width - $padding * 2) / strlen($captchaCode);
        }

        header("Content-type: image/png");
        imagepng($image);
        imagedestroy($image);
    }

    public function verifyCaptcha(Request $request)
    {
        if ($request->input('captcha') == session('captcha')) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false, 'message' => 'Invalid CAPTCHA']);
        }
    }

    public function sendVerificationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $verification_code = rand(10000, 99999);

        $data = [
            'subject' => 'Email Verification',
            'email' => $request->input('email'),
            'verification_code' => $verification_code,
        ];

        try {
            // Send the verification email
            Mail::to($data['email'])->send(new EmailVerificationCustom($data));
            session(['verification_code' => $verification_code]);

            return response()->json(['success' => true, 'message' => 'Verification email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send verification email. Please try again later.']);
        }
    }

    public function verifyCode(Request $request)
    {
        if ($request->input('verification_code') == session('verification_code')) {
            return response()->json(['success' => true, 'message' => 'Verification code is correct']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid verification code']);
        }
    }
}
