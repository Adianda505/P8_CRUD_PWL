<?php

namespace App\Http\Controllers;

use App\Models\Bookshelves;
use Illuminate\Http\Request;

class BookshelfController extends Controller
{
    public function index()
    {
        $bookshelves = Bookshelves::all();

        return view('bookshelves.index', compact('bookshelves'));
    }

    public function create()
    {
        return view('bookshelves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:10|unique:bookshelves,code',
            'name' => 'required|max:255',
        ]);
        Bookshelves::create($request->all());

        return redirect()->route('bookshelves.index')
            ->with('success', 'Rak buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bookshelf = Bookshelves::findOrFail($id);

        return view('bookshelves.edit', compact('bookshelves'));
    }

    public function update(Request $request, $id)
    {
        $bookshelves = Bookshelves::findOrFail($id);

        $request->validate([
            'code' => 'required|max:10|unique:bookshelves,code,'.$id,
            'name' => 'required|max:255',
        ]);

        $bookshelves->update($request->all());

        return redirect()->route('bookshelves.index')
            ->with('success', 'Rak buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        Bookshelves::findOrFail($id)->delete();

        return redirect()->route('bookshelves.index')
            ->with('success', 'Rak buku berhasil dihapus');
    }
}
