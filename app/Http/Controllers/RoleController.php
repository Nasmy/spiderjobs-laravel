<?php
/**
 * @name RoleController
 *
 * @author M N N Ahamed
 */
namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RoleController extends Controller
{
    public $roleService;
    public $permissionService;
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleList = $this->roleService->all();
        return view('role.index',['roleLists'=>$roleList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionList= $this->permissionService->findByGroup(PermissionService::PERMISSION_GROUP_KEY_PARENT);
        return view('role.create',['permissionList' => $permissionList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(RoleRequest $request)
    {
        $request->validated();
        return $this->roleService->createOrUpdate($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $role = $this->roleService->findById($id);
        $permissionList= $this->permissionService->findByGroup(PermissionService::PERMISSION_GROUP_KEY_PARENT);

        return view('role.edit',[
            'role' => $role,
            'permissionList' => $permissionList
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $this->roleService->createOrUpdate($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->roleService->delete($id);
        return back();
    }
}
