<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\loan;
use Illuminate\Http\Request;

class loandetail extends Controller
{
    public function index()
    {
        $loanDetails = LoanDetail::with(['loan', 'book'])->get();

        return view('loan_detail.index', compact('loanDetails'));
    }

    public function create()
    {
        $loans = loan::all();
        $books = Book::all();

        return view('loan_detail.create', compact('loans', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
            'is_return' => 'required|boolean',
        ]);

        LoanDetail::create($request->all());

        return redirect()->route('loan-detail.index')
            ->with('success', 'Detail peminjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $loanDetail = LoanDetail::findOrFail($id);
        $loans = loan::all();
        $books = Book::all();

        return view('loan_detail.edit', compact('loanDetail', 'loans', 'books'));
    }

    public function update(Request $request, $id)
    {
        $loanDetail = LoanDetail::findOrFail($id);

        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
            'is_return' => 'required|boolean',
        ]);

        $loanDetail->update($request->all());

        return redirect()->route('loan-detail.index')
            ->with('success', 'Detail peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        LoanDetail::findOrFail($id)->delete();

        return redirect()->route('loan-detail.index')
            ->with('success', 'Detail peminjaman berhasil dihapus');
    }
}
