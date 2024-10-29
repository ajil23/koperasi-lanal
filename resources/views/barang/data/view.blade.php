@extends('admin.admin_master')
@section('admin')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBarangModal">Tambah Data Barang</button>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($barang as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->satuan}}</td>
                            
                            <td>{{$data->deskripsi}}</td>
                            <td colspan="2">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editBarangModal"
                                    data-id="{{ $data->id }}"
                                    data-nama="{{ $data->nama }}"
                                    data-satuan="{{ $data->satuan }}"
                                    
                                    data-deskripsi="{{ $data->deskripsi }}">
                                    Edit
                                </button>
                                <a href="{{ route('barang.destroy', $data->id) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Add-->
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBarangModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahBarang" method="POST" action="{{route('barang.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="namaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="namaBarang" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" form="formTambahBarang" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Edit -->
    <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditBarang" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editNamaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="editNamaBarang" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="editSatuan">Satuan</label>
                            <input type="text" class="form-control" id="editSatuan" name="satuan" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="editDeskripsi">Deskripsi</label>
                            <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-warning" id="btnSimpanEdit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#editBarangModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var id = button.data('id');
            var nama = button.data('nama');
            var satuan = button.data('satuan');
            var stok = button.data('stok');
            var deskripsi = button.data('deskripsi');

            // Mengisi inputan modal dengan data dari tombol Edit
            var modal = $(this);
            modal.find('#editId').val(id);
            modal.find('#editNamaBarang').val(nama);
            modal.find('#editSatuan').val(satuan);
            modal.find('#editStok').val(stok);
            modal.find('#editDeskripsi').val(deskripsi);

            // Atur action form dengan route yang benar
            var actionUrl = '{{ route("barang.update", ":id") }}';
            actionUrl = actionUrl.replace(':id', id); // Ganti :id dengan ID barang
            $('#formEditBarang').attr('action', actionUrl); // Set action
        });

        $('#btnSimpanEdit').on('click', function(event) {
            event.preventDefault();
            var form = $('#formEditBarang');

            $.ajax({
                url: form.attr('action'), // Ambil action dari form
                method: 'POST',
                data: form.serialize(), // Kirim data dari form
                success: function(response) {
                    $('#editBarangModal').modal('hide');
                    // Tambahkan logika untuk memperbarui tampilan data jika diperlukan
                    location.reload(); // Refresh halaman untuk melihat pembaruan
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>

@endsection