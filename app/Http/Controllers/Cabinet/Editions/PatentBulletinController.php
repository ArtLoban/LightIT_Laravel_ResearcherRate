<?php

namespace App\Http\Controllers\Cabinet\Editions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatentBulletinController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());

        return redirect()->back()->with('status', 'The new patent bulletin publication is added!');
    }
}