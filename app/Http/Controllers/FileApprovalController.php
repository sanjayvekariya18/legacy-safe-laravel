<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FileApprovalRepository;

class FileApprovalController extends Controller
{
    public function __construct(private FileApprovalRepository $fileApprovalRepository, private MessageController $messageController)
    {
    }


    // public function index()
    // {
    //     $fileApprovals = $this->FileApprovalRepository->getUsersWithPermissions();
    //     dd($fileApprovals);
    //     return view('document.document_view', compact('fileApprovals'));
    // }


    // public function updatePermissions(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'to_be_notified' => 'required|boolean',
    //         'to_be_visible' => 'required|boolean',
    //     ]);

    //     $this->FileApprovalRepository->updatePermissions($id, $validated);

    //     return redirect()->back()->with('success', 'Permissions updated successfully.');
    // }

}

