<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $barangs = Barang::latest()->get();
        return view('admin.barang.index', compact('barangs'));
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
        $request->validate([
            'kode_barang' => 'required|unique:barangs',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jumlah' => 'required|integer',
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('barang_images'), $imageName);

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'name' => $request->name,
            'description' => $request->description,
            'image' => 'barang_images/' . $imageName,
            'jumlah' => $request->jumlah,
        ]);


        Alert::success("Berhasil menambahkan barang");

        return redirect()->route('barangs.index')
            ->with('success', 'Barang created successfully.');
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
    public function update(Request $request, Barang $barang)
    {
        //

        $request->validate([
            'kode_barang' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jumlah' => 'required|integer',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('barang_images'), $imageName);
            $oldImagePath = public_path($barang->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $barang->image = 'barang_images/' . $imageName;
        }

        $barang->kode_barang = $request->kode_barang;
        $barang->name = $request->name;
        $barang->description = $request->description;
        $barang->jumlah = $request->jumlah;
        $barang->save();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $barang = Barang::where('id', $id)->first();
        $imagePath = public_path($barang->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $barang->delete();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang deleted successfully.');
    }


    public function print()
    {
        $barangs = Barang::all();
        return view('admin.barang.print', compact('barangs'));
    }
}
