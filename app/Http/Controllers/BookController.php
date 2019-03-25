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

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_details = array(
            array('key'=> 0, 'value'=> 'Kochi'),
            array('key'=> 1, 'value'=> 'Female Books'),
            array('key'=> 2, 'value'=> 'Male Books')
        );

        $books = Book::orderBy('id','desc')->paginate(4);
        $provinces = Province::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        $districts = District::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        $book_types = BookType::select(['id', 'name_' . App::getLocale() . ' as name'])->get();

        $assignees = User::select(['id', 'name'])->get();
        return view('book.book_list', compact('books', 'provinces', 'districts', 'book_types', 'book_details', 'assignees'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1'
        ]);


        // $bookId = $request->book_id;
        // $book   =   Book::updateOrCreate(['id' => $bookId],
        //             ['name' => $request->name, 'email' => $request->email]);
    
        // return Response::json($book);

        // Create the book
        if ( $book = Book::create($request->except('user_id')) ) {

            $this->syncPermissions($request, $book);

            flash('Book has been created.');

        } else {
            flash()->error('Unable to create Book.');
        }

        return redirect()->route('book.book_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (Request::ajax()) {
            return view('book.partials.view', compact('book'));
        }
        return Response::json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $where = array('id' => $id);
        // $book  = Book::where($where)->first();
        $book = Book::find($id);
        
        if (Request::ajax()) {
            return view('book.partials.edit', compact('user'));
        }
        return Response::json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1'
        ]);

        // Get the book
        $book = Book::findOrFail($id);

        // Update book
        $book->fill($request->except('user_id'));

        $book->save();

        flash()->success('Book has been updated.');

        return redirect()->route('book.book_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::where('id',$id)->delete();
        return Response::json($book);
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
