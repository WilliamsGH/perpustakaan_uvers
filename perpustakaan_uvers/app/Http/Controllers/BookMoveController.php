<?php

namespace App\Http\Controllers;

use App\Models\Book_Move;
use App\Http\Requests\StoreBook_MoveRequest;
use App\Http\Requests\UpdateBook_MoveRequest;

class BookMoveController extends Controller
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
     * @param  \App\Http\Requests\StoreBook_MoveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBook_MoveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book_Move  $book_Move
     * @return \Illuminate\Http\Response
     */
    public function show(Book_Move $book_Move)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book_Move  $book_Move
     * @return \Illuminate\Http\Response
     */
    public function edit(Book_Move $book_Move)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBook_MoveRequest  $request
     * @param  \App\Models\Book_Move  $book_Move
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBook_MoveRequest $request, Book_Move $book_Move)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book_Move  $book_Move
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book_Move $book_Move)
    {
        //
    }
}
