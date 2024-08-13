<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
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
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->username }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->is_active == true ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-icon-anim btn-square btn-sm btn-edit"
                                                    data-id="{{ $siswa->id }}"><i class="fa fa-pencil"></i></button>
                                                <button
                                                    class="btn btn-danger btn-icon-anim btn-square btn-sm btn-delete"
                                                    data-id="{{ $siswa->id }}"><i class="icon-trash"></i></button>
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
