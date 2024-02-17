<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetBookDetailRequest;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function get($id)
    {
        $book_id = Book::where('id', '=', $id)->first();
        
        return [ 'error' => '', 'book_id' => $book_id ];
    }

    public function getAll($isPublished = false)
    {
        if ($isPublished) {
            $book_ids = Book::where('is_publish', '=', true)->paginate(10);
        } else {
            $book_ids = Book::paginate(10);
        }

        return [ 'error' => '', 'book_ids' => $book_ids ];

    }

    public function create($data, $file)
    {

        $book_id = Book::create($data);

        $fileName = $book_id->id . '-' .  Str::uuid();
        
        // Cover
        $coverFile = $file['cover_file'];   
        $book_id->cover_path = $coverFile->storeAs('books/covers', $fileName . "." . $coverFile->getClientOriginalExtension() , 'public');

        
        // Files
        $bookFile = $file['book_file'];
        $book_id->book_path = $bookFile->storeAs('books/files', $fileName . "." . $bookFile->getClientOriginalExtension() , 'local');
        
        $book_id->save();

        return ['error' => '', 'book_id' => $book_id];
        
    }
    public function get_book_list()
    {
        $books = Book::where('is_publish', '=', true)->get();

        return new JsonResponse([
            'data' => [ 
                'book_lists' => ($books) ? $books : [] 
            ],
            'error' => ''
        ]);
    }

    public function get_book_detail(GetBookDetailRequest $request)
    {
    $data = $request->validated();

        $book = Book::where('id', $data['book_id'])->first();

        return new JsonResponse([
            'data' => [
                'book_lists' => $book
            ],
            'error' => ''
        ]);
    }

    public function download(Book $book)
    {
        if (!$book->file_path) {
            abort(404);
        }

        $filePath = storage_path('app/storage/' . $book->file_path);
        
        return response()->download($filePath, 'pdffile');
    }

}
