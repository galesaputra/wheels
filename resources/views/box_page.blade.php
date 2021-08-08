@extends('layouts.app')

@section('javascript_head')
    <link rel="stylesheet" href="./css/estilos.css">

@endsection
@section('content')

    <div class="content">

        <div class="col-md-3">
            <label for="name">Data</label>

            <form action="#" class="data-repeater">
                <div data-repeater-list="data">
                    <div data-repeater-item>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-9">
                                <input name="data" type="text" class="form-control" id="name" aria-describedby="name"
                                       placeholder="Data"/>
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
        </div>
    </div>
    <div class="hover_bkgr_fricc">
        <span class="helper"></span>
        <div style="position: relative">
            <div class="popupCloseButton">&times;</div>
            <span style="width:100%;height:100%;position: absolute;top: 0;left: 0px;justify-content: center;flex-direction: column;align-items: center;display: flex;font-size: 30px;">
            <p style="background: white;" id="pop-up-text"></p>
            </span>

        </div>
    </div>
    <style>

    </style>
@endsection
@section('javascript')
    <script type="text/javascript" src="./repeater.js"></script>
    <script type="text/javascript" src="./js/chain_fade.js"></script>
    <script>
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
                var dataarray = $('.data-repeater').repeaterVal()
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

                    data = "<div class='box' onclick='getcustomer(this);' " +
                        "data-id='" + dataarray.data[i].data + "' data-color='" + color + "' " +
                        "style='position: relative;background-color: #" + color + "'>" +
                        "<p style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);background-color: #f9f2f4;font-size: 25px;'>" + no + "</p></div>";

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
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            });
        });

        function getcustomer(elem) {
            var id = $(elem).data('id');
            var color = $(elem).data('color');
            $(".hover_bkgr_fricc > div").css('background-color', "#" + color);
            $(".trigger_popup_fricc").trigger('click');
            $("#pop-up-text").empty();
            var elemt = document.getElementById("pop-up-text");
            var text = document.createTextNode(id);
            elemt.appendChild(text);
        }
    </script>
@endsection
