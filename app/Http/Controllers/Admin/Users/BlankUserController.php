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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blank_users.index', [ 'blankUsers' =>  $this->blankUserRepository->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BlankUser $blankUser)
    {
        return view('admin.blank_users.show', ['blankUser' => $blankUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
