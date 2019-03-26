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
    // This controller will be used to response to multi column general view
    public function index($id=1)
    {
        // $books = Book::where('id', '>=', $id-10)->where('id', '<=', $id+10)->orderBy('id','asc')->get();
        $books = Book::whereBetween('id', [$id - 10, $id + 10])->orderBy('id','asc')->get();
        return view('general.view', compact('books', 'id'));
    }

    public function showPage($id)
    {
        $page = Page::find($id);
        if (Request::ajax()) {
            return view('general.partials.view_page', compact('page'));
        }
        return Response::json($page);
    }
}
