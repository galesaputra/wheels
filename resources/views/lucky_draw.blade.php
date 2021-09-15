@extends('layouts.app')

@section('javascript_head')
    <link rel="stylesheet" href="./main.css" type="text/css"/>
    <script type="text/javascript" src="./Winwheel.js"></script>
    <script src="./TweenMax.js"></script>
@endsection
@section('content')

    <div class="content">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                          data-toggle="tab">Bentuk Kelompok</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Pilih
                        Kelompok</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Nama Kelompok</label>
                                    <form action="#" class="data-repeater">
                                        <div data-repeater-list="data">
                                            <div data-repeater-item>
                                                <div class="row" style="margin-top: 10px;">
                                                    <div class="col-md-9">
                                                        <input name="data" type="text" class="form-control"
                                                               id="name"
                                                               aria-describedby="name"
                                                               placeholder="Kelompok"/>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 10px;">
                                                    <div class="col-md-9">
                                            <textarea id="post-text" class="form-control" rows="4"
                                                      placeholder="Nama Mahasiswa" required name="mahasiswa"></textarea><br>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="button" class="btn btn-outline-danger"
                                                                data-repeater-delete
                                                                style="margin-top: 2px;">
                                                            <i data-feather="x" class="me-25"></i>
                                                            <span>Hapus</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-icon btn-warning"
                                                data-repeater-create="">
                                            <i data-feather="plus" class="me-25"></i>
                                            <span>Tambah</span>
                                        </button>
                                    </form>

                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px; ">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-icon btn-primary" id="SaveData">
                                        <i data-feather="plus" class="me-25"></i>
                                        <span>Simpan & Reset</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>
                                        <div class="power_controls">
                                            <br/>
                                            <img id="spin_button" src="spin_off.png" alt="Spin"
                                                 onClick="startSpin();"
                                                 style="cursor: pointer"/>
                                        </div>
                                    </td>
                                    <td height="582" class="the_wheel" align="center" valign="center">
                                        <canvas id="canvas" width="434" height="434">
                                            <p style="{color: white}" align="center">Sorry, your browser doesn't
                                                support canvas.
                                                Please
                                                try another.</p>
                                        </canvas>
                                    </td>
                                </tr>
                            </table>
                        </div>


                    </div>
                    <div class="row">
                        <div class="table-data">
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">


                    <div class="content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name">Data</label>
                                        <form action="#" class="data-repeatertab2">
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
                                        <button type="button" class="btn btn-icon btn-primary" id="SaveDatatab2">
                                            <i data-feather="plus" class="me-25"></i>
                                            <span>Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td>
                                            <div class="power_controls">
                                                <br/>
                                                <img id="spin_buttontab2" src="spin_off.png" alt="Spin" onClick="startSpintab2();"
                                                     style="cursor: pointer"/>
                                            </div>
                                        </td>
                                        <td height="582" class="the_wheel" align="center" valign="center">
                                            <canvas id="canvastab2" width="434" height="434">
                                                <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please
                                                    try another.</p>
                                            </canvas>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-datatab2">
                </div>
            </div>
        </div>
    </div>

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
                'canvasId'    : 'canvas',
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
        function alertPrize(indicatedSegment) {

            var countspin = selectspin + 1;
            var x = document.getElementById("show_no_" + selectspin);
            x.style.display = "block";

            $("#table_no_" + selectspin).empty();
            var tbody = document.getElementById("table_no_" + selectspin);
            var rowtabel = selectspin + 1
            document.getElementById("nametable" + selectspin).innerHTML = "Tabel Kelompok " + rowtabel + " " + indicatedSegment.text;
            var resultObject = search(indicatedSegment.text, data_user);
            Object.assign(resultObject, {tabel: selectspin, status: 0});
            data_user_tabel.push(resultObject)
            var no = 0
            for (var i = 0; i < data_user_tabel.length; i++) {
                if (data_user_tabel[i].tabel == selectspin) {
                    console.log(data_user_tabel[i].row)
                    for (var a = 0; a < data_user_tabel[i].row.length; a++) {
                        no = no + 1;
                        if (data_user_tabel[i].row[a].status == 1) {
                            var tr = "<tr style='background: red'>";
                        } else {
                            var tr = "<tr>";
                        }

                        /* Must not forget the $ sign */
                        tr += "<td>" + no + "</td>" + "<td>" + data_user_tabel[i].row[a].name + "</td></tr>";
                        /* We add the table row to the table body */
                        tbody.innerHTML += tr;
                    }
                }
            }
            selectspin = parseInt(selectspin + 1);

            // }


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
        var cols = document.getElementsByClassName('row');
        for(i = 0; i < cols.length; i++) {
            cols[i].style.display = 'block';
        }

        function makeTable(num) {

            var output = '<div class="row makan" style="">' +
                '<style> .row. {display: contents}</style>';
            //create num rows
            var count = 0;
            for (var i = 0; i < num; i++) {
                count = i + 1;
                //for each row
                var idtable = "table_no_" + i;
                var idshowbutton = "show_no_" + i;
                var nametable = "nametable" + i;
                output += '<div class="col-md-4">';
                output += '<p id="' + nametable + '" style="text-align:center">Table Kelompok ' + count + '</p>';
                output += '<table class="table">';
                output += ' <tr> <th>No</th> <th>Nama</th> </tr>'
                output += '<tbody id="' + idtable + '">'
                output += '</tbody>';
                output += '</table>';
                output += '<button id="' + idshowbutton + '" style="display: none" type="button"  data-id="' + i + '" onclick="getacak(this);" class="btn btn-icon btn-primary"> <i data-feather="plus" class="me-25"></i> <span>Acak & Pilih</span> </button>';
                output += '</div>';

            }
            output += '</div>';
            return output;
        }

        $('#SaveData').click(function () {
            var dataarray = $('.data-repeater').repeaterVal()
            selectspin = 0
            data_user_tabel = [];
            if (dataarray.data[0].data == "") {
                alert('Tambahkan Data Terlebih Dahulu.');
            } else {

                $(".table-data").html("");
                var result = makeTable(dataarray.data.length);
                $(".table-data").append(result);

                // dataarray.data = dataarray.data.sort(() => Math.random() - 0.5)
                if (dataarray.data.length != 0) {
                    luckdraw = [];
                    cek_input_class = true;
                    data_user = dataarray.data
                }
                var cek_jml = dataarray.data.length - 1;
                for (let i = 0; i < dataarray.data.length; i++) {
                    var datamahasiswa = dataarray.data[i].mahasiswa.split(/\n/g)
                    dataarray.data[i].row = []
                    datamahasiswa.forEach(myFunction);
                    function myFunction(item, index) {
                        dataarray.data[i].row.push({name: item, status: 0})
                    }
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
                for (var a = 0; a < data_user_tabel[i].row.length; a++) {
                    no = a + 1;
                    if (data_user_tabel[i].tabel == id) {
                        data_user_tabel[i].row[a].status =0
                    }
                    if (data_user_tabel[i].tabel == id && data_user_tabel[i].row[a].status == 0) {

                        acakdata.push(data_user_tabel[i].row[a])
                    }
                    if (no == data_user_tabel[i].row.length) {
                        acakdata = acakdata.sort(() => Math.random() - 0.5)
                    }
                }
            }
            alert("data yang terpilih adalah " + acakdata[0].name)
            $("#table_no_" + id).empty();
            var tbody = document.getElementById("table_no_" + id);
            acakdata[0].status = 1;
            var no = 0
            for (var i = 0; i < data_user_tabel.length; i++) {
                if (data_user_tabel[i].tabel == id) {
                    for (var a = 0; a < data_user_tabel[i].row.length; a++) {
                        if (acakdata[0].name == data_user_tabel[i].row[a].name) {
                            data_user_tabel[i].row[a].status = 1
                            var tr = "<tr style='background: red'>";
                        } else if (data_user_tabel[i].row[a].status == 1) {
                            var tr = "<tr style='background: red'>";
                        } else {
                            var tr = "<tr>";
                        }
                        no = no + 1;
                        /* Must not forget the $ sign */
                        tr += "<td>" + no + "</td>" + "<td>" + data_user_tabel[i].row[a].name + "</td></tr>";
                        /* We add the table row to the table body */
                        tbody.innerHTML += tr;
                    }
                }
            }

        }
    </script>
    <script>
        var selectspintab2 = 0;
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
        let luckdrawtab2 = [
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Lara'},
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Quiz'},
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Lucky'},
            {'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16), 'text': 'Draw'},
        ]
        var lengthDrawtab2 = luckdrawtab2.length;
        if (lengthDrawtab2 <= 10) {
            var textsizetab2 = 15
        } else {
            var textsizetab2 = 12
        }
        let data_usertab2 = '';
        let data_user_tabeltab2 = [];
        let cek_input_classtab2 = false
        let wheelPowertab2 = 0;
        let wheelSpinningtab2 = false;
        let audiotab2 = new Audio('tick.mp3');
        let theWheeltab2 = ''
        function winwheeltab2() {
            theWheeltab2 = new Winwheel({
                'canvasId'    : 'canvastab2',
                'outerRadius': 212,        // Set outer radius so wheel fits inside the background.
                'innerRadius': 75,         // Make wheel hollow so segments don't go all way to center.
                'textFontSize': textsizetab2,         // Set default font size for the segments.
                'textOrientation': 'horizontal', // Make text vertial so goes down from the outside of wheel.
                'textAlignment': 'center',    // Align text to outside of wheel.
                'numSegments': lengthDrawtab2,         // Specify number of segments.
                'segments': luckdrawtab2,            // Define segments including colour and text.
                'animation':           // Specify the animation to use.
                    {
                        'type': 'spinToStop',
                        'duration': 10,    // Duration in seconds.
                        'spins': 3,     // Default number of complete spins.
                        'callbackFinished': alertPrizetab2,
                        'callbackSound': playSoundtab2,   // Function to call when the tick sound is to be triggered.
                        'soundTrigger': 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                    },
                'pins':				// Turn pins on.
                    {
                        'number': lengthDrawtab2,
                        'fillStyle': 'silver',
                        'outerRadius': 4,
                    }
            });
        }
        // Loads the tick audio sound in to an audio object.
        // This function is called when the sound is to be played.
        function playSoundtab2() {
            // Stop and rewind the sound if it already happens to be playing.
            audiotab2.pause();
            audiotab2.currentTime = 0;
            // Play the sound.
            audiotab2.play();
        }
        winwheeltab2()
        // -------------------------------------------------------
        // Click handler for spin button.
        // -------------------------------------------------------
        function startSpintab2() {
            if (!cek_input_classtab2) {
                alert("Silahkan Tambahkan Data Terlebih Dahulu");
            } else {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinningtab2 == false) {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                    if (wheelPowertab2 == 1) {
                        theWheeltab2.animation.spins = 3;
                    } else if (wheelPowertab2 == 2) {
                        theWheeltab2.animation.spins = 6;
                    } else if (wheelPowertab2 == 3) {
                        theWheeltab2.animation.spins = 10;
                    }
                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_buttontab2').src = "spin_off.png";
                    document.getElementById('spin_buttontab2').className = "";
                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheeltab2.startAnimation();
                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinningtab2 = true;
                }
            }
        }
        function alertPrizetab2(indicatedSegment) {
            var countspintab2 = selectspintab2 + 1;

            if (countspintab2 > $('#jml_kel').val()) {
                selectspintab2 = 0
                var x = document.getElementById("show_no_tab2" + selectspintab2);
                x.style.display = "block";
                $("#table_no_tab2" + selectspintab2).empty();
                var tbodytab2 = document.getElementById("table_no_tab2" + selectspintab2);
                var resultObjecttab2 = searchtab2(indicatedSegment.text, data_usertab2);
                Object.assign(resultObjecttab2, {tabel: selectspintab2, status: 0});
                data_user_tabeltab2.push(resultObjecttab2)
                var notab2 = 0;
                for (var i = 0; i < data_user_tabeltab2.length; i++) {
                    if (data_user_tabeltab2[i].tabel == selectspintab2) {
                        notab2 = notab2 + 1;
                        var tr = "<tr>";
                        /* Must not forget the $ sign */
                        tr += "<td>" + notab2 + "</td>" + "<td>" + data_user_tabeltab2[i].data + "</td></tr>";
                        /* We add the table row to the table body */
                        tbodytab2.innerHTML += tr;
                    }
                }
                selectspintab2 = 1
            } else {
                var x = document.getElementById("show_no_tab2" + selectspintab2);
                x.style.display = "block";
                $("#table_no_tab2"+selectspintab2).empty();
                var tbodytab2 = document.getElementById("table_no_tab2" + selectspintab2);
                var resultObjecttab2 = searchtab2(indicatedSegment.text, data_usertab2);
                Object.assign(resultObjecttab2, {tabel: selectspintab2, status: 0});
                data_user_tabeltab2.push(resultObjecttab2)
                var notab2 = 0
                for (var i = 0; i < data_user_tabeltab2.length; i++) {
                    if (data_user_tabeltab2[i].tabel == selectspintab2) {
                        notab2 = notab2 + 1;
                        if(data_user_tabeltab2[i].status == 1){
                            var tr = "<tr style='background: red'>";
                        }
                        else{
                            var tr = "<tr>";
                        }
                        /* Must not forget the $ sign */
                        tr += "<td>" + notab2 + "</td>" + "<td>" + data_user_tabeltab2[i].data + "</td></tr>";
                        /* We add the table row to the table body */
                        tbodytab2.innerHTML += tr;
                    }
                }
                selectspintab2 = parseInt(selectspintab2 + 1);
            }
            $.each(luckdrawtab2, function (i) {
                if (luckdrawtab2[i].text === indicatedSegment.text) {
                    luckdrawtab2.splice(i, 1);
                    lengthDrawtab2 = luckdrawtab2.length;
                    if (lengthDrawtab2 <= 10) {
                        textsizetab2 = 15
                    } else {
                        textsizetab2 = 12
                    }
                    winwheeltab2()
                    return false;
                }
            });
            alert("You have won " + indicatedSegment.text);
            theWheeltab2.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
            theWheeltab2.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
            theWheeltab2.draw();                // Call draw to render changes to the wheel.
            wheelSpinningtab2 = false;          // Reset to false to power buttons and spin can be clicked again.
        }
        function searchtab2(nameKey, myArray) {
            for (var i = 0; i < myArray.length; i++) {
                if (myArray[i].data === nameKey) {
                    return myArray[i];
                }
            }
        }
        function makeTabletab2(num) {
            var output = '<div class="row">';
            //create num rows
            var count = 0;
            for (var i = 0; i < num; i++) {
                count = i + 1;
                //for each row
                var idtable = "table_no_tab2" + i;
                var idshowbutton = "show_no_tab2" + i;
                output += '<div class="col-md-4">';
                output += '<p style="text-align:center">Table Kelompok ' + count + '</p>';
                output += '<table class="table">';
                output += ' <tr> <th>No</th> <th>Data</th> </tr>'
                output += '<tbody id="' + idtable + '">'
                output += '</tbody>';
                output += '</table>';
                output += '<button type="button" id="'+idshowbutton+'" style="display: none" data-id="' + i + '" onclick="getacak(this);" class="btn btn-icon btn-primary"> <i data-feather="plus" class="me-25"></i> <span>Acak & Pilih</span> </button>';
                output += '</div>';
            }
            output += '</div>';
            return output;
        }
        $('#SaveDatatab2').click(function () {
            var dataarraytab2 = $('.data-repeatertab2').repeaterVal()
            let data_user_tabeltab2 = [];
            if ($('#jml_kel').val() == null || $('#jml_kel').val() == '') {
                alert("Masukkan Jumlah Kelompok Terlebih Dahulu")
            } else {
                if (dataarraytab2.data[0].data == "") {
                    alert('Tambahkan Data Terlebih Dahulu.');
                } else {
                    var count_kelompoktab2 = $('#jml_kel').val()
                    $(".table-datatab2").html("");
                    var resulttab2 = makeTabletab2(count_kelompoktab2);
                    $(".table-datatab2").append(resulttab2);
                    // dataarray.data = dataarray.data.sort(() => Math.random() - 0.5)
                    if (dataarraytab2.data.length != 0) {
                        luckdrawtab2 = [];
                        cek_input_classtab2 = true;
                        data_usertab2 = dataarraytab2.data
                    }
                    var cek_jmltab2 = dataarraytab2.data.length - 1;
                    for (let i = 0; i < dataarraytab2.data.length; i++) {
                        luckdrawtab2.push({
                            'fillStyle': '#' + Math.floor(Math.random() * 16777215).toString(16),
                            'text': dataarraytab2.data[i].data
                        });
                        if (i == cek_jmltab2) {
                            lengthDrawtab2 = luckdrawtab2.length;
                            if (lengthDrawtab2 <= 10) {
                                textsizetab2 = 15
                            } else {
                                textsizetab2 = 12
                            }
                            winwheeltab2()
                        }
                    }
                }
            }
        });
        $(document).ready(function () {
            $('.data-repeatertab2').repeater({
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
        function getacaktab2(elem) {
            var idtab2 = $(elem).data('id');
            var acakdatatab2 = [];
            var notab2 = 0
            for (var i = 0; i < data_user_tabeltab2.length; i++) {
                notab2 = i + 1;
                if (data_user_tabeltab2[i].tabel == id) {
                    data_user_tabeltab2[i].status =0
                }
                if (data_user_tabeltab2[i].tabel == idtab2 && data_user_tabeltab2[i].status == 0) {
                    acakdatatab2.push(data_user_tabeltab2[i])
                }
                if (notab2 == data_user_tabeltab2.length) {
                    acakdatatab2 = acakdatatab2.sort(() => Math.random() - 0.5)
                }
            }
            alert("data yang terpilih adalah "+acakdatatab2[0].data)
            $("#table_no_tab2" + idtab2).empty();
            var tbodytab2 = document.getElementById("table_no_tab2" + idtab2);
            acakdatatab2[0].status = 1;
            var notab2 = 0
            for (var i = 0; i < data_user_tabeltab2.length; i++) {
                if (data_user_tabeltab2[i].tabel == id) {
                    if(acakdatatab2[0].data == data_user_tabeltab2[i].data){
                        data_user_tabeltab2[i].status = 1
                        var trtab2 = "<tr style='background: red'>";
                    }
                    else if(data_user_tabeltab2[i].status == 1){
                        var trtab2 = "<tr style='background: red'>";
                    }
                    else{
                        var trtab2 = "<tr>";
                    }
                    notab2 = notab2 + 1;
                    /* Must not forget the $ sign */
                    trtab2 += "<td>" + notab2 + "</td>" + "<td>" + data_user_tabeltab2[i].data + "</td></tr>";
                    /* We add the table row to the table body */
                    tbodytab2.innerHTML += trtab2;
                }
            }
        }
    </script>
@endsection