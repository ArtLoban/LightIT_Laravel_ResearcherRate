<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Profile\UpdateRequest;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;
use App\Services\Users\User\Repository\Contracts\Repository as UserRepository;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
     * Show the application main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Auth::loginUsingId(4);
        $user = $this->userRepository->getWithRelations(Auth::id(), ['role', 'profile']);

        return view('cabinet.profile', ['user' => $user]);
    }

    /**
     * @param UpdateRequest $request
     * @param DataTransformer $transformer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, DataTransformer $transformer)
    {
        $transformedData = $transformer->transform($request->input());
        $this->userRepository->updateById($request->user()->getKey(), $transformedData);

        return redirect()->back()->with('status', 'Profile updated!');
    }
}
