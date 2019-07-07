//2015/0231 Marija Jovanovic
/*
MeasureGenerator 1.0 - ova klasa ucitava LSTM-generator muzike i generise muziku
*/
'use strict'

const internal = {};
const tfjs = require('./node_modules/@tensorflow/tfjs-node');
const math = require("./node_modules/mathjs");
let LSTM = null;
let PCA_decoder = null;
let _LSTM_path = null;
let _PCA_decoder_path = null;
let _LSTM_data = null;
let _parameters = Array(40).fill(0.5);
let _used_parameters=Array(40).fill(0.5);

module.exports = internal.MeasureGenerator = class {
	/*
	konstruktor, cuva puteve na mozgove
	*/
    constructor(LSTM_path, PCA_decoder_path) {
        _LSTM_path = LSTM_path;
        _PCA_decoder_path = PCA_decoder_path;
    }
	/*
	menja neki parametar po id tog parametra
	*/
    set_parameter(id, value) {
        if (id > 39 || id < 0) {
            throw "Out of bounds!";
        } else {
            _parameters[id] = value;
        }
    }
	/*
	generise muziku
	*/
    async generate() {
        if (null == LSTM) LSTM = await tfjs.loadLayersModel(_LSTM_path);
        if (null == PCA_decoder) PCA_decoder = await tfjs.loadLayersModel(_PCA_decoder_path);
        if (JSON.stringify(_parameters)!=JSON.stringify(_used_parameters) || null == _LSTM_data) {
            _used_parameters=[..._parameters];
            let decoded = PCA_decoder.predict(tfjs.tensor2d(_parameters, [1, 40]));
            decoded = await decoded.data();
            decoded = Array.prototype.slice.call(decoded);
            _LSTM_data = math.reshape(decoded, [1, 8, 512]);
            //console.log("Updated parameters!");
        }
        let new_elem = await LSTM.predict(tfjs.tensor3d(_LSTM_data)).data();
        new_elem = Array.prototype.slice.call(new_elem);
        _LSTM_data[0] = _LSTM_data[0].slice(1, 8);
        _LSTM_data[0].push(new_elem);
        return new_elem;
    }
	toJSON(){
		return{
			LSTM_path: _LSTM_path,
			PCA_decoder_path: _PCA_decoder_path,
			parameters: _parameters,
			used_parameters: _used_parameters,
			LSTM_data: _LSTM_data
		};
	}
	static fromJSON(obj){
		_parameters=obj.parameters;
		_used_parameters=obj.parameters;
		_LSTM_data=obj.LSTM_data;
		return this(obj.LSTM_path, obj.PCA_decoder_path);
	}
}

/*let generator = new internal.MeasureGenerator("https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/LSTM/model.json", "https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/PCADecoder/model.json");
let Decoder = require('./MeasureAutoencoder');
let decoder = new Decoder("https://raw.githubusercontent.com/M-J-Jovanovic/Neural-Beats/master/dnode-server/decoder/model.json")
generator.generate().then(function (value) {
    decoder.decode(value).then(function (value) {
        console.log(value);
        generator.generate().then(function (value) {
            decoder.decode(value).then(function (value) {
                console.log(value);
            });
        });
    });
});
*/