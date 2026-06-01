<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\loan;

class LoansController extends Controller
{
     public function index()
    {
        $loans = Loan::with('user')->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::all();
        return view('loans.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_npm' => 'required|exists:users,npm',
            'loan_at' => 'required|date',
            'return_at' => 'required|date|after_or_equal:loan_at',
        ]);

        Loan::create($request->all());

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $users = User::all();

        return view('loans.edit', compact('loan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'user_npm' => 'required|exists:users,npm',
            'loan_at' => 'required|date',
            'return_at' => 'required|date|after_or_equal:loan_at',
        ]);

        $loan->update($request->all());

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        Loan::findOrFail($id)->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil dihapus');
    }
}
