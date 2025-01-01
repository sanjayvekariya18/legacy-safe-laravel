<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FileManagerController extends Controller
{
    public function index()
    {
        return view('file_manager.index', ['csrf_token' => csrf_token()]);
    }
}
