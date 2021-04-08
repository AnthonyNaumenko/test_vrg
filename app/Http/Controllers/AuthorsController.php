<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $authors = Author::all()->sortBy('last_name');
        return view('books.authors', compact('authors'));

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

        public function store(Request $request)
    {
        $authors = new Author();
        $authors->first_name = $request->input('first_name');
        $authors->last_name = $request->input('last_name');
        $authors->middle_name = $request->input('middle_name');

        $authors->save();
        $authors = Author::all()->sortBy('last_name');
        return view('books.authors_table', compact('authors'));

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, Author $author)
    {
        $author->first_name = $request->input('first_name');
        $author->last_name = $request->input('last_name');
        $author->middle_name = $request->input('middle_name');

        $author->save();
        $authors = Author::all()->sortBy('last_name');
        return view('books.authors_table', compact('authors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy($id)
    {
        Author::find($id)->delete();
        $authors = Author::all()->sortBy('last_name');
        return view('books.authors_table', compact('authors'));
    }
    public function search(Request $request)
    {

        $filter = $request->input('search');

        $authors = Author::where('first_name','like',"%$filter%")->orWhere('last_name','like',"%$filter%")->get();
        return view('books.authors', compact('authors'));

    }
}
