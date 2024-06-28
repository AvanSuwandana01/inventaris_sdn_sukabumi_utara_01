<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $jumlahUser = User::count();
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahPengembalian = Pengembalian::count();
        $jumlahBarang = Barang::count();
        $monthlyPeminjaman = Peminjaman::selectRaw('EXTRACT(MONTH FROM tanggal_peminjaman) as month, COUNT(*) as count')
            ->whereYear('tanggal_peminjaman', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();


        // Prepare data for Chart.js
        $months = [];
        $peminjamanData = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F');
            $peminjamanData[] = $monthlyPeminjaman[$i] ?? 0;
        }


        return view('dashboard', compact('jumlahUser', 'jumlahPeminjaman', 'jumlahPengembalian', 'jumlahBarang', 'months', 'peminjamanData'));
    }
}
