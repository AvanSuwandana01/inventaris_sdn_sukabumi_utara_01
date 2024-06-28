<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>
    <style>
        /* CSS untuk styling halaman cetak */
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info strong {
            display: inline-block;
            width: 150px;
        }

        .divider {
            border-top: 1px dashed #ddd;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }


        @page {
            size: A4;
            /* Menentukan ukuran kertas, contohnya A4 */
            margin: 1cm;
            /* Margin di setiap sisi halaman */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title">Detail Peminjaman</div>
        </div>
        <div class="info">
            <strong>No. Peminjaman:</strong> {{ $peminjaman->id }}<br>
            <strong>Tanggal Peminjaman:</strong> {{ $peminjaman->tanggal_peminjaman }}<br>
            <strong>User:</strong> {{ $peminjaman->user->name }}<br>
        </div>
        <div class="divider"></div>
        <div class="info">
            <strong>Barang:</strong> {{ $peminjaman->barang->name }}<br>
            <strong>Jumlah:</strong> {{ $peminjaman->jumlah }}<br>
            <strong>Tanggal Pengembalian:</strong> {{ $peminjaman->tanggal_pengembalian ?? 'belum-dikembalikan' }}<br>
        </div>
        <div class="footer">
            Terima kasih telah menggunakan layanan kami.
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
