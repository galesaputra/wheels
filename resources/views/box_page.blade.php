@extends('layouts.app')

@section('javascript_head')
    <link rel="stylesheet" href="./css/estilos20211123.css">
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        p.text-data {
            overflow: hidden;
            line-height: 1em;
            height: 6em;
        }

        p.text-awal {
            white-space: pre-wrap;
            overflow: hidden;
            line-height: 1em;
            height: 14em;
        }

        .modal-open {
            overflow: hidden;
        }
        .modal-content {
            height: 96%;
            border-radius: 0;
        }

        .modal-dialog {
            display: inline-block;
            width: 100%;
            height: 96%;
            padding: 0;

        }

    </style>
    <div class="content">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#buat" aria-controls="buat" role="tab" data-toggle="tab">Buat
                    Kotak</a></li>
            <li role="presentation"><a href="#kotak" aria-controls="kotak" role="tab" data-toggle="tab">Kotak
                    Misteri</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="buat">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="name">Materi/pelajaran</label>
                                <input name="materi" type="text" class="form-control" id="materi"
                                       aria-describedby="name"
                                       placeholder="materi/pelajaran"/>

                            </div>
                        </div>
                        <form action="#" class="data-repeater">
                            <div data-repeater-list="data">
                                <div data-repeater-item>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-8">
                                            <input name="data" type="text" class="form-control" id="name"
                                                   aria-describedby="name"
                                                   placeholder="Nama Kotak"/>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="form-controls" style="margin-top: 10px;"></span>
                                            <style>
                                                .form-controls:read-only {
                                                    background-image: linear-gradient(to top, #d2d2d2 0px, rgba(210, 210, 210, 0) 0px), linear-gradient(to top, #d2d2d2 0px, rgba(210, 210, 210, 0) 0px);
                                                }
                                            </style>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-md-8">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary"
                                                  onclick="$(this).parent().find('input[type=file]').click();"
                                                  style="margin-left: -10px;">Upload</span>
                                                <input onchange="encodeImageFileAsURL(this)"
                                                       name="file" style="margin-top: 10px;display: none;" type="file"
                                                       accept="image/*">
                                        </span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-8">
                                            <input type="hidden" name="filename" value="">
                                            <input type="hidden" name="status" value="0">
                                            <textarea name="keterangan" class="form-control" placeholder='Keterangan' style="margin-top: 10px;" rows="4"></textarea>
                                            {{--                                    <input type='text' name="keterangan" class="form-control" placeholder='Keterangan'--}}
                                            {{--                                           style="margin-top: 10px;"/>--}}

                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-outline-danger" data-repeater-delete
                                                    style="margin-top: 60px;">
                                                <i data-feather="x" class="me-25"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-icon btn-warning" data-repeater-create="">
                                <i data-feather="plus" class="me-25"></i>
                                <span>Tambah</span>
                            </button>
                        </form>
                        <div class="row" style="margin-top: 20px; ">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-icon btn-primary" id="SaveData">
                                    <i data-feather="plus" class="me-25"></i>
                                    <span>Simpan & Acak</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="kotak">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xs-9 form-group">
                                <label for="name">Materi/Pelajaran</label>
                                <select type="text" name="kelas_data" class="form-control" id="materi_data"
                                        style="min-height: 36px;">
                                    <option value="">Pilih Materi/Pelajaran</option>
                                    @foreach($box as $row)
                                        <option value="{{$row->detail}}">{{$row->materi}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-icon btn-primary" id="SaveDatahasil">
                                    <i data-feather="plus" class="me-25"></i>
                                    <span>Lihat</span>
                                </button>
                                <button type="button" class="btn btn-icon btn-danger" id="DeleteData">
                                    <i data-feather="plus" class="me-25"></i>
                                    <span>Hapus</span>
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <section style="width: 100%;" id="ResuldDataBox">
                            <div class="demoContainer">
                                <div class="demo toThebottom clearfix" id="resultData">
                                    <p style="text-align: center;margin-top: 8px;margin-left: 460px;">Data Masih
                                        Kosong</p>

                                </div><!-- fin demo -->
                            </div>
                        </section>
                        {{--                    <h2 style="text-align: center">Priview Card</h2>--}}
                        <section style="width: 100%;" id="ReviewDataBox">
                            <div class="demoContainer">
                                <div class="demo toThebottom clearfix" id="reviewData">
                                    <p style="text-align: center;margin-top: 8px;margin-left: 460px;">Data Masih
                                        Kosong</p>

                                </div><!-- fin demo -->
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="hover_bkgr_fricc" style="background: transparent">--}}
    {{--        <span class="helper"></span>--}}
    {{--        <div style="position: relative">--}}
    {{--            <div class="popupCloseButton">&times;</div>--}}
    {{--            <span style="width:100%;height:100%;position: absolute;top: 0;left: 0px;justify-content: center;flex-direction: column;align-items: center;display: flex;font-size: 30px;">--}}
    {{--            <p style="background: white;" id="pop-up-text"></p>--}}
    {{--            </span>--}}

    {{--        </div>--}}
    {{--    </div>--}}

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document" style="    min-width: 95%;">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="text-align: center;font-weight: bold;font-size: 48px;" id="titledata"></p>
                    <div id="centerdata"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('javascript')
    <script type="text/javascript" src="./repeater.js"></script>
    <script type="text/javascript" src="./js/chain_fade.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dataarray = ''
        var reviewarray = []
        $(window).load(function () {
            $(".trigger_popup_fricc").click(function () {
                $('.hover_bkgr_fricc').show();
            });
            $('.hover_bkgr_fricc').click(function () {
                $('.hover_bkgr_fricc').hide();
            });
            $('.popupCloseButton').click(function () {
                $('.hover_bkgr_fricc').hide();
            });
        });
        $(document).ready(function () {
            $('section').chainFade({
                speed: 500,
                interval: 50
            });
            $('#SaveData', $(this)).click(function () {
                dataarray = $('.data-repeater').repeaterVal()
                if (dataarray.data[0].data == "") {
                    alert('Tambahkan Data Terlebih Dahulu.');
                } else {
                    if ($('#materi').val() == null || $('#materi').val() == '') {
                        alert('Tambahkan Materi/Pelajaran Terlebih Dahulu');
                    } else {
                        var route = "./create-materi-by-box";
                        $.ajax({
                            type: 'POST',
                            url: route,
                            data: {
                                materi: $('#materi').val(),
                                detail: dataarray
                            },
                            success: function (data) {
                                // alert(data[1]);
                                // you can check for status here
                                reviewarray = []
                                $("#reviewData").empty();
                                $("#resultData").empty();
                                var foreach = JSON.parse(data)
                                $('#materi_data').empty()
                                $('#materi_data').append("<option value=''>Pilih Materi</option>")
                                for (let i = 0; i < foreach.length; i++) {
                                    $('#materi_data').append("<option value='" + foreach[i].detail + "'>" + foreach[i].materi + "</option>")
                                }
                                $('.nav-tabs a[href="#kotak"]').tab('show');
                            },
                            error: function (XMLHttpRequest) {
                            }

                        });
                    }
                }
            });
            $('#DeleteData').click(function () {

                if ($('#materi_data').val() == null || $('#materi_data').val() == '') {
                    alert('Tambahkan Materi/Pelajaran Terlebih Dahulu');
                } else {
                    var r = confirm("Apakah Anda yakin Hapus Data");
                    if (r == true) {
                        var route = "./delete-materi-by-box";
                        $.ajax({
                            type: 'POST',
                            url: route,
                            data: {
                                materi: $("#materi_data option:selected").text(),
                            },
                            success: function (data) {
                                // alert(data[1]);
                                // you can check for status here
                                reviewarray = []
                                $("#reviewData").empty();

                                var foreach = JSON.parse(data)
                                $('#materi_data').empty()
                                $('#materi_data').append("<option value=''>Pilih Materi</option>")
                                for (let i = 0; i < foreach.length; i++) {
                                    $('#materi_data').append("<option value='" + foreach[i].detail + "'>" + foreach[i].materi + "</option>")
                                }
                                alert('Delete Data Berhasil');
                                // $('.nav-tabs a[href="#hasil"]').tab('show');
                            },
                            error: function (XMLHttpRequest) {
                                // toastr.error('Something Went Wrong !');
                            }
                        });

                    }
                }

            });
            $('#SaveDatahasil').click(function () {

                if ($('#materi_data').val() == null || $('#materi_data').val() == '') {
                    alert('Tambahkan Materi/Pelajaran Terlebih Dahulu');
                } else {
                    reviewarray = []
                    $("#reviewData").empty();
                    var cekdata = $('#materi_data').val()
                    dataarray = JSON.parse(cekdata)

                    dataarray.data = dataarray.data.sort(() => Math.random() - 0.5)
                    // var dataarray1 = dynamicgenerator(dataarray.data,"data");

                    var tbody = document.getElementById('resultData');
                    $("#resultData").empty();
                    var no = 0
                    var data = "";
                    for (var i = 0; i < dataarray.data.length; i++) {
                        no = i + 1;
                        var colors = ['#ff0000', '#00ff00', '#0000ff', '#ff4000', '#ff8000', '#ffbf00', '#ffff00', '#bfff00', '#80ff00', '#40ff00', '#00ff00', '#00ff40', '#2f4f4f',
                            '#00ff80', '#00ffbf', '#00ffff', '#00bfff', '#0080ff', '#0040ff', '#0000ff', '#4000ff', '#8000ff', '#bf00ff', '#ff00ff', '#ff00bf', '#ff0080', '#ff0040', '#ff0000',
                            '#ffa500', '#f0f8ff', '#faebd7', '#7fffd4', '#f0ffff', '#f5f5dc', '#ffe4c4', '#deb887', '#5f9ea0', '#a9a9a9', '#bdb76b', '#556b2f', '#ff8c00', '#e9967a', '#483d8b'];
                        var color = colors[Math.floor(Math.random() * colors.length)];
                        // var color = Math.floor(Math.random() * 16777215).toString(16);
                        /* Must not forget the $ sign */
                        var boxdata = "box_" + i;
                        var keterangan = "keterangan_" + i;
                        data = "<div class='box' onclick='getcustomer(this);' data-id='" + dataarray.data[i].data + "' data-nomer='" + i + "' " +
                            "style='cursor: pointer;position: relative;background-color: " + color + ";display: flex;justify-content: center;align-items: center;text-align: center;transform: scale(1);font-size: 28px;  font-weight: bold;'>" + dataarray.data[i].data + "</div>";

                        /* We add the table row to the table body */
                        tbody.innerHTML += data;
                        if (no == dataarray.data.length) {
                            if (dataarray.data.length <= 5) {
                                var clientHeight = 200
                            } else if (dataarray.data.length <= 10) {
                                var clientHeight = 400
                            } else if (dataarray.data.length <= 20) {
                                var clientHeight = 600
                            } else if (dataarray.data.length <= 25) {
                                var clientHeight = 800
                            } else if (dataarray.data.length <= 30) {
                                var clientHeight = 1000
                            } else if (dataarray.data.length <= 40) {
                                var clientHeight = 1200
                            }
                            $("#ResuldDataBox").css('height', parseInt(clientHeight + 40) + "px");
                            $("#ResuldDataBox").css('display', "block");
                            $(".box").css('transform', "scale(1.0)");
                        }

                    }
                }
            });

            var number = 0
            $('.data-repeater').repeater({
                defaultValues: {
                    'text-input': 'foo'
                },
                show: function () {
                    $(this).slideDown();

                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        number = number - 1;
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    // $dragAndDrop.on('drop', setIndexes);
                },
                // (Optional)
                isFirstItemUndeletable: true
            });
        });

        function getcustomer(elem) {


            var nomer = $(elem).data('nomer');
            if (dataarray.data[nomer].status == 0) {
                var databox = "box_" + nomer;
                $("#" + databox).css('cursor', "no-drop");
                reviewarray.push(dataarray.data[nomer])
                var color = $(elem).data('color');
                dataarray.data[nomer].status = 1
                dataarray.data[nomer].color = "#" + color
                // $("#")
                $('.modal').modal();
                $('#titledata').empty();
                $('#titledata').html(dataarray.data[nomer].data);
                $('#centerdata').empty();
                if (dataarray.data[nomer].filename != '' && dataarray.data[nomer].keterangan != '') {
                    $("#centerdata").append("" +
                        "<div class='row'>" +
                        "<div class='col-md-7'>" +
                        "<img src='" + dataarray.data[nomer].filename + "' style='width: -webkit-fill-available;max-height: 400px;min-height: 400px;;'>" +
                        "</div>" +
                        "<div class='col-md-5'>" +
                        "<p class='text-awal' style='font-size:28px;margin-left: -22px; white-space: pre-wrap;'>" + dataarray.data[nomer].keterangan + "</p>" +
                        "</div>" +
                        "</div>");
                }
                if (dataarray.data[nomer].filename != '' && dataarray.data[nomer].keterangan == '') {
                    $("#centerdata").append("" +
                        "<div class='row'>" +
                        "<div class='col-md-12'>" +
                        "<img src='" + dataarray.data[nomer].filename + "' style='width: -webkit-fill-available;max-height: 400px;min-height: 400px;;'>" +
                        "</div>" +
                        "</div>");
                }
                if (dataarray.data[nomer].filename == '' && dataarray.data[nomer].keterangan != '') {
                    $("#centerdata").append("" +
                        "<div class='row'>" +
                        "<div class='col-md-12' style='text-align:center'>" +
                        "<p class='text-awal' style='font-size:28px; white-space: pre-wrap;'>" + dataarray.data[nomer].keterangan + "</p>" +
                        "</div>" +
                        "</div>");
                }

                var tbody = document.getElementById('reviewData');
                $("#reviewData").empty();
                var no = 0
                var data = "";
                for (var i = 0; i < reviewarray.length; i++) {
                    no = i + 1;
                    // var color = Math.floor(Math.random() * 16777215).toString(16);
                    /* Must not forget the $ sign */
                    var boxdata = "boxx_" + i;
                    if (reviewarray[i].filename != '' && reviewarray[i].keterangan != '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;'> </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='display: contents;cursor: pointer;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata2'>" + reviewarray[i].data + "</p>" +
                            "<div class='row'>" +
                            "<div class='col-md-7'>" +
                            "<img src='" + reviewarray[i].filename + "' style='width: -webkit-fill-available;'>" +
                            "</div>" +
                            "<div class='col-md-5'>" +
                            "<p class='text-data' style='margin-left: -22px;'>" + reviewarray[i].keterangan + "</p>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }
                    if (reviewarray[i].filename == '' && reviewarray[i].keterangan != '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;' > </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='cursor: pointer;display: contents;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata2'>" + reviewarray[i].data + "</p>" +
                            "<div class='row'>" +
                            "<div class='col-md-12' style='text-align:center'>" +
                            "<p class='text-data'>" + reviewarray[i].keterangan + "</p>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }
                    if (reviewarray[i].filename != '' && reviewarray[i].keterangan == '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;'> </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='cursor: pointer;display: contents;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata2'>" + reviewarray[i].data + "</p>" +
                            "<div class='row'>" +
                            "<div class='col-md-12'>" +
                            "<img src='" + reviewarray[i].filename + "' style='width: -webkit-fill-available;'>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }
                    if (reviewarray[i].filename == '' && reviewarray[i].keterangan == '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;'> </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='cursor: pointer;display: contents;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata2'>" + reviewarray[i].data + "</p>" +
                            "</div>";
                    }

                    /* We add the table row to the table body */
                    tbody.innerHTML += data;
                    if (no == reviewarray.length) {
                        var clientHeight = document.getElementById('reviewData').clientHeight
                        $("#ReviewDataBox").css('height', parseInt(clientHeight + 40) + "px");
                        $("#ReviewDataBox").css('display', "block");
                        $(".box").css('transform', "scale(1.0)");
                    }
                }
            } else {
                alert("Data Sudah Terpilih")
            }
        }

        function getreview(elem) {
            var nomer = $(elem).data('nomer');
            $('.modal').modal();
            $('#titledata').empty();
            $('#titledata').html(reviewarray[nomer].data);
            $('#centerdata').empty();
            if (reviewarray[nomer].filename != '' && reviewarray[nomer].keterangan != '') {
                $("#centerdata").append("" +
                    "<div class='row'>" +
                    "<div class='col-md-7'>" +
                    "<img src='" + reviewarray[nomer].filename + "' style='width: -webkit-fill-available;max-height: 400px;min-height: 400px;;'>" +
                    "</div>" +
                    "<div class='col-md-5'>" +
                    "<p class='text-awal' style='font-size:28px;margin-left: -22px; white-space: pre-wrap;'>" + reviewarray[nomer].keterangan + "</p>" +
                    "</div>" +
                    "</div>");
            }
            if (reviewarray[nomer].filename != '' && reviewarray[nomer].keterangan == '') {
                $("#centerdata").append("" +
                    "<div class='row'>" +
                    "<div class='col-md-12'>" +
                    "<img src='" + reviewarray[nomer].filename + "' style='width: -webkit-fill-available; max-height: 400px;min-height: 400px;;'>" +
                    "</div>" +
                    "</div>");
            }
            if (reviewarray[nomer].filename == '' && reviewarray[nomer].keterangan != '') {
                $("#centerdata").append("" +
                    "<div class='row'>" +
                    "<div class='col-md-12' style='text-align:center'>" +
                    "<p class='text-awal' style='font-size:28px; white-space: pre-wrap;'>" + reviewarray[nomer].keterangan + "</p>" +
                    "</div>" +
                    "</div>");
            }
        }

        function encodeImageFileAsURL(element) {
            var myStr = element.name;
            var newStr = myStr.replace("file]", "filename]");
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                document.querySelector('input[name="' + newStr + '"]').value = reader.result;
                $(element).parent().parent().parent().parent().find('.form-controls').html("<img src=" + reader.result + " style='max-height: 120px;position: absolute;'>")
            }
            reader.readAsDataURL(file);
        }
    </script>
@endsection
