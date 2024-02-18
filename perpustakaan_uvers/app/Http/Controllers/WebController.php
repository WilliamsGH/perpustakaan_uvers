<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookMove;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebController extends Controller
{
    protected $authController;
    protected $bookController;

    public function __construct(AuthController $authController, BookController $bookController)
    {
        $this->authController = $authController;
        $this->bookController = $bookController;
    }

    public function login()
    {
        return view('login');
    }

    public function action_login(Request $request)
    {
        // Validation (you may need more validation rules)
        
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $response = $this->authController->login($request->email, $request->password);

        if ($response['error'] == '') {
            return redirect()->intended('/');
        } else {
            return back()->withErrors($response);
        }
    }
    
    public function action_logout(Request $request)
    {
        $response = $this->authController->logout(Auth::user());
        
        if ($response['error'] == '') {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->intended('/login');
        } else {
            return back()->withErrors($response);
        }
    }

    public function dashboard()
    {
        return view('contents.dashboard.index', ['title' => 'Dashboard', 'user' => Auth::user()]);
    }

    public function bibliography()
    {

        $response = $this->bookController->getAll();

        $data = [
            'title' => 'Bibliography',
            'user' => Auth::user(),
            'book_ids' => $response['book_ids']->items(), 
            'links' => $response['book_ids']->links()

        ];

        return view('contents.bibliography.index', $data);
    }

    public function bibliography_create()
    {

        $data = [
            'category_ids' => Category::all(),
            'language_ids' => Language::all(),
        ];

        return view('contents.bibliography.create', ['title' => 'Bibliography', 'user' => Auth::user()] + $data);
    }

    public function action_bibliography_create(Request $request)
    {

        $data = $request->validate([
            'category_id' => 'required|integer',
            'language_id' => 'required|integer',
            'name' => 'required|string',
            'writer' => 'required|string',
            'publisher' => 'required|string',
            'type' => 'required|string',
            'isbn' => 'required|string',
            'publish_place' => 'required|string',
            'publish_period' => 'required|integer',
            'publish_year' => 'required',
            'internal_reference' => 'required|string',
            'synopsis' => 'required|string',
            'is_publish' => '',
            'stock' => 'required|integer',
        ]);

        $file = $request->validate([
            'cover_file' => 'required|image|mimes:jpeg,png,jpg,gif',
            'book_file' => 'required',
        ]);

        $data['is_publish'] =(@$data['is_publish'] == 'on') ? TRUE : FALSE ;

        $response = $this->bookController->create($data, $file);

        if ($response['error'] == '') {
            return redirect()->intended('/bibliography');
        } else {
            return back()->withErrors($response);
        }

    }
    
    public function bibliography_edit($id)
    {
        $response = $this->bookController->get($id);

        
        if ($response['book_id']) {
            $data = [
                'category_ids' => Category::all(),
                'language_ids' => Language::all(),
                'book_id' => $response['book_id'],
            ];
            return view('contents.bibliography.edit',  ['title' => 'Bibliography', 'user' => Auth::user()] + $data);
        } else {
            return redirect()->intended('/bibliography');
        }

    }
    
    public function bibliography_update(Request $request, $id)
    {
        
        $data = $request->validate([
            'category_id' => 'required|integer',
            'language_id' => 'required|integer',
            'name' => 'required|string',
            'writer' => 'required|string',
            'publisher' => 'required|string',
            'type' => 'required|string',
            'isbn' => 'required|string',
            'publish_place' => 'required|string',
            'publish_period' => 'required|integer',
            'publish_year' => 'required',
            'internal_reference' => 'required|string',
            'synopsis' => 'required|string',
            'is_publish' => '',
            'stock' => 'required|integer',
        ]);

        $file = $request->validate([
            'cover_file' => 'image|mimes:jpeg,png,jpg,gif',
            'book_file' => '',
            'stock' => 'required|integer',
        ]);

        $data['is_publish'] =(@$data['is_publish'] == 'on') ? TRUE : FALSE ;


        $book_id = Book::findOrFail($id);
        $book_id->update($data);

        $fileName = $book_id->id . '-' .  Str::uuid();

        if (@$file['cover_file']) {
            Storage::delete($book_id->cover_path);
            $coverFile = $file['cover_file'];   
            $book_id->cover_path = $coverFile->storeAs('books/covers', $fileName . "." . $coverFile->getClientOriginalExtension() , 'public');
    
            
        }
        
        if (@$file['book_file']) {
            Storage::delete($book_id->book_path);
            $bookFile = $file['book_file'];
            $book_id->book_path = $bookFile->storeAs('books/files', $fileName . "." . $bookFile->getClientOriginalExtension() , 'public');
        }

        $book_id->save();

        return redirect()->intended("/bibliography/edit/$id");

    }

    public function bibliography_destroy($id)
    {
        $book_id = Book::findOrFail($id);
    
        // Delete the associated cover image if it exists
        if ($book_id->cover_path) {
            Storage::delete($book_id->cover_path);
        }
        if ($book_id->book_path) {
            Storage::delete($book_id->book_path);
        }
    
        // Delete the book record from the database
        $book_id->delete();
    
        return redirect()->intended("/bibliography")->with('success', 'Book deleted successfully');
    }

    public function borrowing_history()
    {

        $move_ids = BookMove::all();

        return view('contents.borrowing_history.index',  ['title' => 'Riwayat Peminjaman', 'user' => Auth::user(), 'move_ids' => $move_ids] );
    }

    public function member()
    {
        $user_ids = User::all();

        return view('contents.member.index',  ['title' => 'Anggota', 'user' => Auth::user(), 'user_ids' => $user_ids] );
    }

    public function member_create()
    {        
        $data = [
            'institution_ids' => Institution::all(),
        ];

        return view('contents.member.create',  ['title' => 'Anggota', 'user' => Auth::user()] + $data );
    }

    public function member_store(Request $request)
    {   

        $data = $request->validate([
            'institution_id' => 'required|integer',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'name' => 'required',
            'join_date' => 'required',
            'gender' => 'required',
            'active' => '',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user_id = User::create($data);

        return redirect()->intended("/member")->with('success', 'Book deleted successfully');
    }

    public function member_edit($id)
    {   
        $user_id = User::findOrFail($id);

        if (@$user_id) {
            $data = [
                'institution_ids' => Institution::all(),
                'user_id' => $user_id,
            ];
            return view('contents.member.edit',  ['title' => 'Anggota', 'user' => Auth::user()] + $data);
        } else {
            return redirect()->intended('/member');
        }
    }

    public function member_update(Request $request, $id)
    {   
        $user_id = User::findOrFail($id);

        $data = $request->validate([
            'institution_id' => 'required|integer',
            'email' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'join_date' => 'required',
            'gender' => 'required',
            'active' => '',
        ]);

        $data['active'] =(@$data['active'] == 'on') ? 1 : 0 ;

        if (@$request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user_id->update($data);
        $user_id->save();

        return redirect()->intended("/member/edit/$id");
    }

    public function member_destroy($id)
    {
        if ($id == 1) {
            return redirect()->intended("/member")->with('failed', 'Tidak dapat menghapus member ini!');
        } else {
            $user_id = User::findOrFail($id);
            $user_id->delete();
            return redirect()->intended("/member")->with('success', 'Member berhasil di hapus!');
        }
    
    }
}
