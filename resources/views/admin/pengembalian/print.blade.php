<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Pengembalian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        body {
            font-family: 'Times New Roman', Times, serif
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4" style="text-align: center">Data Pengembalian Inventaris</h1>
        <hr>
        <button class="btn btn-primary no-print" onclick="window.print()">Cetak PDF</button>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Peminjam</th>
                    <th>Image</th>
                    <th>Jumlah</th>
                    <th>Tanggal Dikembalikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalians as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->peminjaman->barang->kode_barang }}</td>
                        <td>{{ $item->peminjaman->barang->name }}</td>
                        <td>{{ $item->peminjaman->user->name }}</td>
                        <td>
                            <img src="{{ asset('/' . $item->peminjaman->barang->image) }}" alt="" height="100px"
                                class="rounded" alt="image-barang">
                        </td>
                        <td>{{ $item->jumlah_dikembalikan }}</td>
                        <td>{{ $item->peminjaman->tanggal_peminjaman }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
