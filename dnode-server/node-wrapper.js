//2015/0231 Marija Jovanovic
/*
omotac funkcionalnosti generatora, pozivani direktno iz PHP, verzija 1.0
*/
'use strict'

const Generator=require("./MeasureGenerator");
const Decoder=require("./MeasureAutoencoder");
const args=process.argv.slice(2);
if(args[0]=="open"){
	const generator=new Generator("https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/LSTM/model.json", "https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/PCAdecoder/model.json");
	generator.generate().then(function (value) {
		process.stdout.write(JSON.stringify(generator.toJSON()));
	});
	//process.stdout.write(JSON.stringify(generator.toJSON()));
}
const decoder=new Decoder("https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/decoder/model.json");
// const server=dnode({
	// /*
	// kreira instancu generator muzike za tekucu sesiju i vraca id sesije
	// */
    // open_session: function(callback){
		// process.stdout.write("Attempting to open session.\n");
        // generators[sid]=new Generator("https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/LSTM/model.json", "https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/PCADecoder/model.json");
		// process.stdout.write("Opened session number "+str(sid)+".\n");
        // callback(sid++);
    // },
	// /*
	// menja neki parametar
	// */
    // set_parameter: function(id, value, session_id){
        // if(!Object.keys(generators).includes(session_id)) return;
        // generators[session_id].set_parameter(id%40,value/100)
    // },
	// /*
	// generise muziku i prevodi nju u citljivi format, vraca niz u tom citljivom formatu
	// */
    // generate: function(session_id,callback){
        // if(!Object.keys(generators).includes(session_id)) return;
        // generators[session_id].generate().then(function(value){
            // decoder.decode(value).then(function(decoded_value){
                // callback(JSON.stringify(decoded_value));
            // });
        // });
    // },
	// /*
	// brise instancu generatora muzike za ovu sesiju
	// */
    // close_session: function(session_id){
        // if(!Object.keys(generators).includes(session_id)) return;
        // delete generators[session_id];
    // }
// });

