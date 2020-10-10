<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'password_old' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Hash::check($request->password_old, $request->user()->password)) {

            $request->user()->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'success',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Update password failed.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
