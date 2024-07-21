function getData() {
    $.ajax({
        type: "get",
        url: "/peminjaman/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function tambah() {
    $.ajax({
        type: "get",
        url: "/peminjaman/create",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-tambah', function () {
        tambah();
    });

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    $('body').on('click', '.checkbox-sarana', function() {
        let value = $(this).is( ":checked" );
        let id = $(this).data('id');

        if(value == true){
            $('#jumlah-peminjaman'+id).prop('disabled', false);
            if($('#jumlah-peminjaman-group-'+id).val() == '') {
                $('#jumlah-peminjaman-group-'+id).addClass('has-error has-danger');
                $('.error-jumlah-peminjaman-'+id).html('mohon isi jumlah')
                $('.btn-send').attr('disabled', true)
            }
        } else {
            $('#jumlah-peminjaman'+id).prop('disabled', true);

            $('#jumlah-peminjaman-group-'+id).removeClass('has-error has-danger');
            $('.error-jumlah-peminjaman-'+id).html('')
            $('.btn-send').attr('disabled', false)
        }

        if($('body').find('.has-error').length) {
            $('.btn-send').attr('disabled', true)
        }

        if($('input:checkbox:checked').length == 0) {
            $('.btn-send').attr('disabled', true)
        }
    })

    $('body').on('keyup', '.jumlah-peminjaman', function() {
        let id = $(this).data('id');
        let jumlahPeminjaman = parseInt($(this).val());
        let stok = parseInt($(this).data('jumlah'))
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

        if(jumlahPeminjaman > stok || isNaN(jumlahPeminjaman)) {
            $('#jumlah-peminjaman-group-'+id).addClass('has-error has-danger');
            $('.error-jumlah-peminjaman-'+id).html('stok tidak mencukupi')
            $('.btn-send').attr('disabled')
        } else {
            $('#jumlah-peminjaman-group-'+id).removeClass('has-error has-danger');
            $('.error-jumlah-peminjaman-'+id).html('')
            $('.btn-send').removeAttr('disabled')
        }
    })

    // on save button
    $("body").on("click", ".btn-save", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // CREATE LOCALSTORAGE
        localStorage.clear()
        // Retrieve existing listSarana from localStorage or create an empty array
        let listSarana = localStorage.getItem('listSarana') ? JSON.parse(localStorage.getItem(
            'listSarana')) : [];
        let dataArray = listSarana && Array.isArray(listSarana) ? listSarana : [];

        let tempData = {
            'data': []
        };

        $('.checkbox-sarana:checked').each(function() {
            let jumlah = $(this).closest('tr').find('input.jumlah-peminjaman').val();
            let saranaId = $(this).data('id');
            let namaSarana = $(this).data('nama');
            let kepemilikan = $(this).data('kepemilikan');

            let data = {
                'saranaId': saranaId,
                'jumlah': parseInt(jumlah),
                'namaSarana': namaSarana,
                'kepemilikan': kepemilikan,
            };

            tempData.data.push(data);
        });

        dataArray.push(tempData);

        // Update the listSarana in localStorage
        localStorage.setItem('listSarana', JSON.stringify(dataArray));
        // END LOCALSTORAGE

        let tanggal = $('input[name=tanggal]').val();
        let namaPeminjam = $('input[name=nama_peminjam]').val();
        let keterangan = $('#keterangan').val();

        let form = $("#formAdd")[0];
        let data = new FormData(form);
        data.append('list_sarana', localStorage.getItem('listSarana'))
        if(tanggal == '' || namaPeminjam == '' || keterangan == '' || localStorage.length == 0 || JSON.parse(localStorage.getItem('listSarana'))[0]['data'].length == 0) {
            Swal.fire('Warning', 'Mohon untuk melengkapi form', 'error');
        } else {
            $.ajax({
                type: "POST",
                url: "/peminjaman/store",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $(".btn-save").html("Mohon tunggu...").prop('disabled', true);
                },
                done: function () {
                    $(".btn-save").html("Simpan").prop('disabled', false);
                },
                success: function (response) {
                    $(".with-validation").removeClass("has-error has-danger");
                    Swal.fire(response.title, response.message, response.status);
                    if (response.status == "success") {
                        getData();
                    }
                },
                error: function (error) {
                    let formName = [];
                    let errorName = [];

                    $.each($("#formAdd").serializeArray(), function (i, field) {
                        formName.push(field.name.replace(/\[|\]/g, ""));
                    });
                    if (error.status == 422) {
                        if (error.responseJSON.errors) {
                            $.each(
                                error.responseJSON.errors,
                                function (key, value) {
                                    errorName.push(key);
                                    if ($("." + key).val() == "") {
                                        $("." + key).addClass("has-error has-danger");
                                        $(".error-" + key).html(value);
                                    }
                                }
                            );

                            $.each(formName, function (i, field) {
                                if ($.inArray(field, errorName) == -1) {
                                    $("." + field).removeClass("has-error has-danger");
                                    console.log(field)
                                    $(".error-" + field).html('');
                                } else {
                                    $("." + field).addClass("has-error has-danger");
                                }
                            });
                        }
                    }
                    $(".btn-save").html("Simpan").prop('disabled', false);
                },
            });
        }
    });

    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $.ajax({
            type: "get",
            url: "/peminjaman/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // on save update
    $("body").on("click", ".btn-update", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        // CREATE LOCALSTORAGE
        localStorage.clear()
        // Retrieve existing listSarana from localStorage or create an empty array
        let listSarana = localStorage.getItem('listSarana') ? JSON.parse(localStorage.getItem(
            'listSarana')) : [];
        let dataArray = listSarana && Array.isArray(listSarana) ? listSarana : [];

        let tempData = {
            'data': []
        };

        $('.checkbox-sarana:checked').each(function() {
            let jumlah = $(this).closest('tr').find('input.jumlah-peminjaman').val();
            let saranaId = $(this).data('id');
            let namaSarana = $(this).data('nama');
            let kepemilikan = $(this).data('kepemilikan');

            let data = {
                'saranaId': saranaId,
                'jumlah': parseInt(jumlah),
                'namaSarana': namaSarana,
                'kepemilikan': kepemilikan,
            };

            tempData.data.push(data);
        });

        dataArray.push(tempData);

        // Update the listSarana in localStorage
        localStorage.setItem('listSarana', JSON.stringify(dataArray));
        // END LOCALSTORAGE

        let tanggal = $('input[name=tanggal]').val();
        let namaPeminjam = $('input[name=nama_peminjam]').val();
        let keterangan = $('#keterangan').val();

        let form = $("#formUpdate")[0];
        let data = new FormData(form);
        data.append('list_sarana', localStorage.getItem('listSarana'))
        if(tanggal == '' || namaPeminjam == '' || keterangan == '' || localStorage.length == 0 || JSON.parse(localStorage.getItem('listSarana'))[0]['data'].length == 0) {
            Swal.fire('Warning', 'Mohon untuk melengkapi form', 'error');
        } else {
            $.ajax({
                type: "POST",
                url: "/peminjaman/update",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $(".btn-update").html("Mohon tunggu...").prop('disabled', true);
                },
                done: function () {
                    $(".btn-update").html("Simpan").prop('disabled', false);
                },
                success: function (response) {
                    console.log(response)
                    $(".with-validation").removeClass("has-error has-danger");
                    Swal.fire(response.title, response.message, response.status);
                    if (response.status == "success") {
                        getData();
                    }
                },
                error: function (error) {
                    let formName = [];
                    let errorName = [];

                    $.each($("#formUpdate").serializeArray(), function (i, field) {
                        formName.push(field.name.replace(/\[|\]/g, ""));
                    });
                    if (error.status == 422) {
                        if (error.responseJSON.errors) {
                            $.each(
                                error.responseJSON.errors,
                                function (key, value) {
                                    errorName.push(key);
                                    if ($("." + key).val() == "") {
                                        $("." + key).addClass("has-error has-danger");
                                        $(".error-" + key).html(value);
                                    }
                                }
                            );

                            $.each(formName, function (i, field) {
                                if ($.inArray(field, errorName) == -1) {
                                    $("." + field).removeClass("has-error has-danger");
                                    console.log(field)
                                    $(".error-" + field).html('');
                                } else {
                                    $("." + field).addClass("has-error has-danger");
                                }
                            });
                        }
                    }
                    $(".btn-update").html("Simpan").prop('disabled', false);
                },
            });
        }
    });

    // trigger button delete
    $("body").on("click", ".btn-delete", function () {
        let id = $(this).data('id');
        Swal.fire({
            icon: 'warning',
            // icon: 'error',
            title: "Yakin ingin menghapus data ini?",
            text: 'hapus data',
            showCancelButton: true,
            confirmButtonText: "Hapus",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $.ajax({
                            type: "POST",
                            url: "/peminjaman/delete",
                            data: {
                                id: id,
                            },
                        })
                        .done(function (response) {
                            getData();
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            );
                        })
                        .fail(function (response) {
                            // toastr[response.status](response.message, response.title);
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            );
                        });
                });
            },
            allowOutsideClick: false,
        });
    });
});
