<?php

namespace App\Http\Controllers;
use App\Repositories\DocumentRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private DocumentRepository $documentRepository)
    {
    }

    public function index(Request $request){
        $documents = $this->documentRepository->index();

        return view('dashboard',compact('documents'));
    }


}
