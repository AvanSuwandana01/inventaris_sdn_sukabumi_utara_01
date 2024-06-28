<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pengembalians = Pengembalian::with('peminjaman', 'peminjaman.barang')->get();
        $peminjamans = Peminjaman::whereNull('tanggal_pengembalian')->with('barang', 'user')->get();
        return view('admin.pengembalian.index', compact('pengembalians', 'peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'peminjaman_id' => 'required',
            'jumlah_dikembalikan' => 'required|numeric',
            'tanggal_pengembalian' => 'required'
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $peminjaman  = Peminjaman::where('id', $request->peminjaman_id)->with('barang')->first();
        if ($request->jumlah_dikembalikan < $peminjaman->jumlah) {
            Alert::error('ops jumlah yang anda balikan tidak sesuai dengan peminjaman anda');
            return redirect()->back();
        }

        Pengembalian::create(
            [
                'peminjaman_id' => $request->peminjaman_id,
                'jumlah_dikembalikan' => $request->jumlah_dikembalikan,
                'tanggal_pengembalian' => $request->tanggal_pengembalian
            ]
        );
        $barang = $peminjaman->barang;

        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->save();

        $barang->jumlah += $request->jumlah_dikembalikan;
        $barang->save();

        Alert::success('sukses mengembalikan barang');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
        $request->validate([
            'peminjaman_id' => 'required',
            'tanggal_pengembalian' => 'required',
            'jumlah_dikembalikan' => 'required'
        ]);

        $jumlah = $request->jumlah_dikembalikan;
        if ($jumlah < $pengembalian->peminjaman->jumlah) {
            return redirect()->back()->withErrors('jumlah yang dikembalikan kurang');
        }
        $pengembalian->update($request->all());
        Alert::success('berhasil memperbarui data pengembalian');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        Alert::success('berhasil menghapus data pengembalian');
        return back();
        //
    }


    public function print()
    {
        $pengembalians = Pengembalian::with('peminjaman', 'peminjaman.barang', 'peminjaman.user')->get();
        return view('admin.pengembalian.print', compact('pengembalians'));
    }
}
