'use strict'

const dnode=require("dnode");
const Generator=require("./MeasureGenerator");
const Decoder=require("./MeasureAutoencoder");
const generator=new Generator("file://C:\\Users\\Mashallah\\IdeaProjects\\NeuralBeats/LSTM/model.json", "file://C:\\Users\\Mashallah\\IdeaProjects\\NeuralBeats/PCADecoder/model.json");
const decoder=new Decoder("file://C:\\Users\\Mashallah\\IdeaProjects\\NeuralBeats/decoder/model.json");
const server=dnode({
    set_parameter: function(id, value){generator.set_parameter(id,value)},
    generate: function(callback){
        generator.generate().then(function(value){
            decoder.decode(value).then(function(decoded_value){
                callback(decoded_value);
            });
        });
    }
});
server.listen(7070);