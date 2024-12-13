<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MessageController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => (bool) $result,
            'message' => $message,
        ];

        return redirect()->back()->with($response['success'] ? 'success' : 'error', $message);
    }






}


