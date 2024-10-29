@extends('admin.admin_master')
@section('admin')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Barang Keluar</h1>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#dataKeluarModal">
            Tambah Data Keluar
        </button>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Barang Keluar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Qty</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($keluar as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->barang->nama}}</td>
                            <td>{{date('d-M-Y', strtotime($data->tanggal));}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>{{$data->qty}}</td>
                            <td colspan="2">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editDataKeluarModal" data-id="{{ $data->id }}"
                                    data-nama="{{ $data->barang->id }}"
                                    data-tanggal="{{ $data->tanggal }}"
                                    data-keterangan="{{ $data->keterangan }}"
                                    data-qty="{{ $data->qty }}">
                                    Edit
                                </button>
                                <a href="{{ route('keluar.destroy', $data->id) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add-->
<div class="modal fade" id="dataKeluarModal" tabindex="-1" role="dialog" aria-labelledby="dataKeluarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataKeluarModalLabel">Tambah Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('keluar.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama-barang">Nama Barang</label>
                        <select class="form-control" id="nama-barang" name="barang_id">
                            <option value="">Pilih Barang</option>
                            @foreach ($masuk as $item)
                            <option value="{{$item->masuk}}">{{$item->masuk}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kuantitas">Kuantitas</label>
                        <input type="number" class="form-control" id="kuantitas" name="qty" min="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editDataKeluarModal" tabindex="-1" role="dialog" aria-labelledby="editDataKeluarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataKeluarModalLabel">Edit Data Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="edit-id">
                    <div class="form-group">
                        <label for="edit-nama-barang">Nama Barang</label>
                        <select class="form-control" id="edit-nama-barang" name="barang_id">
                            <option value="">Pilih Barang</option>
                            @foreach ($masuk as $item)
                            <option value="{{ $item->id }}" id="option-{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="edit-tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="edit-keterangan">Keterangan</label>
                        <textarea class="form-control" id="edit-keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-kuantitas">Kuantitas</label>
                        <input type="number" class="form-control" id="edit-kuantitas" name="qty" min="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-warning" id="saveEditButton">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#editDataKeluarModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var id = button.data('id');
            var nama = button.data('nama');
            var tanggal = button.data('tanggal');
            var keterangan = button.data('keterangan');
            var qty = button.data('qty');

            // Mengisi inputan modal dengan data dari tombol Edit
            var modal = $(this);
            modal.find('#edit-id').val(id);
            modal.find('#edit-nama-barang').val(nama);

            // Pastikan format tanggal sesuai dengan input type="date"
            if (tanggal) {
                const formattedDate = new Date(tanggal).toISOString().split('T')[0]; // Format ke YYYY-MM-DD
                modal.find('#edit-tanggal').val(formattedDate);
            } else {
                modal.find('#edit-tanggal').val(''); // Atur ke kosong jika tidak ada tanggal
            }

            modal.find('#edit-keterangan').val(keterangan);
            modal.find('#edit-kuantitas').val(qty);

            // Atur action form dengan route yang benar
            var actionUrl = '{{ route("keluar.update", ":id") }}';
            actionUrl = actionUrl.replace(':id', id); // Ganti :id dengan ID data masuk
            $('#editForm').attr('action', actionUrl); // Set action
        });

        $('#saveEditButton').on('click', function(event) {
            event.preventDefault();
            var form = $('#editForm');

            $.ajax({
                url: form.attr('action'), // Ambil action dari form
                method: 'POST',
                data: form.serialize(), // Kirim data dari form
                success: function(response) {
                    $('#editDataKeluarModal').modal('hide');
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