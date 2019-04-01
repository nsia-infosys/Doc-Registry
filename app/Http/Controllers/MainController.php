<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Page;
use App\Models\Province;
use App\Models\District;
use App\Models\BookType;
use App\Models\User;
use Request;
use Response;
use View;
use App;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // This controller will be used to response to multi column general view
    public function index($id=1)
    {
        // $books = Book::where('id', '>=', $id-10)->where('id', '<=', $id+10)->orderBy('id','asc')->get();
        $books = Book::whereBetween('id', [$id - 10, $id + 10])->orderBy('id','asc')->get();
        return view('general.view', compact('books', 'id'));
    }
    public function get_prev_books($id){
        $books = Book::whereBetween('id', [$id - 10,$id])->orderBy('id','asc')->get();
        return Response::json(['data'=>$books,'id'=>$id]);
        // return $books;
    }
    
    public function get_next_books($id){
        $books = Book::whereBetween('id', [$id,$id+10])->orderBy('id','asc')->get();
        return Response::json(['data'=>$books,'id'=>$id]);
    }
    public function showPage($id)
    {
        $page = Page::find($id);
        return view('general.partials.view_page', compact('page', 'id'));
    }

    public function listBooks($offset = 0, $limit = 10)
    {
        $book = Book::offset($offset)->limit($limit)->get();
        return Response::json($book);
    }

    public function getBookPages($bookId)
    {
        $regPages = Page::select('id')->where('book_id', $bookId)->orderBy('id','asc')->pluck('id')->toArray();
        // $regPages = array_column($pages, 'id');
        $book = Book::find($bookId);
        return Response::json(array(
            'book' => $book,
            'regPages' => $regPages
        ));
    }
}
