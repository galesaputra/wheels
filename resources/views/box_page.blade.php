@extends('layouts.app')

@section('javascript_head')
    <link rel="stylesheet" href="./css/estilos.css">

@endsection
@section('content')
    <style>
        .modal {
            text-align: center;
            padding: 0!important;
        }

        .modal:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            margin-right: -4px;
        }

        .modal-dialog {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }

    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <label for="name">Pelajaran</label>

                <form action="#" class="data-repeater">
                    <div data-repeater-list="data">
                        <div data-repeater-item>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-9">

                                    <input name="data" type="text" class="form-control" id="name"
                                           aria-describedby="name"
                                           placeholder="Pelajaran"/>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();" style="margin-left: -10px;">Upload</span>
                                                <input onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());encodeImageFileAsURL(this)"
                                                       name="file" style="margin-top: 10px;display: none;" type="file" accept="image/*">
                                        </span>
                                        <span class="form-control" style="margin-top: 10px;"></span>
                                        <style>
                                            .form-control:read-only {
                                                background-image: linear-gradient(to top, #d2d2d2 0px, rgba(210, 210, 210, 0) 0px), linear-gradient(to top, #d2d2d2 0px, rgba(210, 210, 210, 0) 0px);
                                            }
                                        </style>

                                    </div>
                                    <input type="hidden" name="filename" value="">
                                    <input type="hidden" name="status" value="0">
                                    <input type='text' name="keterangan" class="form-control" placeholder='Keterangan'
                                           style="margin-top: 10px;"/>

                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-outline-danger" data-repeater-delete
                                            style="margin-top: 2px;">
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
            <div class="col-md-8">
                <section style="width: 100%;">
                    <div class="demoContainer">
                        <div class="demo toThebottom clearfix" id="resultData">
                            <p style="text-align: center;margin-top: 8px;margin-left: 260px;">Data Masih Kosong</p>

                        </div><!-- fin demo -->
                    </div>
                </section>
                <h2 style="text-align: center">Priview Card</h2>
                <section style="width: 100%;">
                    <div class="demoContainer">
                        <div class="demo toThebottom clearfix" id="reviewData">
                            <p style="text-align: center;margin-top: 8px;margin-left: 260px;">Data Masih Kosong</p>

                        </div><!-- fin demo -->
                    </div>
                </section>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="text-align: center;font-weight: bold;font-size: 40px;" id="titledata"></p>
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
                reviewarray = []
                $("#reviewData").empty();
                dataarray.data = dataarray.data.sort(() => Math.random() - 0.5)
                // var dataarray1 = dynamicgenerator(dataarray.data,"data");

                var tbody = document.getElementById('resultData');
                $("#resultData").empty();
                var no = 0
                var data = "";
                for (var i = 0; i < dataarray.data.length; i++) {
                    no = i + 1;
                    var color = Math.floor(Math.random() * 16777215).toString(16);
                    /* Must not forget the $ sign */
                    var boxdata = "box_" + i;
                    var keterangan = "keterangan_" + i;
                    data = "<div class='box' onclick='getcustomer(this);' data-id='" + dataarray.data[i].data + "' data-nomer='" + i + "' " +
                        "style='cursor: pointer;position: relative;background-color: #" + color + "'></div>";

                    /* We add the table row to the table body */
                    tbody.innerHTML += data;
                    if (no == dataarray.data.length) {
                        var clientHeight = document.getElementById('resultData').clientHeight
                        $("section").css('height', parseInt(clientHeight + 40) + "px");
                        $("section").css('display', "block");
                        $(".box").css('transform', "scale(1.0)");
                    }
                }

            });

            $('.data-repeater').repeater({
                defaultValues: {
                    'text-input': 'foo'
                },
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
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
            if (dataarray.data[nomer].status == 0 ) {
                var databox = "box_" + nomer;
                $("#" + databox).css('cursor', "no-drop");
                reviewarray.push(dataarray.data[nomer])


                var color = $(elem).data('color');
                dataarray.data[nomer].status = 1
                dataarray.data[nomer].color = "#" + color
                // $("#")
                $('.modal').modal();
                $('#titledata').html(dataarray.data[nomer].data);
                $('#centerdata').empty();
                if(dataarray.data[nomer].filename !=  '' && dataarray.data[nomer].keterangan !=  '') {
                    $("#centerdata").append("" +
                        "<div class='row'>" +
                        "<div class='col-md-8'>" +
                        "<img src='" + dataarray.data[nomer].filename + "' style='width: -webkit-fill-available;'>" +
                        "</div>" +
                        "<div class='col-md-4'>" +
                        "<p>" + dataarray.data[nomer].keterangan + "</p>" +
                        "</div>" +
                        "</div>");
                }
                if(dataarray.data[nomer].filename !=  '' && dataarray.data[nomer].keterangan ==  '') {
                    $("#centerdata").append("" +
                        "<div class='row'>" +
                        "<div class='col-md-12'>" +
                        "<img src='" + dataarray.data[nomer].filename + "' style='width: -webkit-fill-available;'>" +
                        "</div>" +
                        "</div>");
                }
                if(dataarray.data[nomer].filename ==  '' && dataarray.data[nomer].keterangan !=  '') {
                    $("#centerdata").append("" +
                        "<div class='row'>" +
                        "<div class='col-md-12' style='text-align:center'>" +
                        "<p>" + dataarray.data[nomer].keterangan + "</p>" +
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
                    if(reviewarray[i].filename !=  '' && reviewarray[i].keterangan !=  '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;'> </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='display: contents;cursor: pointer;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata'>" + reviewarray[i].data + "</p>" +
                            "<div class='row'>" +
                            "<div class='col-md-8'>" +
                            "<img src='" + reviewarray[i].filename + "' style='width: -webkit-fill-available;'>" +
                            "</div>" +
                            "<div class='col-md-4'>" +
                            "<p>" + reviewarray[i].keterangan + "</p>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }
                    if(reviewarray[i].filename ==  '' && reviewarray[i].keterangan !=  '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='cursor: pointer;position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;'> </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='display: contents;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata'>" + reviewarray[i].data + "</p>" +
                            "<div class='row'>" +
                            "<div class='col-md-12' style='text-align:center'>" +
                            "<p>" + reviewarray[i].keterangan + "</p>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }
                    if(reviewarray[i].filename !=  '' && reviewarray[i].keterangan ==  '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='cursor: pointer;position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;'> </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='display: contents;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata'>" + reviewarray[i].data + "</p>" +
                            "<div class='row'>" +
                            "<div class='col-md-12'>" +
                            "<img src='" + reviewarray[i].filename + "' style='width: -webkit-fill-available;'>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                    }
                    if(reviewarray[i].filename ==  '' && reviewarray[i].keterangan ==  '') {
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='cursor: pointer;position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<input name='data' type='text' class='form-control' placeholder='Catatan'/>" +
                            "<div style='margin-top:10px;background-color: #DDD;'> </div>" +
                            "<div class='row' onclick='getreview(this);' data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' style='display: contents;'>" +
                            "<p style='text-align: center;font-weight: bold;font-size: 20px;' id='titledata'>" + reviewarray[i].data + "</p>" +
                            "</div>";
                    }

                    /* We add the table row to the table body */
                    tbody.innerHTML += data;
                    if (no == reviewarray.length) {
                        var clientHeight = document.getElementById('reviewData').clientHeight
                        $("section").css('height', parseInt(clientHeight + 40) + "px");
                        $("section").css('display', "block");
                        $(".box").css('transform', "scale(1.0)");
                    }
                }
            }
            else {
                alert("Data Sudah Terpilih")
            }

        }
        function getreview(elem) {
            var nomer = $(elem).data('nomer');
            $('.modal').modal();
            $('#titledata').html(reviewarray[nomer].data);
            $('#centerdata').empty();
            if (reviewarray[nomer].filename != '' && reviewarray[nomer].keterangan != '') {
                $("#centerdata").append("" +
                    "<div class='row'>" +
                    "<div class='col-md-8'>" +
                    "<img src='" + reviewarray[nomer].filename + "' style='width: -webkit-fill-available;'>" +
                    "</div>" +
                    "<div class='col-md-4'>" +
                    "<p>" + reviewarray[nomer].keterangan + "</p>" +
                    "</div>" +
                    "</div>");
            }
            if (reviewarray[nomer].filename != '' && reviewarray[nomer].keterangan == '') {
                $("#centerdata").append("" +
                    "<div class='row'>" +
                    "<div class='col-md-12'>" +
                    "<img src='" + reviewarray[nomer].filename + "' style='width: -webkit-fill-available;'>" +
                    "</div>" +
                    "</div>");
            }
            if (reviewarray[nomer].filename == '' && reviewarray[nomer].keterangan != '') {
                $("#centerdata").append("" +
                    "<div class='row'>" +
                    "<div class='col-md-12' style='text-align:center'>" +
                    "<p>" + reviewarray[nomer].keterangan + "</p>" +
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
                document.querySelector('input[name="'+newStr+'"]').value = reader.result;
                console.log(reader.result)
            }
            reader.readAsDataURL(file);
        }
    </script>
@endsection
