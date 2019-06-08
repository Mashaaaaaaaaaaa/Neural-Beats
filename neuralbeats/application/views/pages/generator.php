<!-- autori: Marija Jovanovic i Janko Kitanovic -->
<!-- shim -->
<script src="../inc/shim/Base64.js" type="text/javascript"></script>
<script src="../inc/shim/Base64binary.js" type="text/javascript"></script>
<script src="../inc/shim/WebAudioAPI.js" type="text/javascript"></script>
<!-- midi.js package -->
<script src="../js/midi/audioDetect.js" type="text/javascript"></script>
<script src="../js/midi/gm.js" type="text/javascript"></script>
<script src="../js/midi/loader.js" type="text/javascript"></script>
<script src="../js/midi/plugin.audiotag.js" type="text/javascript"></script>
<script src="../js/midi/plugin.webaudio.js" type="text/javascript"></script>
<script src="../js/midi/plugin.webmidi.js" type="text/javascript"></script>
<script src="../js/midi/player.js" type="text/javascript"></script>
<script>
var session_id;
var speed=5;
var volume=0.5;
var xhttp=new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		session_id = parseInt(this.responseText);
	}
};
xhttp.open("POST", "generator_controller.php/open_session", true);
xhttp.send();
function neural_update(slider_id){
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {};
	xhttp.open("POST", "generator_controller.php/set_parameter", true);
	var id=parseInt(new RegExp(/\d+/).exec(slider_id)[0])-1;
	var value=parseFloat(document.getElementById(slider_id).value);
	xhttp.send("id="+id+"&value="+value+"&sid="+session_id);
}
window.onbeforeunload=function(){
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {};
	xhttp.open("POST", "generator_controller.php/close_session", true);
	xhttp.send("sid="+session_id);
}
function generate(){
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			play_music(JSON.parse(this.responseText));
		}
	};
	xhttp.open("POST", "generator_controller.php/generate", true);
	xhttp.send("sid="+session_id);
}
function change_volume(value){
	volume=parseFloat(value)/100;
}
function change_speed(value){
	speed=parseFloat(value)/10;
}
function play_music(){
	for(var i=0;i<measure.length;i++){
		var delay=measure[i][0]/speed;
		if (i>0) delay-=measureExample[i-1][0]/speed;
		MIDI.noteOn(measureExample[i][1]%16, measureExample[i][3],parseInt(measureExample[i][4]*volume),delay);
		MIDI.noteOff(measureExample[i][1]%16, measureExample[i][3], measureExample[i][2]/speed+delay);
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