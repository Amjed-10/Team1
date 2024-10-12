import cv2
import os
import numpy as np
import face_recognition
import csv
from datetime import datetime
from tensorflow.keras.models import model_from_json
from tensorflow.keras.utils import get_custom_objects
import tensorflow as tf

# تسجيل Functional ككائن مخصص
get_custom_objects().update({'Functional': tf.keras.Model})

# تحميل النموذج المضاد للتزييف
face_cascade = cv2.CascadeClassifier("Team1_Face_recognition_model_classes.xml")

# تحميل النموذج من ملف JSON
json_file = open('modified_model.json', 'r')
loaded_model_json = json_file.read()
json_file.close()
model = model_from_json(loaded_model_json)
model.load_weights('Team1_Face_recognition_model.h5')
print("Antispoofing Model loaded from disk")

# تعريف قائمة الوجوه المعروفة
known_faces = {
    "Ziad Mahmoud W1": r"Photo\(4).jpg",
    "AbdElrahman Ahmed W4": r"Photo\(2).jpg",
    "Abdullah Mohammed W2": r"Photo\(3).jpg",
    "Ziad Muhammad W3": r"Photo\(5).jpg",
    "Mohamed Khaled W4": r"Photo\(6).jpg",
    "Ahmed Siraj W4": r"Photo\(8).jpg",
    "mo W2": r"Photo\(9).jpg",
    "Amjed Khaled W1": r"Photo\(10).jpg",
    "Zyad ayman S3": r"Photo\(1).jpg"
}


# إعدادات الترميز للوجوه المعروفة
known_face_encodings = []
known_faces_names = list(known_faces.keys())

for name, image_path in known_faces.items():
    image = face_recognition.load_image_file(image_path)
    image_rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    encoding = face_recognition.face_encodings(image_rgb)[0]
    known_face_encodings.append(encoding)

# تشغيل كاميرا الفيديو
video_capture = cv2.VideoCapture(0)

face_locations = []
face_encodings = []
face_names = []
s = True

# إعداد ملف CSV لتسجيل الحضور
now = datetime.now()
current_date = now.strftime("%Y-%m-%d")

f = open(current_date + ".csv", 'w+', newline="")
inwriter = csv.writer(f)
inwriter.writerow(["id", "student_name", "status", "date", "class_id"])

recorded_names = []
id_counter = 1

while True:
    ret, frame = video_capture.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(gray, 1.3, 5)

    for (x, y, w, h) in faces:
        face = frame[y - 5:y + h + 5, x - 5:x + w + 5]
        resized_face = cv2.resize(face, (160, 160))
        resized_face = resized_face.astype("float") / 255.0
        resized_face = np.expand_dims(resized_face, axis=0)

        preds = model.predict(resized_face)[0]
        label = "Real" if preds <= 0.5 else "Fake"
        print(f"Liveness Detection: {label} with confidence {preds}")

        if label == "Real":
            small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)
            rgb_small_frame = np.ascontiguousarray(small_frame[:, :, ::-1])

            if s:
                face_locations = face_recognition.face_locations(rgb_small_frame)
                face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)

                for face_encoding in face_encodings:
                    matches = face_recognition.compare_faces(known_face_encodings, face_encoding)
                    name = ""

                    face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
                    best_match_index = np.argmin(face_distances)

                    if matches[best_match_index]:
                        name = known_faces_names[best_match_index]

                    face_names.append(name)

                    person_class = name.split()[-1] if name else "Unknown"

                    if name in known_faces_names and name not in recorded_names:
                        recorded_names.append(name)
                        current_time = now.strftime("%H-%M-%S")
                        inwriter.writerow([id_counter, name, "Present", current_time, person_class])
                        print(f"Recorded: {name} at {current_time}")
                        id_counter += 1
                    elif name not in known_faces_names:
                        current_time = now.strftime("%H-%M-%S")
                        inwriter.writerow([id_counter, "Unknown", "Absent", current_time, "Unknown"])
                        print(f"Recorded: Unknown as Absent at {current_time}")
                        id_counter += 1

        color = (0, 255, 0) if label == "Real" else (0, 0, 255)
        cv2.putText(frame, label, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, color, 2)
        cv2.rectangle(frame, (x, y), (x + w, y + h), color, 2)

    cv2.imshow('Team1_Ahmed_diff_intern-Attendance_System', frame)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

video_capture.release()
cv2.destroyAllWindows()
f.close()
