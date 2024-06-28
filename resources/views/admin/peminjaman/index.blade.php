@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Peminjaman</h1>
            <div class="section-header-button">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPeminjaman">Tambah
                    Peminjaman</button>
                <a href="{{ route('peminjaman.print') }}" class="btn btn-success" target="_blank">Export PDF</a>
            </div>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="badge badge-danger text-white">{{ $error }}</div>
            @endforeach
        @endif
        <div class="table-responsive">
            <table class="table table-hover" id="myTable" class="text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Foto</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peminjaman->user->name }}</td>
                            <td>{{ $peminjaman->barang->name }}</td>
                            <td>{{ $peminjaman->jumlah }}</td>
                            <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                            <td>{{ $peminjaman->tanggal_pengembalian ?? 'belum-dikembalikan' }}</td>
                            <td>
                                <img src="{{ asset('/' . $peminjaman->barang->image) }}" alt="" height="100px"
                                    class="rounded" alt="image-barang">
                            </td>
                            <td>
                                <button class="btn btn-warning" type="button"
                                    data-target="#EditPeminjaman{{ $peminjaman->id }}" data-toggle="modal">Edit</button>
                                <button class="btn btn-danger">Hapus</button>
                                <a href="{{ route('peminjaman.show', ['peminjaman' => $peminjaman]) }}" target="_blank"
                                    class="btn btn-success">Cetak</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Tambah Peminjaman -->
    <div class="modal fade" id="modalTambahPeminjaman" tabindex="-1" role="dialog"
        aria-labelledby="modalTambahPeminjamanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPeminjamanLabel">Tambah Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="barang_id">Barang</label>
                            <select class="form-control" id="barang_id" name="barang_id" required>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Peminjaman -->
    @foreach ($peminjamans as $item)
        <div class="modal fade" id="EditPeminjaman{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditPeminjamanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('peminjaman.update', ['peminjaman' => $item]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditPeminjamanLabel">Edit Peminjaman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="barang_id">Barang</label>
                                <select class="form-control" id="barang_id" name="barang_id" required>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required
                                    value="{{ $item->jumlah }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tanggal_peminjaman"
                                    name="tanggal_peminjaman" required
                                    value="{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tanggal_pengembalian"
                                    name="tanggal_pengembalian"
                                    value="{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
