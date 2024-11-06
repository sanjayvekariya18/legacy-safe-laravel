<?php

namespace App\Http\Controllers;

use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $breadcrumbs;

    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));

        return view('dashboard', [
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }
}
