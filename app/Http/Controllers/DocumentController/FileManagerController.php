<?php

namespace App\Http\Controllers\DocumentController;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileManagerRequest;
use App\Repositories\FileManagerRepositoriesInterface;

class FileManagerController extends Controller
{
    protected $filemanagerRepository;

    public function __construct(FileManagerRepositoriesInterface $filemanagerRepository)
    {
        $this->filemanagerRepository = $filemanagerRepository;
    }

    public function create()
    {
        return view('Document.file_manager');
    }

    public function store(FileManagerRequest $request)
    {
        $data = $request->all();

        // Insert data using repository
        $fileManage = $this->filemanagerRepository->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile Created Successfully!',
            'filemanage' => $fileManage
        ]);
    }
}
