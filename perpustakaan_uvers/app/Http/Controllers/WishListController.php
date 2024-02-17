<?php

namespace App\Http\Controllers;

use App\Models\Wish_List;
use App\Http\Requests\StoreWish_ListRequest;
use App\Http\Requests\UpdateWish_ListRequest;

class WishListController extends Controller
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
     * @param  \App\Http\Requests\StoreWish_ListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWish_ListRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wish_List  $wish_List
     * @return \Illuminate\Http\Response
     */
    public function show(Wish_List $wish_List)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wish_List  $wish_List
     * @return \Illuminate\Http\Response
     */
    public function edit(Wish_List $wish_List)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWish_ListRequest  $request
     * @param  \App\Models\Wish_List  $wish_List
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWish_ListRequest $request, Wish_List $wish_List)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wish_List  $wish_List
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wish_List $wish_List)
    {
        //
    }
}
