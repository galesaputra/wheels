@extends('layouts.app')

@section('javascript_head')
    <link rel="stylesheet" href="./css/estilos.css">

@endsection
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <label for="name">Pelajaran</label>

                <form action="#" class="data-repeater">
                    <div data-repeater-list="data">
                        <div data-repeater-item>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-9">
                                    <input name="data" type="text" class="form-control" id="name"
                                           aria-describedby="name"
                                           placeholder="Pelajaran"/>
                                    <input name="status" type="hidden" value="0"/>
                                    <input name="file" type="hidden" value="0"/>
                                    <input name="keterangan" type="hidden" value="0"/>

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
            <div class="col-md-1">
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
    <div class="hover_bkgr_fricc" style="background: transparent">
        <span class="helper"></span>
        <div style="position: relative">
            <div class="popupCloseButton">&times;</div>
            <span style="width:100%;height:100%;position: absolute;top: 0;left: 0px;justify-content: center;flex-direction: column;align-items: center;display: flex;font-size: 30px;">
            <p style="background: white;" id="pop-up-text"></p>
            </span>

        </div>
    </div>
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
                    data = "<div class='box' " +
                        "style='position: relative;background-color: #" + color + "'>" +
                        "<input type='file'  onchange='encodeImageFileAsURL(this)' data-nomer='" + i + "'/>" +
                        "<input type='text'  id='"+keterangan+"' placeholder='Keterangan' />" +
                        "<button onclick='save(this);' data-nomer='" + i + "'>Simpan </button>"+
                        "<p style='cursor: pointer;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);background-color: #f9f2f4;font-size: 25px;' id='" + boxdata + "' onclick='getcustomer(this);'" +
                        "data-id='" + dataarray.data[i].data + "' data-nomer='" + i + "' data-status='" + dataarray.data[i].status + "' data-color='" + color + "'>" + no + "</p></div>";

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

            var id = $(elem).data('id');
            var status = $(elem).data('status');
            var nomer = $(elem).data('nomer');
            if (dataarray.data[nomer].file == 0) {
                alert("Upload File Terlebih Dahulu")
            } else {
                if (dataarray.data[nomer].status == 0) {
                    var databox = "box_" + nomer;
                    $("#" + databox).css('cursor', "no-drop");
                    reviewarray.push(dataarray.data[nomer])


                    var color = $(elem).data('color');
                    dataarray.data[nomer].status = 1
                    dataarray.data[nomer].color = "#" + color

                    $(".hover_bkgr_fricc > div").css('background-color', "#" + color);
                    $('.hover_bkgr_fricc').show();
                    // $(".trigger_popup_fricc").trigger('click');
                    $("#pop-up-text").empty();
                    var elemt = document.getElementById("pop-up-text");
                    var text = document.createTextNode(id);
                    elemt.appendChild(text);

                    var tbody = document.getElementById('reviewData');
                    $("#reviewData").empty();
                    var no = 0
                    var data = "";
                    for (var i = 0; i < reviewarray.length; i++) {
                        no = i + 1;
                        // var color = Math.floor(Math.random() * 16777215).toString(16);
                        /* Must not forget the $ sign */
                        var boxdata = "box_" + i;
                        data = "<div class='box' id='" + boxdata + "'" +
                            "data-id='" + reviewarray[i].data + "' data-nomer='" + i + "' data-status='" + reviewarray[i].status + "' data-color='" + color + "' " +
                            "style='cursor: pointer;position: relative;background-color:" + reviewarray[i].color + "'>" +
                            "<p style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);background-color: #f9f2f4;font-size: 25px;'>" +
                            "<div class='row'>" +
                            "<div class='col-md-6'>" +
                            "<img src='"+reviewarray[i].file+"' style='max-width: 100%;'> " +
                            "</div>" +
                            "<div class='col-md-6'>" +
                            "<p>"+reviewarray[i].data+"</p> " +
                            "<p>"+reviewarray[i].keterangan+"</p> " +
                            "</div>" +
                            "</div>" +
                            "</p></div>";

                        /* We add the table row to the table body */
                        tbody.innerHTML += data;
                        if (no == reviewarray.length) {
                            var clientHeight = document.getElementById('reviewData').clientHeight
                            $("section").css('height', parseInt(clientHeight + 40) + "px");
                            $("section").css('display', "block");
                            $(".box").css('transform', "scale(1.0)");
                        }
                    }
                } else {
                    alert("Data Sudah Terpilih")
                }
            }
        }

        function encodeImageFileAsURL(element) {
            console.log(12)
            var id = $(element).data('nomer');

            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                dataarray.data[id].file = reader.result
            }
            reader.readAsDataURL(file);
        }
        function save(element) {
            var id = $(element).data('nomer');
            var data = document.getElementById('keterangan_'+id).value;
            console.log(data);
            console.log(dataarray.data[id]);
            dataarray.data[id].keterangan = data;
            alert("Data Tersimpan")
        }
    </script>
@endsection
