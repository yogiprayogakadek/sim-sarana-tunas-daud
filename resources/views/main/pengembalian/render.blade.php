{{-- Modal --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Pengembalian</h5>
            </div>
            <form id="formValidasi">
                <div class="modal-body">
                    <div class="form-group mb-0 mb-15 with-validation tanggal will-hide" id="tanggal-group">
                        <label class="control-label mb-10 " for="tanggal">Tanggal Pengembalian</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control"
                            placeholder="tanggal pengembalian"
                            value="{{ auth()->user()->role == 'Siswa' ? date('Y-m-d') : '' }}"
                            {{ auth()->user()->role == 'Siswa' ? 'readonly' : '' }}>
                        <div class="help-block with-errors error-message">
                            <ul class="list-unstyled">
                                <li class="error-tanggal"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group mb-0 mb-15 with-validation keterangan will-hide" id="keterangan-group">
                        <label class="control-label mb-10 " for="keterangan">Keterangan Pengembalian</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" placeholder="keterangan"
                            {{ auth()->user()->role == 'Siswa' ? 'readonly' : '' }}></textarea>
                        <div class="help-block with-errors error-message">
                            <ul class="list-unstyled">
                                <li class="error-keterangan"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group mb-0 mb-15 will-hide">
                        <input type="hidden" name="peminjaman_id" id="peminjaman_id" class="form-control">
                        {{-- <label class="control-label mb-10">Status Pengembalian</label>
                        <select name="status" id="status" class="form-control status">
                            <option value="Belum Dikembalikan">Belum Dikembalikan</option>
                            <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
                        </select> --}}
                    </div>
                    <hr style="margin-bottom: -0.2rem">
                    <table class="table table-hover table-stripped" id="tableDetail" style="width: 100%">
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success btn-validasi will-hide">Simpan</button>
                </div>
            </form>
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
            {{-- <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-tambah"> <span
                        class="btn-label"><i class="fa fa-plus white-icon"></i> </span><span class="btn-text">Tambah
                        Data</span></button>
            </div>
            <div class="clearfix"></div> --}}
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
                                    <th>Tanggal Pengembalian</th>
                                    <th>Lama Peminjaman</th>
                                    <th>Nama Peminjam</th>
                                    <th>Keterangan</th>
                                    {{-- <th>Sarana</th> --}}
                                    <th>Status</th>
                                    <th>Info</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $peminjaman)
                                    @php
                                        $currentDate = date('Y-m-d');
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $peminjaman->tanggal }}</td>
                                        <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                                        <td>{{ diffDate($peminjaman->tanggal_pengembalian, $peminjaman->tanggal) }} hari
                                        </td>
                                        <td>{{ $peminjaman->user->nama }}</td>
                                        <td>{{ $peminjaman->keterangan }}</td>
                                        {{-- <td>
                                            <a href="javascript:void(0)" class="detail-peminjaman" data-id="{{$peminjaman->id}}">
                                                Lihat
                                            </a>
                                        </td> --}}
                                        <th class="text-center">
                                            <span>{{ $peminjaman->pengembalian->status ?? 'Belum Dikembalikan' }}</span>
                                            @if ($peminjaman->pengembalian->tanggal > $peminjaman->tanggal_pengembalian)
                                                {{-- @if ($currentDate > $peminjaman->tanggal_pengembalian) --}}
                                                <span class="badge badge-danger">Terkena denda</span>
                                            @endif
                                        </th>
                                        <th>
                                            @if ($peminjaman->pengembalian->tanggal > $peminjaman->tanggal_pengembalian)
                                                {{-- @if ($currentDate > $peminjaman->tanggal_pengembalian) --}}
                                                <p>Tanggal pengembalian sudah lewat
                                                    {{ diffDate($peminjaman->pengembalian->tanggal, $peminjaman->tanggal_pengembalian) }}
                                                    {{-- {{ diffDate($currentDate, $peminjaman->tanggal_pengembalian) }} --}}
                                                    hari, mohon dikembalikan untuk menghindari denda
                                                </p>
                                            @else
                                                -
                                            @endif
                                        </th>
                                        <td>
                                            <div class="btn-group">
                                                <button
                                                    class="btn btn-success btn-icon-anim btn-square btn-sm detail-peminjaman"
                                                    data-id="{{ $peminjaman->id }}"
                                                    data-current="{{ $currentDate }}"
                                                    data-pengembalian="{{ $peminjaman->tanggal_pengembalian }}"
                                                    data-approve="{{ $peminjaman->is_approve }}"><i
                                                        class="fa fa-eye"></i></button>
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

        $('.detail-peminjaman').click(function() {
            $('#modal').modal('show')
            var id = $(this).data('id');
            var currentDate = $(this).data('current');
            var tanggalPengembalian = $(this).data('pengembalian');
            var days = new Date(Date.parse(tanggalPengembalian) - Date.parse(currentDate)) / 86400000
            var approve = $(this).data('approve');
            $('#tableDetail tbody').empty();
            $('#peminjaman_id').val(id);
            $.get("/pengembalian/detailPeminjaman/" + id, function(data) {
                if (data.tanggal != '') {
                    $('#keterangan').val(data.keterangan);
                    $('#tanggal').val(data.tanggal);
                } else {
                    if (currentDate > tanggalPengembalian) {
                        $('#keterangan').text('Tanggal pengembalian sudah lewat ' + days +
                            ' hari, mohon dikembalikan untuk menghindari denda')
                    } else {
                        $('#keterangan').text('-');
                    }
                }

                if (approve != '') {
                    $('.will-hide').removeClass('hidden')
                } else {
                    $('.will-hide').addClass('hidden')
                }

                $.each(data.sarana, function(index, value) {
                    let tr_list = '<tr>';
                    tr_list += '<td>' + (index + 1) + '</td>';
                    tr_list += '<td>' + value.namaSarana + '</td>';
                    tr_list += '<td>' + value.jumlah + '</td>';
                    tr_list += '<td>' + value.kepemilikan + '</td>';
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
                title: "Cetak data pengembalian?",
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
                        popTitle: "LaporanDataPengembalian",
                        popOrient: "Landscape",
                    };
                    $.ajax({
                        type: "POST",
                        url: "pengembalian/print",
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
