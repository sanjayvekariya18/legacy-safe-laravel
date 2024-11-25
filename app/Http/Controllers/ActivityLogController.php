<?php

namespace App\Http\Controllers;

use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    protected $breadcrumbs;

    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Activity Log', route('activity.logs'));

        // Get the search query
        $search = $request->input('search');

        // Query activity logs
        $logs = Activity::query()
            ->when($search, function ($query, $search) {
                // Search in relevant columns (description, causer, subject)
                $query
                    ->where('description', 'like', "%{$search}%")
                    ->orWhereHas(
                        'causer',
                        function ($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    }
                    )
                    ->orWhere('subject_type', 'like', "%{$search}%")
                    ->orWhere('subject_id', 'like', "%{$search}%");
            })
            ->with('causer', 'subject') // Eager load relationships
            ->latest()
            ->paginate(50); // Paginate results

        return view('activity.log', [
            'breadcrumbs' => $this->breadcrumbs->get(),
            'logs' => $logs,
        ]);
    }
}
