{{-- Modal --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Peminjaman</h5>
            </div>
            <div class="modal-body">
                <table class="table table-responsive table-hover table-stripped" style="width: 100%" id="tableDetail">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sarana</th>
                            <th>Jumlah</th>
                            <th>Kepemilikan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- END MODAL --}}

<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-tambah"> <span
                        class="btn-label"><i class="fa fa-plus white-icon"></i> </span><span class="btn-text">Tambah
                        Data</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap">
                    <div class="">
                        <table id="table" class="table table-hover display  pb-30">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Nama Peminjam</th>
                                    <th>Keterangan</th>
                                    <th>Sarana</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $peminjaman)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $peminjaman->tanggal }}</td>
                                        <td>{{ $peminjaman->nama_peminjam }}</td>
                                        <td>{{ $peminjaman->keterangan }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="detail-peminjaman" data-id="{{$peminjaman->id}}">
                                                Lihat
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-icon-anim btn-square btn-sm btn-edit"
                                                    data-id="{{ $peminjaman->id }}"><i class="fa fa-pencil"></i></button>
                                                <button
                                                    class="btn btn-danger btn-icon-anim btn-square btn-sm btn-delete"
                                                    data-id="{{ $peminjaman->id }}"><i class="icon-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table, #tableDetail').DataTable({
            responsive: true,
            language: {
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya"
                },
                info: "Menampilkan _START_ to _END_ from _TOTAL_ data",
                infoEmpty: "Menampilkan 0 to 0 from 0 data",
                lengthMenu: "Menampilkan _MENU_ data",
                search: "Cari:",
                emptyTable: "Datanya tidak ada",
                zeroRecords: "Data tidak cocok",
                loadingRecords: "Memuat..",
                processing: "Pengolahan...",
                infoFiltered: "(disaring dari _MAX_ total data)"
            },
            lengthMenu: [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "Semua"]
            ],
            order: [[0, 'desc']],
            "rowCallback": function(row, data, index) {
                // Set the row number as the first cell in each row
                $('td:eq(0)', row).html(index + 1);
            }
        });

        $('.detail-peminjaman').click(function() {
            $('#modal').modal('show')
            var id = $(this).data('id');

            $('#tableDetail tbody').empty();
            $.get("/peminjaman/detail/"+id, function (data) {
                $.each(data, function (index, value) {
                    let tr_list = '<tr>';
                        tr_list += '<td>'+(index+1)+'</td>';
                        tr_list += '<td>'+value.namaSarana+'</td>';
                        tr_list += '<td>'+value.jumlah+'</td>';
                        tr_list += '<td>'+value.kepemilikan+'</td>';
                        tr_list += '</tr>';

                    $('#tableDetail tbody').append(tr_list);
                });
            });
        });
    });
</script>
