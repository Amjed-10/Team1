import cv2
import os
import numpy as np
import face_recognition
import csv
from datetime import datetime
from tensorflow.keras.models import model_from_json
from tensorflow.keras.utils import get_custom_objects
import tensorflow as tf
from flask import Flask, render_template, Response, request
import pandas as pd

# تسجيل Functional ككائن مخصص
get_custom_objects().update({'Functional': tf.keras.Model})

# تحميل النموذج المضاد للتزييف
face_cascade = cv2.CascadeClassifier(r"static\model\Team1_Face_recognition_model_classes.xml")

# تحميل النموذج من ملف JSON
json_file = open(r'static\model\modified_model.json', 'r')
loaded_model_json = json_file.read()
json_file.close()
model = model_from_json(loaded_model_json)
model.load_weights(r'static\model\Team1_Face_recognition_model.h5')
print("Antispoofing Model loaded from disk")

# تعريف قائمة الوجوه المعروفة
known_faces = {
    "Ziad Mahmoud S1": r"static\Photo\(4).jpg",
    "AbdElrahman Ahmed S4": r"static\Photo\(2).jpg",
    "Abdullah Mohammed S2": r"static\Photo\(3).jpg",
    "Ziad Muhammad S3": r"static\Photo\(5).jpg",
    "Mohamed Khaled S4": r"static\Photo\(6).jpg",
    "Ahmed Siraj S4": r"static\Photo\(8).jpg",
    "mohaned sayed S2": r"static\Photo\(9).jpg",
    "Amjed Khaled S1": r"static\Photo\(10).jpg",
    "Zyad ayman S3": r"static\Photo\(1).jpg"
}

# إعدادات الترميز للوجوه المعروفة
known_face_encodings = []
known_faces_names = list(known_faces.keys())

for name, image_path in known_faces.items():
    image = face_recognition.load_image_file(image_path)
    image_rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    encoding = face_recognition.face_encodings(image_rgb)[0]
    known_face_encodings.append(encoding)

# إعداد Flask
app = Flask(__name__)

# إعدادات CSV الخاصة بالحضور
now = datetime.now()
current_date = now.strftime("%Y-%m-%d")
data_dir = 'data'  # التأكد من أن الملفات ستكون في مجلد data

# التأكد من أن مجلد data موجود
if not os.path.exists(data_dir):
    os.makedirs(data_dir)

csv_filename = f"attendance_{current_date}.csv"
csv_filepath = os.path.join(data_dir, csv_filename)

# التأكد من أن ملف CSV موجود، وإذا لم يكن موجودًا، يتم إنشاؤه
if not os.path.exists(csv_filepath):
    with open(csv_filepath, 'w+', newline="") as f:
        inwriter = csv.writer(f)
        inwriter.writerow(["student_id", "student_name", "status", "date", "time", "class_id"])

# قائمة لتسجيل أسماء الطلاب الذين تم التعرف عليهم بالفعل
recorded_students = []

# تشغيل كاميرا الفيديو
video_capture = cv2.VideoCapture(0)

# دالة للتحقق مما إذا كان الطالب قد تم تسجيله بالفعل
def is_student_recorded(name):
    try:
        if os.path.exists(csv_filepath):
            df = pd.read_csv(csv_filepath)
            # تحقق مما إذا كان الطالب مسجلاً في هذا اليوم
            if not df[df['student_name'] == name].empty:
                return True
        return False
    except Exception as e:
        print(f"Error checking student record: {e}")
        return False

def gen_frames():
    global recorded_students
    id_counter = 1

    while True:
        success, frame = video_capture.read()
        if not success:
            break

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

                face_locations = face_recognition.face_locations(rgb_small_frame)
                face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)

                for face_encoding in face_encodings:
                    matches = face_recognition.compare_faces(known_face_encodings, face_encoding)
                    name = ""

                    face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
                    best_match_index = np.argmin(face_distances)

                    if matches[best_match_index]:
                        name = known_faces_names[best_match_index]

                    person_class = name.split()[-1] if name else "Unknown"

                    # التأكد من عدم تسجيل نفس الطالب مرة أخرى في هذا اليوم
                    if name in known_faces_names and not is_student_recorded(name):
                        recorded_students.append(name)  # إضافة الطالب إلى القائمة المسجلة
                        current_time = datetime.now().strftime("%H:%M:%S")
                        with open(csv_filepath, 'a', newline="") as f:
                            inwriter = csv.writer(f)
                            inwriter.writerow([id_counter, name, "Present", current_date, current_time, person_class])
                        print(f"Recorded: {name} at {current_time}")
                        id_counter += 1

            color = (0, 255, 0) if label == "Real" else (0, 0, 255)
            cv2.putText(frame, label, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, color, 2)
            cv2.rectangle(frame, (x, y), (x + w, y + h), color, 2)

        ret, buffer = cv2.imencode('.jpg', frame)
        frame = buffer.tobytes()
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')


@app.route('/')
def index():
    # صفحة HTML الرئيسية لعرض الفيديو
    return render_template('attendance_model.html')


@app.route('/video_feed')
def video_feed():
    # بث الفيديو في صفحة الويب
    return Response(gen_frames(), mimetype='multipart/x-mixed-replace; boundary=frame')


# صفحة البحث عن السجلات
@app.route('/attendance_search')
def attendance_search():
    return render_template('attendance_search.html')

# عرض السجلات بناءً على التاريخ والفصل
@app.route('/attendance_records', methods=['GET', 'POST'])
def attendance_records():
    if request.method == 'POST':
        date = request.form.get('date')
        class_id = request.form.get('class_id')
    else:
        date = request.args.get('date', current_date)
        class_id = request.args.get('class_id', None)

    if not date or not class_id:
        return "تأكد من إدخال التاريخ والفصل", 400

    filename = f'attendance_{date}.csv'
    filepath = os.path.join(data_dir, filename)

    records = []

    try:
        if os.path.exists(filepath):
            # قراءة ملف CSV
            df = pd.read_csv(filepath)

            # تصفية السجلات بناءً على الفصل الدراسي
            filtered_df = df[df['class_id'] == class_id]

            if not filtered_df.empty:
                records = filtered_df.to_dict(orient='records')
            else:
                print(f"No records found for class {class_id} on {date}.")
        else:
            print(f"File {filename} not found.")
    except Exception as e:
        print(f"Error reading the file: {e}")

    return render_template('attendance_records.html', records=records, date=date, class_id=class_id)


if __name__ == '__main__':
    app.run(debug=True)
