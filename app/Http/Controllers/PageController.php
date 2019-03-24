<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Province;
use App\Models\District;
use App\Models\BookType;
use Request;
use Response;
use View;
use App;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bookId)
    {
        $pages = Page::where('book_id', $bookId)->orderBy('id','desc')->paginate(4);
        $provinces = Province::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        $districts = District::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        $book_types = BookType::select(['id', 'name_' . App::getLocale() . ' as name'])->get();
        return view('page.page_list', compact('pages', 'provinces', 'districts', 'book_types'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
