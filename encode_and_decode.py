from os import walk
import keras as tf
import numpy as np
import math
import re
import random
from os import listdir as ls

encoder = tf.models.load_model("encoder14300")
decoder = tf.models.load_model("decoder14300")

filecount = 0


def parse_all_files(dir_path):
    global filecount
    for cur_dir, subdir_list, file_list in walk(dir_path):
        for subdir in subdir_list:
            parse_all_files(subdir)
        for file_name in file_list:
            if "decoded" in file_name or "encoded" in file_name:
                continue
            filecount += 1
            if filecount % 500 == 0:
                print("Parsing file #" + str(filecount))
            content = np.zeros((1, 2560))
            file = open(cur_dir + "\\" + file_name)
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
                content[0, i * 5] = float(int(tokens[0])) / 1920
                content[0, i * 5 + 1] = float(int(tokens[1])) / 32
                content[0, i * 5 + 2] = min(float(int(tokens[2])) / 960, 1)
                content[0, i * 5 + 3] = float(int(data[0], base=16)) / 256
                content[0, i * 5 + 4] = float(int(data[1], base=16)) / 256
            encoded = encoder.predict(content)
            encoding_output = ""
            for number in encoded[0]:
                if (len(encoding_output) != 0):
                    encoding_output += " "
                encoding_output += str(number)
            file = open(cur_dir + "\\" + file_name + " encoded", "wt")
            file.write(encoding_output)
            file.close()
            decoded = decoder.predict(encoded)
            decoding_output = ""
            for i in range(len(decoded[0])):
                if i % 5 == 0:
                    t_output = ""
                    t_output += str(int(round(1920 * decoded[0, i])))
                if len(decoding_output) > 0 and i % 5 == 0:
                    t_output = "\n" + t_output
                if i % 5 == 1:
                    t_output += "," + str(int(math.floor(32 * decoded[0, i])))
                if i % 5 == 2:
                    t_output += "," + str(int(math.ceil(960 * decoded[0, i])))
                if i % 5 == 3:
                    t_output += "," + hex(int(math.floor(256 * decoded[0, i])))[2:]
                if i % 5 == 4:
                    t_output += "," + hex(int(math.floor(256 * decoded[0, i])))[2:]
                    if int(t_output.split(",")[-1], base=16) + int(t_output.split(",")[-2], base=16) > 15:
                        decoding_output += t_output
            file = open(cur_dir + "\\" + file_name + " decoded", "wt")
            file.write(decoding_output)
            file.close


parse_all_files("D:\\splits\\")
