from os import walk
import keras as tf
import numpy as np
import re
import random
from os import listdir as ls
from os import remove as rm
#import tensorflowjs as tfjs

model = tf.models.Sequential()
model.add(tf.layers.LSTM(512, input_shape=(8, 512)))
model.compile(
    optimizer='adam',
    loss=tf.losses.mean_squared_error
)

files = ls(".\\")

brain_type = "simpleLSTMbrain"


def extract_number(f):
    if brain_type not in f:
        return -1
    s = re.findall("\d+$", f)
    return int(s[0]) if s else -1


brain_version = 0
f = max(files, key=extract_number)
#brain_version = int(re.findall("\d+$", f)[0])
#model = tf.models.load_model(".\\" + f)
model.summary()
training_dataset = []
filecount = 0

lastNum = re.compile(r'(?:[^\d]*(\d+)[^\d]*)+')


def increment(s):
    m = lastNum.search(s)
    if m:
        next = str(int(m.group(1)) + 1)
        start, end = m.span(1)
        s = s[:max(end - len(next), start)] + next + s[end:]
    return s


def load_files(samples):
    result_x = []
    result_y = []
    for s in range(len(samples)):
        result_x.append([])
        for f in range(len(samples[s])):
            file_name = samples[s][f]
            file = open(file_name)
            values = " ".join(file.readlines()).split(" ")
            file.close()
            result_x[s].append(values)
            if f == len(samples[s]) - 1:
                file_name = increment(file_name)
                file = open(file_name)
                values = " ".join(file.readlines()).split(" ")
                file.close()
                result_y.append(values)
    return np.reshape(np.array(result_x), (len(samples), 8, 512)), np.reshape(np.array(result_y), (len(samples), 512))


def parse_all_files(dir_path):
    for cur_dir, subdir_list, file_list in walk(dir_path):
        for subdir in subdir_list:
            parse_all_files(subdir)
        # for file_name in file_list:
        #    if "encoded" not in file_name:
        #        #rm(cur_dir + "\\" + file_name)
        #        while file_name in file_list:
        #            file_list.remove(file_name)
        file_list = [F for F in file_list if "encoded" in F]
        if len(file_list) < 9:
            continue
        file_list.sort(key=lambda f: int(re.findall('\d+', f)[0]))
        global training_dataset
        for i in range(len(file_list)):
            if len(file_list) - i < 9:
                break
            t_set = []
            for j in range(i, i + 9):
                t_set.append(cur_dir + "\\" + file_list[j])
            training_dataset.append(t_set[0:8])

    return


parse_all_files("D:\\splits\\")
train_data = []
test_data = []

for i in range(len(training_dataset)):
    if random.random() > 0.7:
        test_data.append(training_dataset[i])
    else:
        train_data.append(training_dataset[i])

while True:
    brain_version += 100
    # training_tensor = np.random.sample(training_dataset, 32)
    # training_tensor = load_files(random.sample(training_dataset, 16000))
    train_files = random.sample(train_data, 1600)
    test_files = random.sample(test_data, 640)
    trainX, trainY = load_files(train_files)
    testX, testY = load_files(test_files)
    print(trainX.shape)
    model.fit(x=trainX, y=trainY, epochs=10, validation_data=(testX, testY),
              callbacks=[tf.callbacks.TensorBoard()])  # ,tf.callbacks.ReduceLROnPlateau(min_lr=0.0001)])
    print("Finished Training iteration #" + str(brain_version))
    if brain_version % 100 == 0:
        model.save("./" + brain_type + str(brain_version))
        print("Saved brain #" + str(brain_version))
