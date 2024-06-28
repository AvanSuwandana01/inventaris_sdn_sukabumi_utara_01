<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $peminjamans = Peminjaman::with(['user', 'barang'])->get();
        $users = User::where('role', 'user')->get();
        $barangs = Barang::all();
        return view('admin.peminjaman.index', compact('peminjamans', 'users', 'barangs'));
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'barang_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_peminjaman' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $barang = Barang::where('id', $request->barang_id)->first();

        if ($barang->jumlah < $request->jumlah) {
            return redirect()->back()->withErrors('Jumlah barang tidak mencukupi');
        }

        $barang->jumlah = $barang->jumlah - $request->jumlah;
        $barang->update();

        Peminjaman::create($request->all());

        Alert::success('Barang berhasil dipinjam');

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        return view('admin.peminjaman.detail-pdf', compact('peminjaman'));
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
    public function update(Request $request, Peminjaman $peminjaman)
    {

        //
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'barang_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_peminjaman' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $peminjaman->update($data);
        Alert::success('berhasil update data peminjaman');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function print()
    {
        $peminjamans  = Peminjaman::with('user', 'barang')->get();
        return view('admin.peminjaman.print', compact('peminjamans'));
    }
}
