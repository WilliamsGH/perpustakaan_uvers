<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWishListRequest;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\DeleteWishListRequest;
use App\Http\Requests\ReturnBookRequest;
use App\Models\Book;
use App\Models\BookMove;
use App\Models\WishList;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get_user_info()
    {
        $user = Auth::user();

        return new JsonResponse([
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->email,
                'major' => $user->major->name,
                'generation' => $user->generation,
            ],
            'error' => ''
        ]);
    }

    public function get_wish_list()
    {
        $user = Auth::user();
        $wish_lists = $user->wish_lists;

        return new JsonResponse([
            'data' => [
                'wish_lists' => $wish_lists,
            ],
            'error' => ''
        ]);
    }

    public function add_wish_list(AddWishListRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        $wish_list = WishList::create([
            'user_id' => $user->id,
            'book_id' => $data['book_id'],
        ]);

        return new JsonResponse([
            'data' => [
                'wish_lists' => $wish_list,
            ],
            'error' => ''
        ]);
    }

    public function delete_wish_list(DeleteWishListRequest $request)
    {
        $data = $request->validated();
        $wish_list = WishList::where('id', $data['wishlist_id'])->first();
     
        $wish_list->delete();
     
        return new JsonResponse([
            'data' => [
                'message' => 'Wishlist Deleted',
            ],
            'error' => ''
        ]);
    }

    public function borrow_book(BorrowBookRequest $request)
    {
        $data = $request->validated();
        $book = Book::where('id', $data['book_id'])->first();
        
        $user = Auth::user();

        $existing_borrow = BookMove::where('user_id', $user->id) ->where('book_id', $data['book_id'])->whereNull('return_date')->first();
        
        if ($existing_borrow) {
            throw new HttpResponseException(response([
                'error' => [
                    'message' => 'You have already borrowed this book.'
                ]
            ], 400));
        }
        
        if ($book->stock_left <= 0) {
            throw new HttpResponseException(response([
                'error' => [
                    'message' => 'Book run out of stock'
                ]
            ], 400));
        }

        $borrowed_date = now();
        $expires_date = $borrowed_date->addDay();

        $book_move = BookMove::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => $borrowed_date,
            'expires_date' => $expires_date,
        ]);

        return new JsonResponse([
            'data' => [
                'borrow_lists' => $book_move,
                'file_url' => $book->getDownloadLink(),
            ],
            'error' => ''
        ]);
    }
    
    public function return_book(ReturnBookRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $book_move = BookMove::where('user_id', $user->id)->where('book_id', $data['book_id'])->whereNull('return_date')->first();

        if ($book_move) {
            
            $book_move->return_date = now();
            $book_move->save();
            
            return new JsonResponse([
                'data' => [
                    'message' => 'Book returned successfully',
                ],
                'error' => ''
            ]);
        } else {
            throw new HttpResponseException(response([
                'error' => [
                    'message' => 'No Borrow Book Found'
                ]
            ], 400));
        }
    }

    public function get_book_list()
    {
        $user = Auth::user();

        $books = $user->borrowed_book;

        return new JsonResponse([
            'data' => [
                'book_lists' => $books,
            ],
            'error' => ''
        ]);
    }

    public function get_history()
    {
        $user = Auth::user();

        $historys = $user->borrowed_history;

        return new JsonResponse([
            'data' => [
                'history_lists' => $historys,
            ],
            'error' => ''
        ]);
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        
        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 401);
        }

        // Update the password
        $user->password = Hash::make($data['new_password']);
        $user->save();

        return new JsonResponse([
            'data' => [
                'message' => 'Password changed successfully',
            ],
            'error' => ''
        ]);
    }

}
