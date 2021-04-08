<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $books = Book::paginate(15);
        foreach ($books as $book){
            $authorsIds = explode(",", $book->authors_ids);
            $book->authors = Author::find($authorsIds);
        }
        $authors = Author::all();

        return view('books.books', compact(['books', 'authors']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $books = new Book();
        $books->name = $request->input('name');
        $books->date = $request->input('date');
        $books->description = $request->input('description');
        if ($request->image->store('images','public')){
            $books->image = $request->image->store('images','public');
        }else{
            $books->image = '';
        }

        $books->authors_ids = implode(',', $request->input('authors_ids'));

        $books->save();
        $books = Book::paginate(15);
        foreach ($books as $book){
            $authorsIds = explode(",", $book->authors_ids);
            $book->authors = Author::find($authorsIds);
        }
        $authors = Author::all();

        return view('books.books', compact(['books', 'authors']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find(intval($id));

        $book->author_ids = explode(",", $book->author_ids);
        $book->image = str_replace('images/', "", $book->image);
        $authors = Author::all();

        return view('books.books_form', compact(['book', 'authors']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $book->name = $request->input('name');
        $book->date = $request->input('date');
        $book->description = $request->input('description');
        if ($request->file('images')){
            $book->image = $request->image->store('images','public');
        }
        $book->authors_ids = implode(',', $request->input('authors_ids'));

        $book->save();
        $books = Book::paginate(15);
        foreach ($books as $book){
            $authorsIds = explode(",", $book->authors_ids);
            $book->authors = Author::find($authorsIds);
        }
        $authors = Author::all();
        return redirect('/book');
        //return view('books.books', compact(['books', 'authors']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find(intval($id))->delete();
        $books = Book::paginate(15);
        foreach ($books as $book){
            $authorsIds = explode(",", $book->authors_ids);
            $book->authors = Author::find($authorsIds);
        }
        $authors = Author::all();
        return view('books.book_list', compact(['books', 'authors']));
    }
    public function search(Request $request)
    {

        $filter = $request->input('search');

        $books = Book::where('name','like',"%$filter%")->get();

        foreach ($books as $book){
            $authorsIds = explode(",", $book->authors_ids);
            $book->authors = Author::find($authorsIds);
        }
        $authors = Author::all();
        return view('books.books_sort', compact(['books', 'authors']));

    }
}
