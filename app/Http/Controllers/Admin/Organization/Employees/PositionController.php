<?php

namespace App\Http\Controllers\Admin\Organization\Employees;

use App\Http\Requests\Admin\Organization\Employees\Position\StoreRequest;
use App\Http\Requests\Admin\Organization\Employees\Position\UpdateRequest;
use App\Models\Organization\Employees\Position;
use App\Http\Controllers\Controller;
use App\Services\Organization\Employees\Position\Repository\Contracts\Repository as PositionRepository;

class PositionController extends Controller
{
    /**
     * @var PositionRepository
     */
    private $positionRepository;

    /**
     * PositionController constructor.
     * @param PositionRepository $positionRepository
     */
    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.positions.index', ['positions' => $this->positionRepository->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->positionRepository->create($request->all());

        return redirect()->route('positions.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('admin.positions.edit', ['position' => $position]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Position $position)
    {
        $this->positionRepository->updateById($position->getKey(), $request->input());

        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $this->positionRepository->delete($position);

        return back();
    }
}
