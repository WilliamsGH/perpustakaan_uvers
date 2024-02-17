<?php

namespace App\Http\Controllers;

use App\Models\major;
use App\Http\Requests\StoremajorRequest;
use App\Http\Requests\UpdatemajorRequest;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoremajorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoremajorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(major $major)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemajorRequest  $request
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatemajorRequest $request, major $major)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(major $major)
    {
        //
    }
}
