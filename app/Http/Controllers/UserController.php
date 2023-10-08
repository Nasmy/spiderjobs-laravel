<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\DepartmentService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;
    private RoleService $roleService;
    private DepartmentService $departmentService;

    public function __construct(
        UserService $userService,
        RoleService $roleService,
        DepartmentService $departmentService
    )
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->departmentService = $departmentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('user.index',[
            'userList' => $this->userService->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('user.create', [
            'roles' => $this->roleService->all(),
            'departments' => $this->departmentService->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();
        $this->userService->create($request->all());
        return redirect()->route('user')->with('success', 'User created successfully');
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
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('user.edit',[
            'user' => $this->userService->findById($id),
            'roles' => $this->roleService->all(),
            'departments' => $this->departmentService->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return RedirectResponse|Response
     */
    public function update(Request $request, $id)
    {
        $this->userService->update($id, $request->all());
        return redirect()->route('user')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        $this->userService->delete($id);
        return redirect()->route('user')->with('success', 'User deleted successfully');
    }
}
