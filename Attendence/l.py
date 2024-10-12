import json
import tensorflow as tf
from tensorflow.keras.models import model_from_json

json_file_path = 'Team1_Face_recognition_model_names.json' 
weights_file_path = 'Team1_Face_recognition_model.h5'  

with open(json_file_path, 'r') as file:
    model_config = json.load(file)

for layer in model_config['config']['layers']:
    if layer['class_name'] == 'DepthwiseConv2D' and 'groups' in layer['config']:
        del layer['config']['groups'] 

modified_json_file_path = 'modified_model.json'
with open(modified_json_file_path, 'w') as file:
    json.dump(model_config, file)

with open(modified_json_file_path, 'r') as file:
    loaded_model_json = file.read()

custom_objects = {
    'DepthwiseConv2D': tf.keras.layers.DepthwiseConv2D,
    'Functional': tf.keras.models.Model 
}

model = model_from_json(loaded_model_json, custom_objects=custom_objects)

model.load_weights(weights_file_path)

model.summary()
