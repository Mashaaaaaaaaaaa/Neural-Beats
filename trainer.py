from os import walk
import keras as tf
import numpy as np
import re
import random
from os import listdir as ls
from os import remove as rm

# model = tf.models.Sequential()
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=2048,
#                     input_shape=(2560,)))
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=1536))
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=1024))
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=512))
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=1024))
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=1536))
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=2048))
# model.add(
#     tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(), units=2560))
# model.compile(
#     optimizer='adam',
#     loss=tf.losses.mean_squared_error,
#     metrics=[tf.metrics.mean_squared_error]
# )
# model.summary()

files = ls(".\\")

brain_type = "betterbrain"


def extract_number(f):
    if brain_type not in f:
        return -1
    s = re.findall("\d+$", f)
    return int(s[0]) if s else -1


brain_version = 0
f = max(files, key=extract_number)
brain_version = int(re.findall("\d+$", f)[0])
model = tf.models.load_model(".\\" + f)
model.summary()
training_dataset = []

filecount = 0


def load_files(file_list):
    result = np.zeros((len(file_list), 2560))
    for f in range(len(file_list)):
        file_name = file_list[f]
        file = open(file_name)
        lines = file.readlines()
        file.close()
        for i in range(len(lines)):
            if i >= 512:
                break
            tokens = lines[i].rstrip().split(',')
            # if len(tokens) != 3:
            if len(tokens) != 4:
                continue
            data = tokens[3].split(' ')
            if len(data) != 2:
                continue
            result[f, i * 5] = float(int(tokens[0])) / 1920
            result[f, i * 5 + 1] = float(int(tokens[1])) / 32
            result[f, i * 5 + 2] = min(float(int(tokens[2])) / 960, 1)
            result[f, i * 5 + 3] = float(int(data[0], base=16)) / 256
            result[f, i * 5 + 4] = float(int(data[1], base=16)) / 256
            # result[f, i * 5 + 2] = float(int(data[0], base=16)) / 256
            # result[f, i * 5 + 3] = float(int(data[1], base=16)) / 256
            # result[f, i * 5 + 4] = float(int(data[2], base=16)) / 256
    return result


def parse_all_files(dir_path):
    for cur_dir, subdir_list, file_list in walk(dir_path):
        for subdir in subdir_list:
            parse_all_files(subdir)
        for file_name in file_list:
            if len(file_list)<8:
                break
            if "encoded" in file_name or "decoded" in file_name:
                rm(cur_dir + "\\" + file_name)
                continue
            global training_dataset
            training_dataset.append(cur_dir + "\\" + file_name)
    #            t_set = [0] * 5120
    #            global filecount
    #            filecount += 1
    #            if filecount % 500 == 0:
    #                print("Reading file #" + str(filecount))
    #            file = open(cur_dir + "\\" + file_name)
    #            lines = file.readlines()
    #            global training_dataset
    #            file.close()
    #            for i in range(len(lines)):
    #                if i >= 1024:
    #                    break
    #                tokens = lines[i].split(',')
    #                if len(tokens) != 3:
    #                    continue
    #                data = tokens[2].split(' ')
    #                if len(data) != 3 or "\n" in data:
    #                    continue
    #                t_set[i * 5] = float(int(tokens[0])) / 1920
    #                t_set[i * 5 + 1] = float(int(tokens[1])) / 32
    #                t_set[i * 5 + 2] = float(int(data[0], base=16)) / 256
    #                t_set[i * 5 + 3] = float(int(data[1], base=16)) / 256
    #                t_set[i * 5 + 4] = float(int(data[2], base=16)) / 256
    #                training_dataset.append(t_set)
    return


parse_all_files("E:\\splits\\")

while True:
    brain_version += 100
    # training_tensor = np.random.sample(training_dataset, 32)
    training_tensor = load_files(random.sample(training_dataset, 16000))
    #training_tensor=load_files(training_dataset)
    model.fit(x=training_tensor, y=training_tensor, batch_size=32, epochs=10)
    print("Finished Training iteration #" + str(brain_version))
    if brain_version % 100 == 0:
        model.save("./" + brain_type + str(brain_version))
        weights = model.get_weights()
        encoder = tf.models.Sequential()
        encoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=512,
                            input_shape=(2560,), weights=[weights[0], weights[1]]))
        '''encoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=2048,
                            input_shape=(2560,), weights=[weights[0], weights[1]]))
        encoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=1536, weights=[weights[2], weights[3]]))
        encoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=1024, weights=[weights[4], weights[5]]))
        encoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=512, weights=[weights[6], weights[7]]))'''
        encoder.compile(
            optimizer='adam',
            loss=tf.losses.mean_squared_error,
            metrics=[tf.metrics.mean_squared_error]
        )
        encoder.save("./encoder" + str(brain_version))
        # encoder.summary()
        decoder = tf.models.Sequential()
        decoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=2560,
                            input_shape=(512,), weights=[weights[2], weights[3]]))
        '''decoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=1024,
                            input_shape=(512,), weights=[weights[8], weights[9]]))
        decoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=1536, weights=[weights[10], weights[11]]))
        decoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=2048, weights=[weights[12], weights[13]]))
        decoder.add(
            tf.layers.Dense(activation=tf.activations.sigmoid, kernel_initializer=tf.initializers.glorot_normal(),
                            units=2560, weights=[weights[14], weights[15]]))'''
        decoder.compile(
            optimizer='adam',
            loss=tf.losses.mean_squared_error,
            metrics=[tf.metrics.mean_squared_error]
        )
        decoder.save("./decoder" + str(brain_version))
        print("Saved brain #" + str(brain_version))
        # decoder.summary()
