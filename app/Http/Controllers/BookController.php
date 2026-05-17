<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelves;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $data['books'] = Book::with('bookshelf')->get();
        return view('books.index', $data);
    }

    // public function show($id)
    // {
    //     $bookshelves = Bookshelves::findOrFail($id);
    //     return view('books.show', compact('bookshelves'));
    // }
    public function create()
    {
        $data['bookshelves'] = Bookshelves::pluck('name', 'id');
        return view('books.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:2000|max:' . (date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:100',
            'quantity' => 'required|numeric',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->storeAs(
                'cover_buku',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension(),
            );
            $validated['cover'] = basename($path);
        }

        Book::create($validated);

        $notification = array(
            'message' => 'Data Buku Berhasil Ditambahkan!',
            'alert_type' => 'success'
        );

        if ($request->save == true) {
            return redirect()->route('book')->with($notification);
        } else {
            return redirect()->route('books.create')->with($notification);
        }
    }
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:2000|max:'.(date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:100',
            // 'quantity' => 'required|numeric',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);

        if ($request->hasFile('cover')){
            if($book->cover != null){
                Storage::delete('public/cover_buku/'. $request->old_cover);
            }
            $path = $request->file('cover')->storeAs(
                'cover_buku',
                'cover_buku_'.time() . '.' . $request->file('cover')->extension(),
            );
            $validated['cover'] = basename($path);
        }

        Book::where('id', $id)->update($validated);

        $notification = array(
            'message' => 'Data Buku Berhasil Diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->route('book')->with($notification);
    }

    public function edit(string $id)
    {
        $data['book'] = Book::find($id);
        $data['bookshelves'] = Bookshelves::pluck('name', 'id');
        return view('books.edit', $data);
    }

    public function destroy(string $id){
        $book = Book::findOrFail($id);

        Storage::delete('public/cover_buku/'.$book->cover);

        $book->delete();
        $notification = array (
            'message' => 'Data Buku Berhasil Dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('book')->with($notification);
    }
}
