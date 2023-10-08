<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Services\CountryService;
use App\Services\DepartmentService;
use App\Services\JobApplicationService;
use App\Services\JobService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobController extends Controller
{
    private JobService $jobService;
    private DepartmentService $departmentService;
    private JobApplicationService $jobApplicationService;
    private CountryService $countryService;

    public function __construct(
        JobService $jobService,
        DepartmentService $departmentService,
        JobApplicationService $jobApplicationService,
        CountryService $countryService
    )
    {
        $this->jobService = $jobService;
        $this->jobApplicationService = $jobApplicationService;
        $this->departmentService = $departmentService;
        $this->countryService = $countryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('job.index', [
            'jobs' => $this->jobService->all(),
            'jobApplicationsCount' => $this->jobApplicationService->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        return view('job.create', [
            'jobCategories' => $this->jobService->jobCategoryService->all(),
            'experienceLevels' => $this->jobService->experienceService->all(),
            'employmentTypes' => $this->jobService->employmentTypeService->all(),
            'departments' => $this->departmentService->all(),
            'countries' => $this->countryService->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage .
     *
     * @param StoreJobRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreJobRequest $request)
    {
        $this->jobService->create($request->validated());
        return redirect()->route('job')->with('success', 'Job created successfully');
    }

    public function show(string $id)
    {
        $job = $this->jobService->findById($id);

        return view('job.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return View
     */
    public function edit($id)
    {
        $job = $this->jobService->findById($id);

        return view('job.edit', [
            'job' => $job,
            'jobCategories' => $this->jobService->jobCategoryService->all(),
            'experienceLevels' => $this->jobService->experienceService->all(),
            'employmentTypes' => $this->jobService->employmentTypeService->all(),
            'departments' => $this->departmentService->all(),
            'countries' => $this->countryService->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreJobRequest $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(StoreJobRequest $request, $id)
    {
        $this->jobService->update($id, $request->validated());
        return redirect()->route('job')->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->jobService->delete($id);
        return redirect()->route('job')->with('success', 'Job deleted successfully');
    }

    public function showOpenJobs()
    {
        $jobs = $this->jobService->getOpenJobs();
        return view('job.job-open', ['jobs' => $jobs]);
    }
}
