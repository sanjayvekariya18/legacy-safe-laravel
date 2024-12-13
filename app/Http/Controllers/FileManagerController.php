 <?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use GuzzleHttp\Psr7\Request;
// use App\Http\Controllers\Controller;
// use App\Http\Requests\FileManagerRequest;
// use App\Http\Controllers\MessageController;
// use App\Repositories\FileManagerRepositories;
// use App\Repositories\FileManagerRepositoriesInterface;

// class FileManagerController extends Controller
// {
//     public function __construct(private FileManagerRepositories $filemanagerRepository , private MessageController $messageController)
//     {
//     }

//     public function show()
//     {
//         // $users = User::with('invitedBy')->get();
//         $users = User::query()->where('invited_by' , auth()->user()->id)->get();
//         return view('document.file_manager', compact('users'));
//     }


//     public function store(FileManagerRequest $request)
//     {
//         $data = $request->validated();

//         // Insert data using repository

//         $fileManage = $this->filemanagerRepository->create($data);

//         $responseMessage = $fileManage ? 'file Created Successfully!' : 'File not created.';

//         return $this->messageController->sendResponse($fileManage, $responseMessage);
//     }
// }


