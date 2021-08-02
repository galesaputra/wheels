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
                    <select class="form-control" name="topics_title" id="class_selected" style="height: auto">
                        <option disabled selected>Pilih Kelas</option>
                        @foreach($class_get as $row)
                            <option value="{{$row->topics_title}}">{{$row->topics_title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <div class="power_controls">
                            <br/>
                            <img id="spin_button" src="spin_off.png" alt="Spin" onClick="startSpin();" style="cursor: pointer"/>
                        </div>
                    </td>
                    <td width="438" height="582" class="the_wheel" align="center" valign="center">
                        <canvas id="canvas" width="434" height="434">
                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please
                                try another.</p>
                        </canvas>
                    </td>
                    <td width="438" height="582"  align="center" valign="center">
                        <table style="width:100%" class="table">
                            <tr>
                                <th>No</th>
                                <th>nama</th>
                                <th>Email</th>
                            </tr>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            <script>
                // Create new wheel object specifying the parameters at creation time.

            </script>

        </div>


    </div>
@endsection
@section('javascript')
    <script>
        let luckdraw= [
            {'fillStyle': '#'+Math.floor(Math.random()*16777215).toString(16), 'text': 'Lara'},
            {'fillStyle': '#'+Math.floor(Math.random()*16777215).toString(16), 'text': 'Quiz'},
            {'fillStyle': '#'+Math.floor(Math.random()*16777215).toString(16), 'text': 'Lucky'},
            {'fillStyle': '#'+Math.floor(Math.random()*16777215).toString(16), 'text': 'Draw'},
        ]
        var lengthDraw = luckdraw.length;
        if(lengthDraw <= 10){
            var textsize = 15
        }
        else{
            var textsize = 12
        }
        let data_user = '';
        let data_user_tabel = [];
        let cek_input_class = false
        let wheelPower = 0;
        let wheelSpinning = false;
        let audio = new Audio('tick.mp3');
        let theWheel = ''
        function winwheel () {

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
            if(!cek_input_class){
                alert("Silahkan Pilih Kelas Terlebih Dahulu");
            }
            else{
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
            // Just alert to the user what happened.
            // In a real project probably want to do something more interesting than this with the result.
            if (indicatedSegment.text == 'LOOSE TURN') {
                alert('Sorry but you loose a turn.');
            } else if (indicatedSegment.text == 'BANKRUPT') {
                alert('Oh no, you have gone BANKRUPT!');
            } else {
                var resultObject = search(indicatedSegment.text, data_user);
                data_user_tabel.push(resultObject)
                $("#tbody").empty();
                var tbody = document.getElementById('tbody');

                for (var i = 0; i < data_user_tabel.length; i++) {
                    var no =i+1;
                    var tr = "<tr>";

                    /* Must not forget the $ sign */
                    tr += "<td>" + no + "</td>" +"<td>" + data_user_tabel[i].name + "</td>" + "<td>$" + data_user_tabel[i].email + "</td></tr>";
                    /* We add the table row to the table body */
                    tbody.innerHTML += tr;
                }
                $.each(luckdraw, function(i){
                    if(luckdraw[i].text === indicatedSegment.text) {
                        luckdraw.splice(i,1);
                        lengthDraw = luckdraw.length;
                        if(lengthDraw <= 10){
                            textsize = 15
                        }
                        else{
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
        }
        function search(nameKey, myArray){
            for (var i=0; i < myArray.length; i++) {
                if (myArray[i].name === nameKey) {
                    return myArray[i];
                }
            }
        }
        $('#class_selected').change(function () {
            var data = $(this).val();
            if (data) {
                $.ajax({
                    type: "GET",
                    url: "/get-users-by-class/" + data,
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.response.length != 0){
                            luckdraw = [];
                            cek_input_class = true;
                            data_user =  res.response
                        }
                        var cek_jml = res.response.length - 1;
                        for (let i = 0; i < res.response.length; i++) {
                            luckdraw.push({'fillStyle': '#'+Math.floor(Math.random()*16777215).toString(16), 'text': res.response[i].name});
                            if(i == cek_jml){
                                 lengthDraw = luckdraw.length;
                                if(lengthDraw <= 10){
                                     textsize = 15
                                }
                                else{
                                     textsize = 12
                                }
                                winwheel()
                            }
                        }

                    }

                });
            }
        })
    </script>
@endsection
