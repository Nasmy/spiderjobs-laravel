<?php

namespace App\Http\Controllers;


use App\Http\Requests\JobCategoryRequest;
use App\Services\JobCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class JobCategoryController extends Controller
{

    public $jobCategoryService;

    public function __construct(JobCategoryService $jobCategoryService)
    {
        $this->jobCategoryService = $jobCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('job.job-category',['jobCatList'=>$this->jobCategoryService->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
       return view('job.job-category-create',['jobCatList' => $this->jobCategoryService->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JobCategoryRequest $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(JobCategoryRequest $request)
    {
        $request->validated();
        $this->jobCategoryService->createOrUpdate($request->all());
        return redirect()->route('job-category')->with('success', 'Job created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $jobcatid
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('job.job-category-edit',[
            'jobCat' => $this->jobCategoryService->findById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        return $this->jobCategoryService->createOrUpdate($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->jobCategoryService->delete($id);
        return redirect()->route('job-category')->with('success', 'Job created successfully');
    }
}
