//Variabel Link
var url = 'http://127.0.0.1/pmi/';

$(document).ready(function() {
    tbl_delete();
    tbl_show();
    tbl_datatransaksi();
    modalsPendonor();
    $('[data-toggle="tooltip"]').tooltip({
        'selector': '',
        'placement': 'top',
        'container': 'body'
    });
    $('#showMap').click(function() {
        mapInit();
    });
    $('#username_layout').hide();
    $('#password_layout').hide();
    if ($('#posisi_petugas').val() == 'Administrator Web') {
        $('#username_layout').show();
        $('#password_layout').show();
    } else {
        $('#username_layout').hide();
        $('#password_layout').hide();
    }

    $('#transaksiperbulan').datepicker({
        format: "yyyy-mm",
        startView: "months",
        minViewMode: "months"
    })

    $('#transaksiperhari').datepicker({
        format: "yyyy-mm-dd",
        startView: "day",
        minViewMode: "day"
    })
})

function sembunyiform() {
    $(document).ready(function() {
        $("#form_tabel").hide();
        $("#statusOK").hide();
        $("#statusBAD").hide();
        $("#statusBAD2").hide();

    });
}

function tbl_delete() {
    $(".delete_class").click(function() {
        var tabel = $(this).attr('tabel');
        var id = $(this).attr('id');
        var col = $(this).attr('col');
        $.ajax({
            url: url+'kontent/hapus.php',
            type: 'GET',
            timeout: 3000,
            data: {
                tabel: tabel,
                col: col,
                id: id
            },
            success: function(data) {
                switch (data) {
                    case 'success':
                        $("#infoSalah").html('Sukses Menghapus! <br/> Harap Menungu Halaman Akan Di Refresh!');
                        $("#infoJudul").html("Informasi");
                        $("#statusHapus").hide();
                        $("#statusOK").show();
                        setTimeout(function() {
                            location.reload();
                        }, 3000);

                        break;
                    case 'fail':
                        $("#infoSalah").html('Gagal Menghapus! <br/> Coba Lagi atau Tutup Dialog Ini!');
                        $("#infoJudul").html("Informasi");
                        $("#statusHapus").show();
                        $("#statusOK").hide();
                        break;
                }
            },
            error: function() {

            }
        });
    });
}


function pilihpendonor() {
    var item = $("#id_pendonor").find(':selected').attr('namapendonor');
    if (item == "") {
        $("#infoSalah").html("Harap Memilih Data Pendonor!");
        $("#modalInfo").modal();
        $("#buttonKembali").hide();
        document.getElementById("nomor_kantong_darah").disabled = true;
        document.getElementById("nama_pendonor_disabled").value = "";
        document.getElementById("gol_dar").value = "";
        document.getElementById("gol_dar_disabled").value = "";
        document.getElementById("nama_pendonor").value = "";
    } else {
        document.getElementById("nomor_kantong_darah").disabled = false;
        document.getElementById("nama_pendonor_disabled").value = $("#id_pendonor").find(':selected').attr('namapendonor');
        document.getElementById("nama_pendonor").value = $("#id_pendonor").find(':selected').attr('namapendonor');
        var data = $("#id_pendonor").find(':selected').attr('identitas');
        var datakantong = $("#id_pendonor").find(':selected').attr('kantong');
        $.ajax({
            url: url+'kontent/transaksitambahdata.php',
            type: 'POST',
            timeout: 3000,
            data: {
                data: data,
                datakantong: datakantong
            },
            success: function(data) {
                $("#nomor_kantong_darah").html(data);
            },
            error: function() {

            }
        });

    }
}

function pilihgoldar() {
    var item = $("#nomor_kantong_darah").find(':selected').attr('goldar');
    if (item == "") {
        $("#infoSalah").html("Harap Memilih Nomor Kantong!");
        $("#modalInfo").modal();
        $("#buttonKembali").hide();
        document.getElementById("gol_dar").value = "";
        document.getElementById("gol_dar_disabled").value = "";
    } else {
        document.getElementById("gol_dar_disabled").value = $("#nomor_kantong_darah").find(':selected').attr('goldar');
        document.getElementById("gol_dar").value = $("#nomor_kantong_darah").find(':selected').attr('goldar');
    }
}

function pilihjadwal2() {
    var item = $("#id_jadwal").find(':selected').attr('idjad');
    if (item == "") {
        $("#infoSalah").html("Harap Memilih Jadwal!");
        $("#modalInfo").modal();
        $("#buttonKembali").hide();
        document.getElementById("tanggal_disabled").value = "";
        document.getElementById("tanggal").value = "";
    } else {
        document.getElementById("tanggal_disabled").value = $("#id_jadwal").find(':selected').attr('tanggal_jadwal');
        document.getElementById("tanggal").value = $("#id_jadwal").find(':selected').attr('tanggal_jadwal');
    }
}

function pilihjadwal() {
    var item = $("#jadwal").find(':selected').attr('instasi');
    if (item == "") {
        $("#infoSalah").html("Harap Memilih Jadwal!");
        $("#modalInfo").modal();
        $("#buttonKembali").hide();
        document.getElementById("instasi_disabled").value = "";
        document.getElementById("tgl_disabled").value = "";
    } else {
        document.getElementById("instasi_disabled").value = $("#jadwal").find(':selected').attr('instasi');
        document.getElementById("tgl_disabled").value = $("#jadwal").find(':selected').attr('tgl');
    }
}

function tbl_delete() {
    $(".delete_class").click(function() {
        var tabel = $(this).attr('tabel');
        var id = $(this).attr('id');
        var col = $(this).attr('col');
        $.ajax({
            url: url+'kontent/hapus.php',
            type: 'GET',
            timeout: 3000,
            data: {
                tabel: tabel,
                col: col,
                id: id
            },
            success: function(data) {
                switch (data) {
                    case 'success':
                        $("#infoSalah").html('Sukses Menghapus! <br/> Harap Menungu Halaman Akan Di Refresh!');
                        $("#infoJudul").html("Informasi");
                        $("#statusHapus").hide();
                        $("#statusOK").show();
                        setTimeout(function() {
                            location.reload();
                        }, 3000);

                        break;
                    case 'fail':
                        $("#infoSalah").html('Gagal Menghapus! <br/> Coba Lagi atau Tutup Dialog Ini!');
                        $("#infoJudul").html("Informasi");
                        $("#statusHapus").show();
                        $("#statusOK").hide();
                        break;
                }
            },
            error: function() {

            }
        });
    });
}


function petugas_level() {
    if ($('#posisi_petugas').val() == 'Administrator Web') {
        $('#username_layout').show();
        $('#password_layout').show();
    } else {
        $('#username_layout').hide();
        $('#password_layout').hide();
    }
}

function infoTranskasiKosong() {
    $(document).ready(function() {
        $("#infoSalah").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
        $("#modalInfo").modal();
        $("#buttonKembali").show();
        $("#buttonOK").hide();
    });
}

function tbl_show() {
    $(".modals").click(function() {
        var id = $(this).attr('id');
        var halaman = $(this).attr('hal');
        var kolom = $(this).attr('col');
        $.ajax({
            url: url+'kontent/modals.php',
            type: 'POST',
            timeout: 3000,
            data: {
                id: id,
                halaman: halaman,
                col: kolom
            },
            success: function(data) {
                $("#infoSalah").html(data);
                $("#infoJudul").html("Informasi");
                $("#statusHapus").hide();
                $("#statusOK").show();
            },
            error: function() {

            }
        });
    });
}



function tbl_datatransaksi() {
    $(".tampilkanTabelPerpendonor").click(function() {
        var data = $("#tarnsasksiperpendonor").val()
        var tipe = $(this).attr('tipe');
        if (data.length == 0) {
            $("#infoSalah2").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
            $("#modalInfo2").modal();
        } else {
            $.ajax({
                url: url+'kontent/transaksidata.php',
                type: 'POST',
                timeout: 3000,
                data: {
                    data: data,
                    tipe: tipe
                },
                success: function(data) {
                    $("#tabelperpendonor").html(data);
                },
                error: function() {

                }
            });
        };
    });

    $(".tampilkanTabelPerhari").click(function() {
        var data = $("#transaksiperhari").val()
        var tipe = $(this).attr('tipe');
        if (data.length == 0) {
            $("#infoSalah2").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
            $("#modalInfo2").modal();
        } else {
            $.ajax({
                url: url+'kontent/transaksidata.php',
                type: 'POST',
                timeout: 3000,
                data: {
                    data: data,
                    tipe: tipe
                },
                success: function(data) {
                    $("#tabelperhari").html(data);
                },
                error: function() {

                }
            });
        };
    });

    $(".tampilkanTabelPerbulan").click(function() {
        var data = $("#transaksiperbulan").val()
        var tipe = $(this).attr('tipe');
        if (data.length == 0) {
            $("#infoSalah2").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
            $("#modalInfo2").modal();
        } else {
            $.ajax({
                url: url+'kontent/transaksidata.php',
                type: 'POST',
                timeout: 3000,
                data: {
                    data: data,
                    tipe: tipe
                },
                success: function(data) {
                    $("#tableperbulan").html(data);
                },
                error: function() {

                }
            });
        };
    });
}

function modalsPendonor() {
    $(".pilihPendonor").click(function() {
        $.ajax({
            url: url+'kontent/transaksipendonor_pilih.php',
            success: function(data) {
                $("#infoSalah").html(data);
                $("#infoJudul").html("Pilih Pendonor");
                $("#statusHapus").hide();
                $("#statusOK").show();
            },
            error: function() {

            }
        });
    });
}

function pilihanpendonorModals(elemntpendonor) {
    var elementPencarianPendonor = document.getElementById('tarnsasksiperpendonor');
    var dataTerpilih = document.getElementById('pilihandata');
    elementPencarianPendonor.value = elemntpendonor.innerHTML;
    dataTerpilih.innerHTML = "Data Yang Pilih : " + elemntpendonor.innerHTML;
}

function formHapus(pesan, id_data) {
    $(document).ready(function() {
        var tombolhapus = document.getElementsByClassName("delete_class")[0];
        $("#infoSalah").html(pesan);
        $("#infoJudul").html("Hapus?");
        $("#statusOK").hide();
        $("#statusHapus").show();
        tombolhapus.setAttribute("id", id_data);
        $("#modalInfo").modal();
    })
}

function infoPendonor() {
    $(document).ready(function() {
        $("#statusHapus").hide();
        $("#statusOK").show();
        $("#modalInfo").modal();
    })
}

function cekpassword() {
    $(document).ready(function() {
        var password = $("#password_baru_profile").val();
        var confirmPassword = $("#password_baru_verifikasi_profile").val();

        if (password != confirmPassword) {
            document.getElementById("verif_password").classList.add("has-error");
            document.getElementById("verif_password").classList.remove("has-success");
            $("#statuspassword").html("Passwords Tidak Sama!");
        } else {
            document.getElementById("verif_password").classList.remove("has-error");
            document.getElementById("verif_password").classList.add("has-success");
            $("#statuspassword").html("Passwords Sama.");
        }
    })
}

function calloutInfo(status, judul, isi) {
    $(document).ready(function() {
        if (status == 'gagal') {
            document.getElementById("statusOK").classList.add("callout-danger");
        } else {
            document.getElementById("statusOK").classList.add("callout-info");
        }
        $("#isiInfo").html(isi);
        $("#judulInfo").html(judul);
        $("#statusOK").show();
    })
}

function cekKebenaran(halaman, batas, idelement, pesan) {
    $(document).ready(function() {
        var value = $(idelement).val().length;
        if (value < batas) {
            $("#infoSalah").html(pesan);
            $("#modalInfo").modal();
            $("#buttonKembali").hide();
        } else {
            if (halaman == 'ubah') {
                $("#buttonKembali").show();
            } else {

            }
        }
    })
}

function errorPemilihandata() {
    $(document).ready(function() {
        $("#infoSalah").html("Data Yang Dipilih Salah!");
        $("#modalInfo").modal();
        $("#buttonKembali").show();
        $("#buttonOK").hide();
        $("#infoAlamat").hide();
    });
}


function mapInit() {
    var modalElm = $('#mapModal');
    var LatLng = new google.maps.LatLng(-8.6726769, 115.1542327);
    var opsi = {
        zoom: 12,
        center: LatLng
    };
    map = new google.maps.Map($('#map-canvas')[0], opsi);


    modalElm.modal('show');
    modalElm.on('shown.bs.modal', function() {
        google.maps.event.trigger(map, 'resize');
        map.setCenter(LatLng);
    });
    modalElm.on('hide.bs.modal', function() {
        /// clear canvas
        $('#map-canvas').html('');
    })

    var geocoder = new google.maps.Geocoder();

    google.maps.event.addListener(map, 'click', function(event) {
        geocoder.geocode({
            'latLng': event.latLng
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $("#infoAlamat").show();
                    document.getElementById("lat_peta_jadwal").value = event.latLng.lat();
                    document.getElementById("lng_peta_jadwal").value = event.latLng.lng();
                    document.getElementById("link_peta_jadwal").value = "https://www.google.com/maps/place/?q=place_id:" + results[0].place_id;
                    var address = results[0].formatted_address;
                    var splitAddress = new Array();
                    splitAddress = address.split(",");
                    document.getElementById("lokasi_jadwal").value = splitAddress[0] + ", " + splitAddress[1];
                    document.getElementById("infoAlamat").innerHTML = "Lokasi Yang Di Pilih : " + splitAddress[0] + ", " + splitAddress[1];
                }
            }
        });
    });


}

function hanyaNomor(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}