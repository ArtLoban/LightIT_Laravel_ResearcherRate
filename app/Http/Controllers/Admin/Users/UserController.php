<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\User\StoreRequest;
use App\Http\Requests\Admin\Users\User\UpdateRequest;
use App\Services\Users\Role\Repository\Contracts\Repository as RoleRepository;
use App\Services\Users\User\Repository\Contracts\Repository as UserRepository;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', ['users' => $this->userRepository->allWithRelations(['role', 'profile'])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RoleRepository $roleRepository)
    {
        return view('admin.users.create', ['roles' => $roleRepository->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->userRepository->create($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $userWithRelations = $this->userRepository->getWithNestedRelationsById($user->getKey());

        return view('admin.users.show', ['user' => $userWithRelations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, RoleRepository $roleRepository)
    {
        return view('admin.users.edit', ['user' => $user, 'roles' => $roleRepository->all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user, DataTransformer $transformer)
    {
        $transformedData = $transformer->transform($request->input());
        $this->userRepository->updateById($user->getKey(), $transformedData);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user);

        return back();
    }
}
