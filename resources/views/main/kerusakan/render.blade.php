{{-- Modal --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kerusakan</h5>
            </div>
            <div class="modal-body">
                <table class="table table-responsive table-hover table-stripped" style="width: 100%" id="tableDetail">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sarana</th>
                            <th>Jumlah</th>
                            <th>Kepemilikan</th>
                            <th>Keterangan</th>
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

{{-- Filter Modal & Print Modal --}}
<div id="filter-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Title</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label mb-10" for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <option value="Semua">Semua Data</option>
                        <option value="Range Waktu">Rentang Waktu</option>
                    </select>
                </div>

                <div class="row range-date" hidden>
                    <div class="col-md-6">
                        <div class="form-group" id="tanggal-awal">
                            <label class="control-label mb-10">Tanggal Awal</label>
                            <input type="date" class="form-control tanggal-awal" name="tanggal_awal">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-tanggal-awal"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group" id="tangal-akhir">
                            <label class="control-label mb-10">Tanggal Akhir</label>
                            <input type="date" class="form-control tanggal-akhir" name="tanggal_akhir">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-tanggal-akhir"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-outline btn-print-data">Cetak</button>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-left">
                {{-- <button class="btn btn-info btn-rounded btn-lable-wrap left-label btn-filter"> <span
                        class="btn-label"><i class="fa fa-search white-icon"></i> </span><span class="btn-text">Saring
                        Data</span></button> --}}
                <button class="btn btn-default btn-rounded btn-lable-wrap left-label btn-print ml-10"> <span
                        class="btn-label"><i class="fa fa-print white-icon"></i> </span><span class="btn-text">Cetak
                        Data</span></button>
            </div>
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
                                    <th>Tanggal</th>
                                    {{-- <th>Nama Peminjam</th> --}}
                                    {{-- <th>Keterangan</th> --}}
                                    <th>Sarana</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kerusakan as $kerusakan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kerusakan->tanggal }}</td>
                                        {{-- <td>{{ $kerusakan->keterangan }}</td> --}}
                                        <td>
                                            <a href="javascript:void(0)" class="detail-kerusakan"
                                                data-id="{{ $kerusakan->id }}">
                                                Lihat
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-icon-anim btn-square btn-sm btn-edit"
                                                    data-id="{{ $kerusakan->id }}"><i class="fa fa-pencil"></i></button>
                                                <button
                                                    class="btn btn-danger btn-icon-anim btn-square btn-sm btn-delete"
                                                    data-id="{{ $kerusakan->id }}"><i class="icon-trash"></i></button>
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
            order: [
                [0, 'desc']
            ],
            "rowCallback": function(row, data, index) {
                // Set the row number as the first cell in each row
                $('td:eq(0)', row).html(index + 1);
            }
        });

        $('.detail-kerusakan').click(function() {
            $('#modal').modal('show')
            var id = $(this).data('id');

            $('#tableDetail tbody').empty();
            $.get("/kerusakan/detail/" + id, function(data) {
                $.each(data, function(index, value) {
                    let tr_list = '<tr>';
                    tr_list += '<td>' + (index + 1) + '</td>';
                    tr_list += '<td>' + value.namaSarana + '</td>';
                    tr_list += '<td>' + value.jumlah + '</td>';
                    tr_list += '<td>' + value.kepemilikan + '</td>';
                    tr_list += '<td>' + value.keterangan + '</td>';
                    tr_list += '</tr>';

                    $('#tableDetail tbody').append(tr_list);
                });
            });
        });

        // filter modal
        $('.btn-print').on('click', function() {
            $('#filter-modal').modal('show')
            $('#filter-modal .modal-title').text('Cetak Data')
            $('.btn-print-data').prop('disabled', true)
            // $('.btn-search').hide()
            $('.btn-print-data').show();
        });

        $('#kategori').on('change', function() {

            let value = $(this).val();
            let title = $('#filter-modal .modal-title').text();

            $('.range-date').prop('hidden', value !== 'Range Waktu');

            const $button = title == 'Saring Data' ? $('.btn-search') : $('.btn-print-data');
            $button.prop('disabled', value !== 'Semua');
        });

        function validateField(fieldClass, errorClass, errorMessage) {
            const value = $(fieldClass).val();
            const formGroup = $(fieldClass).closest('.form-group');
            const errorElement = formGroup.find(errorClass);

            if (value === '') {
                formGroup.addClass('has-error has-danger');
                errorElement.text(errorMessage);
            } else {
                formGroup.removeClass('has-error has-danger');
                errorElement.text('');
            }
        }

        function validateDates() {
            const tanggalAwal = $('.tanggal-awal').val();
            const tanggalAkhir = $('.tanggal-akhir').val();

            // Mengaktifkan atau menonaktifkan tombol pencarian
            // let title = $('#filter-modal .modal-title').text();
            // if (title == 'Saring Data') {
            //     $('.btn-search').prop('disabled', !tanggalAwal || !tanggalAkhir);
            // } else {
            //     $('.btn-print-data').prop('disabled', !tanggalAwal || !tanggalAkhir);
            // }

            let title = $('#filter-modal .modal-title').text();
            let $button = title == 'Saring Data' ? $('.btn-search') : $('.btn-print-data');
            $button.prop('disabled', !tanggalAwal || !tanggalAkhir);

            // Validasi individual tanggal
            validateField('.tanggal-awal', '.error-tanggal-awal', 'Mohon isi tanggal awal');
            validateField('.tanggal-akhir', '.error-tanggal-akhir', 'Mohon isi tanggal akhir');

            // Validasi bahwa tanggal akhir tidak sebelum tanggal awal
            if (tanggalAwal && tanggalAkhir) {
                const dateAwal = new Date(tanggalAwal);
                const dateAkhir = new Date(tanggalAkhir);

                if (dateAkhir < dateAwal) {
                    $('#tangal-akhir').addClass('has-error has-danger');
                    $('.error-tanggal-akhir').text('Tanggal akhir tidak boleh kurang dari tanggal awal');
                    $('.btn-search').prop('disabled', true);
                } else {
                    $('#tangal-akhir').removeClass('has-error has-danger');
                    $('.error-tanggal-akhir').text('');
                }
            }
        }

        $('.tanggal-awal, .tanggal-akhir').on('change', validateDates);

        // Cetak Data
        $("body").on("click", ".btn-print-data", function() {
            let tanggalAwal = $('.tanggal-awal').val();
            let tanggalAkhir = $('.tanggal-akhir').val();
            let kategori = $('#kategori').val();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            Swal.fire({
                title: "Cetak data kerusakan?",
                text: "Laporan akan dicetak",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, cetak!",
            }).then((result) => {
                if (result.value) {
                    var mode = "iframe"; //popup
                    var close = mode == "popup";
                    var options = {
                        mode: mode,
                        popClose: close,
                        popTitle: "LaporanDataKerusakan",
                        popOrient: "Landscape",
                    };
                    $.ajax({
                        type: "POST",
                        url: "kerusakan/print",
                        data: {
                            tanggal_awal: tanggalAwal,
                            tanggal_akhir: tanggalAkhir,
                            kategori: kategori
                        },
                        success: function(response) {
                            document.title =
                                "SIM Sarana | SMA Tunas Daud - Print" +
                                new Date().toJSON().slice(0, 10).replace(/-/g, "/");
                            $(response.data)
                                .find("div.printableArea")
                                .printArea(options);
                        },
                    });
                }
            });
        });
    });
</script>
