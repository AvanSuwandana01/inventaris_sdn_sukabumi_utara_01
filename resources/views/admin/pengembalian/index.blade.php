@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Data Pengembalian</h1>
            <div class="section-header-button">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalKembalikanBarang">Kembalikan
                    Barang</button>
                <a href="{{ route('pengembalian.print', ['id' => 1]) }}" class="btn btn-success" target="_blank">Export
                    PDF</a>
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
                        <th>Barang</th>
                        <th>Image</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Jumlah</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengembalians as $pengembalian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengembalian->peminjaman->barang->name }}</td>
                            <td>
                                <img src="{{ asset('') . $pengembalian->peminjaman->barang->image }}" height="100px"
                                    alt="img" class="rounded">
                            </td>

                            <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                            <td>{{ $pengembalian->jumlah_dikembalikan }}</td>
                            <td>{{ $pengembalian->peminjaman->user->name }}</td>
                            <td>
                                <button class="btn btn-warning" type="button"
                                    data-target="#EditPengembalian{{ $pengembalian->id }}" data-toggle="modal">Edit</button>
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#DeletePengembalian{{ $pengembalian->id }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Kembalikan Barang -->
    <div class="modal fade" id="modalKembalikanBarang" tabindex="-1" role="dialog"
        aria-labelledby="modalKembalikanBarangLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('pengembalian.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalKembalikanBarangLabel">Kembalikan Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user_id">User Yang Meminjam / Tanggal Pinjam</label>
                            <select class="form-control" id="user_id" name="peminjaman_id" required>
                                @foreach ($peminjamans as $peminjaman)
                                    <option value="{{ $peminjaman->id }}">{{ $peminjaman->user->name }} /
                                        {{ $peminjaman->tanggal_peminjaman }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah_dikembalikan" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kembalikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($pengembalians as $pengembalian)
        <div class="modal fade" id="EditPengembalian{{ $pengembalian->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditPengembalianLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditPengembalianLabel">Edit Pengembalian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user_id">User Yang Meminjam / Tanggal Pinjam</label>
                                <select class="form-control" id="user_id" name="peminjaman_id" required>
                                    <option value="">Pilih Peminjam</option>
                                    @foreach ($peminjamans as $peminjaman)
                                        <option value="{{ $peminjaman->id }}"
                                            {{ $pengembalian->peminjaman->user->id == $peminjaman->user->id ? 'selected' : '' }}>
                                            {{ $peminjaman->user->name }} / {{ $peminjaman->tanggal_peminjaman }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah_dikembalikan"
                                    required value="{{ $pengembalian->jumlah_dikembalikan }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tanggal_pengembalian"
                                    name="tanggal_pengembalian" required
                                    value="{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('Y-m-d') }}">
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


    @foreach ($pengembalians as $pengembalian)
        <div class="modal fade" id="DeletePengembalian{{ $pengembalian->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditPengembalianLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('pengembalian.destroy', $pengembalian) }}" method="POST">
                        @csrf
                        @method('delete')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditPengembalianLabel">Delete Pengembalian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>Apakah kamu yakin ingin menghapus data ini?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
