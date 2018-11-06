<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use App\Services\Users\User\Repository\Contracts\Repository as UserRepository;

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
