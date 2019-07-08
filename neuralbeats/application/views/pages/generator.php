<!-- autori: Marija Jovanovic i Janko Kitanovic -->
<!-- shim -->
<script src="./inc/shim/Base64.js" type="text/javascript"></script>
<script src="./inc/shim/Base64binary.js" type="text/javascript"></script>
<script src="./inc/shim/WebAudioAPI.js" type="text/javascript"></script>
<!-- midi.js package -->
<script src="./js/midi/audioDetect.js" type="text/javascript"></script>
<script src="./js/midi/gm.js" type="text/javascript"></script>
<script src="./js/midi/loader.js" type="text/javascript"></script>
<script src="./js/midi/plugin.audiotag.js" type="text/javascript"></script>
<script src="./js/midi/plugin.webaudio.js" type="text/javascript"></script>
<script src="./js/midi/plugin.webmidi.js" type="text/javascript"></script>
<script src="./js/util/dom_request_xhr.js" type="text/javascript"></script>
<script src="./js/util/dom_request_script.js" type="text/javascript"></script>
<script src="./js/midi/player.js" type="text/javascript"></script>
<!-- jquery -->
<script src="./js/util/jquery-3.4.1.js" type="text/javascript"></script>

<script>
var speed=5;
var volume=0.5;
MIDI.loadPlugin({
	soundfontUrl: "./soundfont/",
	instrument: "acoustic_grand_piano",
	onprogress: function(state, progress) {
		console.log(state, progress);
	},
	onsuccess: function(){}
});
$(document).ready(function(){$.ajax({
	url: "index.php/generator_controller/open_session"
})});

function neural_update(slider_id){
	$.ajax({
		data: {id: parseInt(new RegExp(/\d+/).exec(slider_id)[0])-1, value: parseFloat(document.getElementById(slider_id).value)/100},
		url: "index.php/generator_controller/set_parameter",
		method: 'POST'
	});
}
function generate(){
	MIDI.WebAudio.getContext().resume();
	$.ajax({
		url: "index.php/generator_controller/generate",
		success: function(msg) {
			console.log(JSON.parse(msg));
			play_music(JSON.parse(msg));
		}
	});
}
function change_volume(value){
	volume=parseFloat(value)/100;
}
function change_speed(value){
	speed=parseFloat(value)/10;
}
function play_music(measure){
	for(var i=0;i<measure.length;i++){
		var delay=measure[i][0]/speed;
		if (i>0) delay-=measure[i-1][0]/speed;
		MIDI.noteOn(measure[i][1]%2, measure[i][3],parseInt(measure[i][4]*volume),delay);
		MIDI.noteOff(measure[i][1]%2, measure[i][3], measure[i][2]/speed+delay);
	}
}
</script>
<div class="flex-container-main">
    <div><font size="10">
        Generator Muzike<br/>
        </font>
    </div>
    <div>
        Neuralni Slajderi:
    </div>
    <div>
        <table style="width:100%">
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_1">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_2">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_3">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_4">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_5">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_6">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_7">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_8">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_9">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_10">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_11">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_12">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_13">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_14">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_15">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_16">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_17">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_18">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_19">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_20">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_21">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_22">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_23">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_24">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_25">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_26">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_27">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_28">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_29">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_30">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_31">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_32">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_33">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_34">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_35">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_36">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_37">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_38">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_39">
                </td>
                <td>
                    <input type="range" min="0" max="100" value="50" class="neural slider" onchange="neural_update(this.id)" id="Neural_40">
                </td>
            </tr>
        </table>

    </div>
    <div><button type="button">Randomize</button></form></div>
    <div>Jacina:</div><div> <input type="range" min="0" max="100" value="50" onchange="change_volume(this.value)" class="slider" id="Volume"></div>
    <div>Brzina:</div><div> <input type="range" min="1" max="100" value="50" onchange="change_speed(this.value)" class="slider" id="Speed"></div>
    <!--<div><button onclick="if (document.getElementById('Record')) {
                document.getElementById('Record').id = 'Stop';
                document.getElementById('Stop').textContent = 'Stop';
				
            } else {
                document.getElementById('Stop').id = 'Record';
                document.getElementById('Record').textContent = 'Record';
            }" type="button" id="Record">Record</button>-->
		<div><button onclick="generate();" type="button" id="Play">Play next measure</button>
        <div><button type="button">Sacuvati</button></form></div>
    </div>
</div>