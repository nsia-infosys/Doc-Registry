<?php

namespace App\Http\Controllers;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Book;
use App\Models\Page;
use App\Models\Province;
use App\Models\District;
use App\Models\BookType;
use App\Models\User;
use Validator;
use Response;
use QueryException;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use View;
use App;

use Illuminate\Support\Facades\Auth;

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
        $request->request->add(['user_id' => Auth::user()->id]);

        
        if (!Auth::user()->hasPermissionTo('Create Book')) {
            abort('401');
        }

        $rules = array(
            'book_name' => 'required',
            'province_id' => 'required',
            'book_type_id' =>'required',
            'district_id' => 'required',
            'volume_no' => 'required',
            'start_page_no' => 'required',
            'end_page_no' => 'required',
            'book_year' => 'required',
        );

        $validator = Validator::make($request->all(),$rules);
        
        //
        if ($validator->fails()) {
            return Response::json([
                'message'=>'Data not inserted',
                'error' =>$validator->errors()->toArray()
            ]);
        }else{
            $total_pages = ($request->end_page_no) - ($request->start_page_no);
        $request->request->add(['total_pages' => $total_pages]);
            try{
                $book = Book::create($request->all());
                return Response::json([
                    'message'=>'Data inserted']); 
            }catch(QueryException $e){
                dd($e.getMessage());
            }
            
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->hasPermissionTo('View Book')) {
            abort('401');
        }

        $book = Book::find($id);
        // if (Request::ajax()) {
            return view('book.partials.view', compact('book'));
        // }
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
        if (!Auth::user()->hasPermissionTo('Edit Book')) {
            abort('401');
        }

        // $where = array('id' => $id);
        // $book  = Book::where($where)->first();
        $book = Book::find($id);
        $book_details = array(
            array('key'=> 0, 'value'=> 'Kochi'),
            array('key'=> 1, 'value'=> 'Female Books'),
            array('key'=> 2, 'value'=> 'Male Books')
        );
        $provinces = Province::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        $districts = District::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        $book_types = BookType::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        
        return view('book.partials.edit', compact('book', 'provinces', 'districts', 'book_types', 'book_details', 'id'));
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
        // return Response::json([$request->all()],200);
        if (!Auth::user()->hasPermissionTo('Edit Book')) {
            abort('401');
        }
        $rules = array(
            'book_name' => 'required',
            'province_id' => 'required ',
            'book_type_id' =>'required ',
            'district_id' => 'required ',
            'volume_no' => 'required ',
            'start_page_no' => 'required ',
            'end_page_no' => 'required ',
            
            'book_year' => 'required ',
        );

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return Response::json([
                'message'=>'Data not updated',
                'error' =>$validator->errors()->toArray()
            ]);
        }else{
            $total_pages = ($request->end_page_no) - ($request->start_page_no);
            $request->request->add(['total_pages' => $total_pages]);
            try{  
                // Get the book
                $book = Book::findOrFail($id);
                // Update book
                $book->fill($request->all());
                $book->save();
                return Response::json(['message'=>'Data updated']); 
            }catch(QueryException $e){
                return $e.getMessage();
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('Delete Book')) {
            abort('401');
        }

        $book = Book::where('id',$id)->delete();
        return Response::json($book);
    }
}
