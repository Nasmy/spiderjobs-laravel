<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationRequest;
use App\Services\ConfigurationService;
use App\Services\CountryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ConfigurationController extends Controller
{
    public $configurationService;
    public $countryService;

    public function __construct(ConfigurationService $configurationService,CountryService $countryService)
    {
        $this->configurationService = $configurationService;
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ConfigurationRequest $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(ConfigurationRequest $request)
    {
        $request->validated();
        return $this->configurationService->createOrUpdate($request->except('_token'));
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
     * @return Application|Factory|View
     */
    public function edit()
    {
        $configList = $this->configurationService->all();
        $countryList = $this->countryService->all();
        return view('config.create',['configList' => $configList,'countryList' => $countryList,'configService'=>$this->configurationService]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConfigurationRequest $request
     * @param null $id
     * @return RedirectResponse
     */
    public function update(ConfigurationRequest $request, $id = null): RedirectResponse
    {
        $request->validated();
        $this->configurationService->createOrUpdate($request->except('_token'));
        return redirect()->route('configuration-update')->with('success', 'configuration update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

 }
