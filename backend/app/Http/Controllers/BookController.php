<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController
{

    public function homepage(){
        return view("welcome");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::query() -> get();
        return response()->json(["data"=> $books], 200);
    }

    public function show(string $id)
    {   
        $book = Book::find($id);
        return $book;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
       

        $validator = Validator::make($request -> all(),[
            'title' => 'required|string|max:255',
            'author' => 'required|string',
            'publised_year' => 'integer',
            'genre' => 'required|string',
            'description' => 'required'
        ]);

  
        if($validator -> fails()){
            return response()->json(['error' => $validator->messages()], 422);
        }
        $book = Book::create([
            'title' => $request -> input('title'),
            'author' => $request -> input('author'),
            'published_year'=> $request -> input('published_year'),
            'genre' => $request->input('genre'),
            'description' => $request -> input('description')
        ]);
      

        return response()->json([
            'message' => `The book is successfully added`,
            'data' => new BookResource($book)
        ], 200);
        
        
    }
     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {

        $book = Book::find($request->input('BookId'));

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'author' => 'required|string',
                'published_year' => 'integer',
                'genre' => 'required|string',
                'description' => 'required'
            ]);
        
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 422);
            }
        
            // Update fields directly
            $book->update($request->only(['title', 'author', 'published_year', 'genre', 'description']));
        
            return response() -> json([
                'message' => 'Book updated successfully!',
                'data' => new BookResource($book)
            ], 200);
        }
        
    }
   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,  Book $book)
    {   
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return response()->json(['message' => 'Book deleted successfully'], 200);
        }

        return response()->json(['message' => 'Book not found'], 404);
    }
}
