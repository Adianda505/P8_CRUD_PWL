<?php

namespace App\Http\Controllers;

use App\Models\loanDetail;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = ReturnBook::with('loanDetail')->get();

        return view('returns.index', compact('returns'));
    }

    public function create()
    {
        $loanDetails = loanDetail::with('book')->where('is_return', false)->get();

        return view('returns.create', compact('loanDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'charge' => 'required|boolean',
            'amount' => 'nullable|integer|min:0',
        ]);

        ReturnBook::create([
            'loan_detail_id' => $request->loan_detail_id,
            'charge' => $request->charge,
            'amount' => $request->amount ?? 0,
        ]);

        $loanDetail = loanDetail::findOrFail($request->loan_detail_id);
        $loanDetail->update([
            'is_return' => true,
        ]);

        return redirect()->route('returns.index')
            ->with('success', 'Pengembalian buku berhasil disimpan');
    }

    public function edit($id)
    {
        $return = ReturnBook::findOrFail($id);
        $loanDetails = loanDetail::with('book')->get();

        return view('returns.edit', compact('return', 'loanDetails'));
    }

    public function update(Request $request, $id)
    {
        $return = ReturnBook::findOrFail($id);

        $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'charge' => 'required|boolean',
            'amount' => 'nullable|integer|min:0',
        ]);

        $return->update([
            'loan_detail_id' => $request->loan_detail_id,
            'charge' => $request->charge,
            'amount' => $request->amount ?? 0,
        ]);

        return redirect()->route('returns.index')
            ->with('success', 'Data pengembalian berhasil diperbarui');
    }

    public function destroy($id)
    {
        ReturnBook::findOrFail($id)->delete();

        return redirect()->route('returns.index')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }
}
