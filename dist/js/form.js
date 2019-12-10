//Variabel Link
var url = 'http://127.0.0.1/pmi/';

$(document).ready(function () {
    tbl_delete();
    tbl_show();
    tbl_datatransaksi();
    tbl_datapetugas();
    modalsPendonor();
    datatable();
    form_log();
    form_laporan_transaksi();
    $('[data-toggle="tooltip"]').tooltip({
        'selector': '',
        'placement': 'top',
        'container': 'body'
    });
    $('#showMap').click(function () {
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

        

        
     
    $('#tanggal_jadwal').datepicker({
        format: "yyyy-mm-dd",
        startView: "day",
        minViewMode: "day",
    }).on("change", function () {    
        var local = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ];
        var today = new Date($('#tanggal_jadwal').datepicker('getDate'));
        $('#hari_jadwal').val(local[today.getDay()]);
    });

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
    $(document).ready(function () {
        $("#form_tabel").hide();
        $("#statusOK").hide();
        $("#statusBAD").hide();
        $("#statusBAD2").hide();

    });
}

function tbl_delete() {
    $(".delete_class").click(function () {
        var tabel = $(this).attr('tabel');
        var id = $(this).attr('id');
        var col = $(this).attr('col');
        $.ajax({
            url: url + 'kontent/hapus.php',
            type: 'GET',
            timeout: 3000,
            data: {
                tabel: tabel,
                col: col,
                id: id
            },
            success: function (data) {
                switch (data) {
                    case 'success':

                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Sukses Menghapus!,Harap Menungu Halaman Akan Di Refresh!',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                        })
                        setTimeout(function () {
                            location.reload();
                        }, 3000);

                        break;
                    case 'fail':
                        Swal.fire(
                            'Gagal!',
                            'Gagal Menghapus! <br/> Coba Lagi atau Tutup Dialog Ini!',
                            'error'
                        )
                        break;
                }
            },
            error: function () {

            }
        });
    });
}

function form_laporan_transaksi() {
    $("#formlaporantransaksi").on("submit", (function(e) {
        e.preventDefault();
        var bulandari = $("#bulandari").val();
        var bulanke = $("#bulanke").val();
            $.ajax({
                url: url + 'kontent/data_report_transaksi.php',
                type: 'POST',
                processData: false,
                contentType: false,
                data : new FormData(this),
                success: function (data) {
                    $("#laporan_transaksi").html(data);
                    datatable();
                    document.getElementById("print").href=url+"kontent/print_laporan.php?bulandari="+bulandari+"&bulanke="+bulanke; 
                },
                error: function () {

                }
            });
        }));
}


function form_log() {
    $("#formlog").on("submit", (function (e) {
        e.preventDefault();
        $.ajax({
            url: url + 'kontent/ajax/data_log.php',
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData(this),
            success: function (data) {
                $("#log_aktivitas").html(data);
                datatable();
            },
            error: function () {

            }
        });
    }));
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
            url: url + 'kontent/transaksitambahdata.php',
            type: 'POST',
            timeout: 3000,
            data: {
                data: data,
                datakantong: datakantong
            },
            success: function (data) {
                $("#nomor_kantong_darah").html(data);
            },
            error: function () {

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
    $(document).ready(function () {
        $("#infoSalah").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
        $("#modalInfo").modal();
        $("#buttonKembali").show();
        $("#buttonOK").hide();
    });
}

function tbl_show() {
    $(".modals").click(function () {
        var id = $(this).attr('id');
        var halaman = $(this).attr('hal');
        var kolom = $(this).attr('col');
        $.ajax({
            url: url + 'kontent/modals.php',
            type: 'POST',
            timeout: 3000,
            data: {
                id: id,
                halaman: halaman,
                col: kolom
            },
            success: function (data) {
                $("#infoSalah").html(data);
                $("#infoJudul").html("Informasi");
                $("#statusHapus").hide();
                $("#statusOK").show();
            },
            error: function () {

            }
        });
    });
}



function tbl_datapetugas() {
    $('a[data-toggle="tab"]').on('shown.bs.tab',function () {
        var jabatan = $('#tabpetugas li.active a').attr('href').substring(1);
        if (jabatan == "administratorweb") {
            var jabatan = "Administrator Web";
        } else if (jabatan == "semua") {
            var jabatan = "";
        }
        $.ajax({
            url: url + 'kontent/petugasperjabatan.php',
            type: 'POST',
            timeout: 3000,
            data: {
                jabatan: jabatan
            },
            success: function (data) {
                $("#semua").html(data);

            },
            error: function () {

            }
        });
    });
}

function tbl_datatransaksi() {
    $(".tampilkanTabelPerpendonor").click(function () {
        var data = $("#tarnsasksiperpendonor").val()
        var tipe = $(this).attr('tipe');
        if (data.length == 0) {
            $("#infoSalah2").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
            $("#modalInfo2").modal();
        } else {
            $.ajax({
                url: url + 'kontent/transaksidata.php',
                type: 'POST',
                timeout: 3000,
                data: {
                    data: data,
                    tipe: tipe
                },
                success: function (data) {
                    $("#tabelperpendonor").html(data);
                },
                error: function () {

                }
            });
        };
    });

    $(".tampilkanTabelPerhari").click(function () {
        var data = $("#transaksiperhari").val()
        var tipe = $(this).attr('tipe');
        if (data.length == 0) {
            $("#infoSalah2").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
            $("#modalInfo2").modal();
        } else {
            $.ajax({
                url: url + 'kontent/transaksidata.php',
                type: 'POST',
                timeout: 3000,
                data: {
                    data: data,
                    tipe: tipe
                },
                success: function (data) {
                    $("#tabelperhari").html(data);
                },
                error: function () {

                }
            });
        };
    });

    $(".tampilkanTabelPerbulan").click(function () {
        var data = $("#transaksiperbulan").val()
        var tipe = $(this).attr('tipe');
        if (data.length == 0) {
            $("#infoSalah2").html("Anda Belum Menentukan Pencarian!, Isikan Data Pencarian.");
            $("#modalInfo2").modal();
        } else {
            $.ajax({
                url: url + 'kontent/transaksidata.php',
                type: 'POST',
                timeout: 3000,
                data: {
                    data: data,
                    tipe: tipe
                },
                success: function (data) {
                    $("#tableperbulan").html(data);
                },
                error: function () {

                }
            });
        };
    });
}

function modalsPendonor() {
    $(".pilihPendonor").click(function () {
        $.ajax({
            url: url + 'kontent/transaksipendonor_pilih.php',
            success: function (data) {
                $("#infoSalah").html(data);
                $("#infoJudul").html("Pilih Pendonor");
                $("#statusHapus").hide();
                $("#statusOK").show();
            },
            error: function () {

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
    $(document).ready(function () {
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
    $(document).ready(function () {
        $("#statusHapus").hide();
        $("#statusOK").show();
        $("#modalInfo").modal();
    })
}

function cekpassword() {
    $(document).ready(function () {
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
    $(document).ready(function () {
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
    $(document).ready(function () {
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
    $(document).ready(function () {
        $("#infoSalah").html("Data Yang Dipilih Salah!");
        $("#modalInfo").modal();
        $("#buttonKembali").show();
        $("#buttonOK").hide();
        $("#infoAlamat").hide();
    });
}


function mapInit() {
    document.getElementById('map-canvas').innerHTML = "<div id='map'></div>";
    var modalElm = $('#mapModal');

    var map = L.map("map", {
        zoom: 10,
        center: [-8.65977227887551, 115.21739959716798],
        zoomControl: true,
        attributionControl: false
    });
    

    var theMarker = {};
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    $.getJSON("http://127.0.0.1/pmi/data/DENPASAR.geojson", function (data) {
        // add GeoJSON layer to the map once the file is loaded
        L.geoJson(data).addTo(map);
    });

    var geocodeService = L.esri.Geocoding.geocodeService();

    map.on('click', function (e) {
        geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
            var defObject = $.Deferred();
            defObject.resolve(result.address.Match_addr);
            $.when(defObject.promise()).done(function (r) {
                result = r;
                console.log(result);
                $("#infoAlamat").show();
                document.getElementById("lat_peta_jadwal").value = e.latlng.lat;
                document.getElementById("lng_peta_jadwal").value = e.latlng.lng;
                document.getElementById("link_peta_jadwal").value = 'http://google.com/maps?q=' + e.latlng.lat + ',' + e.latlng.lng;
                var address = result;
                var splitAddress = new Array();
                splitAddress = address.split(",");
                document.getElementById("lokasi_jadwal").value = splitAddress[0] + ", " + splitAddress[1];
                var kecamatan = splitAddress[2].trim();

                $("#kecamatan_jadwal").val(kecamatan).change();
                console.log(kecamatan);
                document.getElementById("infoAlamat").innerHTML = "Lokasi Yang Di Pilih : " + splitAddress[0] + ", " + splitAddress[1] + ", " + splitAddress[2];

            })
            map.removeLayer(theMarker);
            theMarker = L.marker(e.latlng).addTo(map);
        });
    });


    
    map.addControl( new L.Control.Search({
		url: 'https://nominatim.openstreetmap.org/search?format=json&q={s}',
		jsonpParam: 'json_callback',
		propertyName: 'display_name',
		propertyLoc: ['lat','lon'],
		marker: L.circleMarker([0,0],{
            radius:30,
            color: '#f03',
            fillColor: '#f03',
            fillOpacity: 0.80
        }),
		autoCollapse: true,
		autoType: false,
		minLength: 2
	}) );


    modalElm.modal('show');
    modalElm.on('shown.bs.modal', function () {
        setTimeout(function () {
            map.invalidateSize();
        }, 10);
    });
    modalElm.on('hide.bs.modal', function () {
        /// clear canvas

    })
}

function hanyaNomor(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}