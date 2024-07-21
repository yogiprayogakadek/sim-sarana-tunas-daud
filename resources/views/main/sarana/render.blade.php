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
                                    <th>Nama Sarana</th>
                                    <th>Jumlah</th>
                                    <th>Foto</th>
                                    <th>Kepemilikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sarana as $sarana)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sarana->nama }}</td>
                                        <td>{{ $sarana->jumlah }}</td>
                                        <td>
                                            <img src="{{asset($sarana->foto)}}" width="100px">
                                        </td>
                                        <td>{{ $sarana->kepemilikan }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-icon-anim btn-square btn-sm btn-edit"
                                                    data-id="{{ $sarana->id }}"><i class="fa fa-pencil"></i></button>
                                                <button
                                                    class="btn btn-danger btn-icon-anim btn-square btn-sm btn-delete"
                                                    data-id="{{ $sarana->id }}"><i class="icon-trash"></i></button>
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
        $('#table').DataTable({
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
    });
</script>
