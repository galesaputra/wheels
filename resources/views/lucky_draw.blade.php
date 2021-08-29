@extends('layouts.app')

@section('javascript_head')
    <link rel="stylesheet" href="./main.css" type="text/css"/>
    <script type="text/javascript" src="./Winwheel.js"></script>
    <script src="./TweenMax.js"></script>
@endsection
@section('content')

    <div class="content">

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <label for="name">Data</label>
                    <form action="#" class="data-repeater">
                        <div data-repeater-list="data">
                            <div data-repeater-item>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-9">
                                        <input name="data" type="text" class="form-control" id="name"
                                               aria-describedby="name"
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
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-9">
                            <input name="data" type="text" class="form-control" id="jml_kel"
                                   onkeypress='validate(event)'
                                   placeholder="Jumlah Kelompok"/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row" style="margin-top: 20px; ">
                <div class="col-md-3">
                    <button type="button" class="btn btn-icon btn-primary" id="SaveData">
                        <i data-feather="plus" class="me-25"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </div>


            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <div class="power_controls">
                            <br/>
                            <img id="spin_button" src="spin_off.png" alt="Spin" onClick="startSpin();"
                                 style="cursor: pointer"/>
                        </div>
                    </td>
                    <td height="582" class="the_wheel" align="center" valign="center">
                        <canvas id="canvas" width="434" height="434">
                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please
                                try another.</p>
                        </canvas>
                    </td>
                    {{--                    <td width="438" height="582" align="center" valign="center">--}}
                    {{--                        <p>Hasil Lucky Draw</p>--}}
                    {{--                        <table style="width:100%" class="table">--}}
                    {{--                            <tr>--}}
                    {{--                                <th>No</th>--}}
                    {{--                                <th>Data</th>--}}
                    {{--                            </tr>--}}
                    {{--                            <tbody id="tbody">--}}
                    {{--                            <td colspan="3" style="text-align: center;background-color: gray">Data Masih Kosong</td>--}}
                    {{--                            </tbody>--}}
                    {{--                        </table>--}}
                    {{--                    </td>--}}
                </tr>
            </table>
        </div>


    </div>
    <div class="table-data">
    </div>

@endsection
@section('javascript')
    <script type="text/javascript" src="./repeater.js"></script>
    <script>
        var selectspin = 0;

        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        let luckdraw = [
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Lara'},
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Quiz'},
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Lucky'},
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Draw'},
        ]
        var lengthDraw = luckdraw.length;
        if (lengthDraw <= 10) {
            var textsize = 15
        } else {
            var textsize = 12
        }
        let data_user = '';
        let data_user_tabel = [];
        let cek_input_class = false
        let wheelPower = 0;
        let wheelSpinning = false;
        let audio = new Audio('tick.mp3');
        let theWheel = ''

        function winwheel() {

            theWheel = new Winwheel({
                'outerRadius': 212,        // Set outer radius so wheel fits inside the background.
                'innerRadius': 75,         // Make wheel hollow so segments don't go all way to center.
                'textFontSize': textsize,         // Set default font size for the segments.
                'textOrientation': 'horizontal', // Make text vertial so goes down from the outside of wheel.
                'textAlignment': 'center',    // Align text to outside of wheel.
                'numSegments': lengthDraw,         // Specify number of segments.
                'segments': luckdraw,            // Define segments including colour and text.
                'animation':           // Specify the animation to use.
                    {
                        'type': 'spinToStop',
                        'duration': 10,    // Duration in seconds.
                        'spins': 3,     // Default number of complete spins.
                        'callbackFinished': alertPrize,
                        'callbackSound': playSound,   // Function to call when the tick sound is to be triggered.
                        'soundTrigger': 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                    },
                'pins':				// Turn pins on.
                    {
                        'number': lengthDraw,
                        'fillStyle': 'silver',
                        'outerRadius': 4,
                    }
            });


        }

        // Loads the tick audio sound in to an audio object.

        // This function is called when the sound is to be played.
        function playSound() {
            // Stop and rewind the sound if it already happens to be playing.
            audio.pause();
            audio.currentTime = 0;

            // Play the sound.
            audio.play();
        }

        winwheel()
        // -------------------------------------------------------
        // Click handler for spin button.
        // -------------------------------------------------------
        function startSpin() {
            if (!cek_input_class) {
                alert("Silahkan Tambahkan Data Terlebih Dahulu");
            } else {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false) {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                    if (wheelPower == 1) {
                        theWheel.animation.spins = 3;
                    } else if (wheelPower == 2) {
                        theWheel.animation.spins = 6;
                    } else if (wheelPower == 3) {
                        theWheel.animation.spins = 10;
                    }

                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_button').src = "spin_off.png";
                    document.getElementById('spin_button').className = "";

                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();

                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }
        }

        // -------------------------------------------------------
        // Function for reset button.
        // -------------------------------------------------------
        function resetWheel() {
            theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
            theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
            theWheel.draw();                // Call draw to render changes to the wheel.

            // document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
            // document.getElementById('pw2').className = "";
            // document.getElementById('pw3').className = "";

            wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
        }

        // -------------------------------------------------------
        // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
        // -------------------------------------------------------
        function alertPrize(indicatedSegment) {

            var countspin = selectspin + 1;
            if (countspin > $('#jml_kel').val()) {

                selectspin = 0
                $("#table_no_" + selectspin).empty();
                var tbody = document.getElementById("table_no_" + selectspin);
                var resultObject = search(indicatedSegment.text, data_user);
                Object.assign(resultObject, {tabel: selectspin, status: 0});
                data_user_tabel.push(resultObject)
                var no = 0;
                for (var i = 0; i < data_user_tabel.length; i++) {
                    if (data_user_tabel[i].tabel == selectspin) {
                        no = no + 1;
                        var tr = "<tr>";

                        /* Must not forget the $ sign */
                        tr += "<td>" + no + "</td>" + "<td>" + data_user_tabel[i].data + "</td></tr>";
                        /* We add the table row to the table body */
                        tbody.innerHTML += tr;
                    }
                }
                selectspin = 1
            } else {
                $("#table_no_"+selectspin).empty();
                var tbody = document.getElementById("table_no_" + selectspin);

                var resultObject = search(indicatedSegment.text, data_user);
                Object.assign(resultObject, {tabel: selectspin, status: 0});
                data_user_tabel.push(resultObject)
                var no = 0
                for (var i = 0; i < data_user_tabel.length; i++) {
                    if (data_user_tabel[i].tabel == selectspin) {
                        no = no + 1;
                        if(data_user_tabel[i].status == 1){
                            var tr = "<tr style='background: red'>";
                        }
                        else{
                            var tr = "<tr>";
                        }

                        /* Must not forget the $ sign */
                        tr += "<td>" + no + "</td>" + "<td>" + data_user_tabel[i].data + "</td></tr>";
                        /* We add the table row to the table body */
                        tbody.innerHTML += tr;
                    }
                }

                selectspin = parseInt(selectspin + 1);

            }


            $.each(luckdraw, function (i) {
                if (luckdraw[i].text === indicatedSegment.text) {
                    luckdraw.splice(i, 1);
                    lengthDraw = luckdraw.length;
                    if (lengthDraw <= 10) {
                        textsize = 15
                    } else {
                        textsize = 12
                    }
                    winwheel()

                    return false;
                }
            });
            alert("You have won " + indicatedSegment.text);
            theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
            theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
            theWheel.draw();                // Call draw to render changes to the wheel.
            wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.


        }

        function search(nameKey, myArray) {
            for (var i = 0; i < myArray.length; i++) {
                if (myArray[i].data === nameKey) {
                    return myArray[i];
                }
            }
        }

        function searchacak(nameKey, myArray) {
            for (var i = 0; i < myArray.length; i++) {
                if (myArray[i].tabel === nameKey) {
                    return myArray[i];
                }
            }
        }

        function makeTable(num) {
            var output = '<div class="row">';
            //create num rows
            var count = 0;
            for (var i = 0; i < num; i++) {
                count = i + 1;
                //for each row
                var idtable = "table_no_" + i;
                var idbutton = "button_no_" + i;
                output += '<div class="col-md-4">';
                output += '<p style="text-align:center">Table Kelompok ' + count + '</p>';
                output += '<table class="table">';
                output += ' <tr> <th>No</th> <th>Data</th> </tr>'
                output += '<tbody id="' + idtable + '">'
                output += '</tbody>';
                output += '</table>';
                output += '<button type="button" data-id="' + i + '" onclick="getacak(this);" class="btn btn-icon btn-primary"> <i data-feather="plus" class="me-25"></i> <span>Acak & Pilih</span> </button>';
                output += '</div>';

            }
            output += '</div>';
            return output;
        }

        $('#SaveData').click(function () {
            var dataarray = $('.data-repeater').repeaterVal()
            let data_user_tabel = [];
            if ($('#jml_kel').val() == null || $('#jml_kel').val() == '') {
                alert("Masukkan Jumlah Kelompok Terlebih Dahulu")
            } else {
                if (dataarray.data[0].data == "") {
                    alert('Tambahkan Data Terlebih Dahulu.');
                } else {
                    var count_kelompok = $('#jml_kel').val()

                    $(".table-data").html("");
                    var result = makeTable(count_kelompok);
                    $(".table-data").append(result);

                    // dataarray.data = dataarray.data.sort(() => Math.random() - 0.5)
                    if (dataarray.data.length != 0) {
                        luckdraw = [];
                        cek_input_class = true;
                        data_user = dataarray.data
                    }
                    var cek_jml = dataarray.data.length - 1;
                    for (let i = 0; i < dataarray.data.length; i++) {
                        luckdraw.push({
                            'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16),
                            'text': dataarray.data[i].data
                        });
                        if (i == cek_jml) {
                            lengthDraw = luckdraw.length;
                            if (lengthDraw <= 10) {
                                textsize = 15
                            } else {
                                textsize = 12
                            }
                            winwheel()
                        }
                    }
                }
            }
        });

        $(document).ready(function () {

            // $(".table-data").html("");

            /*this function makes a table of size numRow and
                  num data. it then gives each data element
                  */


            //starting area
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

        function getacak(elem) {

            var id = $(elem).data('id');
            var acakdata = [];
            var no = 0
            for (var i = 0; i < data_user_tabel.length; i++) {
                no = i + 1;
                if (data_user_tabel[i].tabel == id && data_user_tabel[i].status == 0) {
                    acakdata.push(data_user_tabel[i])
                }
                if (no == data_user_tabel.length) {
                    acakdata = acakdata.sort(() => Math.random() - 0.5)
                }
            }
            alert("data yang terpilih adalah "+acakdata[0].data)
            $("#table_no_" + id).empty();
            var tbody = document.getElementById("table_no_" + id);
            acakdata[0].status = 1;
            var no = 0
            for (var i = 0; i < data_user_tabel.length; i++) {
                if (data_user_tabel[i].tabel == id) {
                    if(acakdata[0].data == data_user_tabel[i].data){
                        data_user_tabel[i].status = 1
                        var tr = "<tr style='background: red'>";
                    }
                    else if(data_user_tabel[i].status == 1){
                        var tr = "<tr style='background: red'>";
                    }
                    else{
                        var tr = "<tr>";
                    }
                    no = no + 1;
                    /* Must not forget the $ sign */
                    tr += "<td>" + no + "</td>" + "<td>" + data_user_tabel[i].data + "</td></tr>";
                    /* We add the table row to the table body */
                    tbody.innerHTML += tr;
                }
            }

        }
    </script>
@endsection