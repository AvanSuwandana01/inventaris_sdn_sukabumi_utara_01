@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Barang</h1>
            <div class="section-header-button">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBarang">Tambah Barang</button>
                <a href="{{ route('barangs.print') }}" target="_blank" class="btn btn-success">Export Data
                    Barang</a>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="badge badge-danger text-white">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="myTable" class="text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Foto</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>
                                <img src="{{ asset('/' . $item->image) }}" alt="" height="100px" class="rounded"
                                    alt="image-barang">
                            </td>
                            <td>
                                <button class="btn btn-warning" type="button" data-toggle="modal"
                                    data-target="#modalEditBarang{{ $item->id }}">Edit</button>
                                <button class="btn btn-danger" type="button" data-toggle="modal"
                                    data-target="#modalDeleteBarang{{ $item->id }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="modalTambahBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi Barang</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar Barang</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
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

    <!-- Modal Edit Barang -->
    @foreach ($barangs as $item)
        <div class="modal fade" id="modalEditBarang{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditBarangLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('barangs.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditBarangLabel{{ $item->id }}">Edit Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                    value="{{ $item->kode_barang }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $item->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Barang</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $item->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar Barang</label>
                                <input type="file" class="form-control-file" id="image" name="image"
                                    accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                    value="{{ $item->jumlah }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    @foreach ($barangs as $item)
        <div class="modal fade" id="modalDeleteBarang{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditBarangLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('barangs.destroy', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('delete')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditBarangLabel{{ $item->id }}">Delete Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah kamu yakin ingin menghapus data barang ini</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
