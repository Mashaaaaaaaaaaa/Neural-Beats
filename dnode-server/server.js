'use strict'

const dnode=require("./node_modules/dnode");
const Generator=require("./MeasureGenerator");
const Decoder=require("./MeasureAutoencoder");
const generators={};
let sid=0;
const decoder=new Decoder("file://C:\\Users\\Mashallah\\IdeaProjects\\NeuralBeats/decoder/model.json");
const server=dnode({
    open_session: function(callback){
        generators[sid]=new Generator("file://C:\\Users\\Mashallah\\IdeaProjects\\NeuralBeats/LSTM/model.json", "file://C:\\Users\\Mashallah\\IdeaProjects\\NeuralBeats/PCADecoder/model.json");
        callback(sid++);
    },
    set_parameter: function(id, value, session_id){
        if(!Object.keys(generators).includes(session_id)) return;
        generators[session_id].set_parameter(id%40,value/100)
    },
    generate: function(session_id,callback){
        if(!Object.keys(generators).includes(session_id)) return;
        generators[session_id].generate().then(function(value){
            decoder.decode(value).then(function(decoded_value){
                callback(decoded_value);
            });
        });
    },
    close_session: function(session_id){
        if(!Object.keys(generators).includes(session_id)) return;
        delete generators[session_id];
    }
});
server.listen(7070);