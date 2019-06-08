//2015/0231 Marija Jovanovic
/*
DNode server 0.3 - koristi se kao omotac funkcionalnosti neuralnih mreza za pozive iz php
*/
'use strict'

const dnode=require("./node_modules/dnode");
const Generator=require("./MeasureGenerator");
const Decoder=require("./MeasureAutoencoder");
const generators={};
let sid=0;
const decoder=new Decoder("https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/decoder/model.json");
const server=dnode({
	/*
	kreira instancu generator muzike za tekucu sesiju i vraca id sesije
	*/
    open_session: function(callback){
        generators[sid]=new Generator("https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/LSTM/model.json", "https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/PCADecoder/model.json");
        callback(sid++);
    },
	/*
	menja neki parametar
	*/
    set_parameter: function(id, value, session_id){
        if(!Object.keys(generators).includes(session_id)) return;
        generators[session_id].set_parameter(id%40,value/100)
    },
	/*
	generise muziku i prevodi nju u citljivi format, vraca niz u tom citljivom formatu
	*/
    generate: function(session_id,callback){
        if(!Object.keys(generators).includes(session_id)) return;
        generators[session_id].generate().then(function(value){
            decoder.decode(value).then(function(decoded_value){
                callback(JSON.stringify(decoded_value));
            });
        });
    },
	/*
	brise instancu generatora muzike za ovu sesiju
	*/
    close_session: function(session_id){
        if(!Object.keys(generators).includes(session_id)) return;
        delete generators[session_id];
    }
});
server.listen(7070);