<?php

namespace App\Http\Controllers;

use App\Models\Book_Move;
use App\Http\Requests\StoreBook_MoveRequest;
use App\Http\Requests\UpdateBook_MoveRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\BookMove;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BookMoveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function update_rating(UpdateRatingRequest $request)
     {

        $move_id = BookMove::where('id', $request['history_id'])->first();

        if (!$move_id->return_date){
            throw new HttpResponseException(response([
                'error' => [
                    'message' => 'You have to return the book first.'
                ]
            ], 400));
        }

        $move_id->rate = $request['rate'];
        $move_id->save();

        return new JsonResponse([
            'data' => [ 
                'history' => $move_id,
                'message' => 'Rate has been added' 
            ],
            'error' => ''
        ]);

     }

}
