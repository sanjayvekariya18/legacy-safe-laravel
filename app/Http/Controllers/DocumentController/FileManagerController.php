<?php

namespace App\Http\Controllers\DocumentController;

use App\Http\Controllers\Controller;
use App\Repositories\FileManagerRepositoriesInterface;

class FileManagerController extends Controller
{

    public function create()
    {
        return view('file_manager.index');
    }

}
