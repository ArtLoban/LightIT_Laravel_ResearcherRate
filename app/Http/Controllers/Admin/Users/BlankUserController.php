<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Models\Users\BlankUser;
use App\Http\Controllers\Controller;
use App\Services\Users\BlankUser\Repository\Contracts\Repository as BlankUserRepository;

class BlankUserController extends Controller
{
    /**
     * @var BlankUserRepository
     */
    private $blankUserRepository;

    /**
     * BlankUserController constructor.
     * @param BlankUserRepository $blankUserRepository
     */
    public function __construct(BlankUserRepository $blankUserRepository)
    {
        $this->blankUserRepository = $blankUserRepository;
    }


    public function index()
    {
        return view('admin.blank_users.index', [ 'blankUsers' =>  $this->blankUserRepository->all()]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(BlankUser $blankUser)
    {
        return view('admin.blank_users.show', ['blankUser' => $blankUser]);
    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        //
    }


    /**
     * @param BlankUser $blankUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BlankUser $blankUser)
    {
        $this->blankUserRepository->delete($blankUser);

        return back();
    }
}
