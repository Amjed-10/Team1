import json
import tensorflow as tf
from tensorflow.keras.models import model_from_json

# تحميل ملف JSON للنموذج
json_file_path = 'Team1_Face_recognition_model_names.json'  # قم بتحديث المسار حسب الحاجة
weights_file_path = 'Team1_Face_recognition_model.h5'  # قم بتحديث المسار حسب الحاجة

with open(json_file_path, 'r') as file:
    model_config = json.load(file)

# تعديل طبقات DepthwiseConv2D لإزالة المعلمة 'groups'
for layer in model_config['config']['layers']:
    if layer['class_name'] == 'DepthwiseConv2D' and 'groups' in layer['config']:
        del layer['config']['groups']  # إزالة المعلمة غير المدعومة 'groups'

# حفظ ملف JSON المعدل
modified_json_file_path = 'modified_model.json'
with open(modified_json_file_path, 'w') as file:
    json.dump(model_config, file)

# تحميل النموذج المعدل من JSON
with open(modified_json_file_path, 'r') as file:
    loaded_model_json = file.read()

# تمرير custom_objects للتأكد من تحميل أي طبقات مخصصة بما في ذلك 'Functional'
custom_objects = {
    'DepthwiseConv2D': tf.keras.layers.DepthwiseConv2D,
    'Functional': tf.keras.models.Model  # تمرير 'Functional' كـ custom object
}

# تحميل النموذج
model = model_from_json(loaded_model_json, custom_objects=custom_objects)

# تحميل الأوزان
model.load_weights(weights_file_path)

# طباعة ملخص النموذج للتأكد من التحميل
model.summary()