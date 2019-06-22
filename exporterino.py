import keras as K
import tensorflowjs as tfjs

mydecoder = K.models.load_model(".\\decoder14300")
myLSTM = K.models.load_model(".\\simpleLSTMbrain200")
tfjs.converters.save_keras_model(mydecoder, "decoder")
tfjs.converters.save_keras_model(myLSTM, "LSTM")
