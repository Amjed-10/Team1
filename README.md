# Automated Attendance System

## Project Overview
This project aims to create a *complete school management system* that covers three main components:

### 1. Attendance and Access Control at the School Gate
Using AI and embedded systems, the system identifies attendance at the school gate. Recognized individuals are automatically logged, and the gate opens for them. If an unrecognized person is detected, a notification is sent to supervisors like Mr. Mohamed Adly or Mr. Ahmed Fouad to decide whether to allow entry.

*Enhanced Details:*
Once the attendance is taken, the data is automatically stored in an Excel sheet that organizes students based on their grade level (Junior, Wheeler, or Senior). This file is securely uploaded to a school portal accessible only to authorized personnel like the principal, vice principal, or specific staff members. The system provides the capability to search and filter records by date and class. This allows for tracking student attendance accurately and efficiently. Authorized users can review the attendance data, helping maintain school records and making informed decisions.

![2024-10-12online-video-cutter com-ezgif com-video-to-gif-converter (1)](https://github.com/user-attachments/assets/ce2ebda6-12ad-459e-ac7b-0ad4e83b8aec)

### 2. Student Assistance System
This system assists not only enrolled students but also prospective ones. For new applicants, the chatbot provides information about the school’s admission process, required documents, registration steps, and deadlines. It also offers guidance on subjects, school culture, projects, competitions, and extracurricular activities.

The chatbot, powered by GPT-4, is trained with questions and answers in Modern Standard Arabic, Egyptian Arabic, and English. It was fine-tuned through effective *prompt engineering*, tailoring the system to provide accurate responses to school-related queries. The chatbot can assist users in multiple languages depending on their preference, improving the user experience for students and applicants alike.


### 3. Substitute Class Management System
Mr. Ahmed Fouad, the scheduling expert, uses this system to manage substitute classes. Teachers are notified of substitute classes and reminded of their sessions to prevent delays. Additionally, the system automatically rings the school bell for each class and break, reducing the need for manual intervention.

---

## Sprint Breakdown

### Sprint 1: Camera System (2 Weeks)
*Goal:* Develop a camera-based attendance and access control system using AI and Raspberry Pi.

#### Tasks:
1. Choose the AI Module (1 day)
2. Collect Data (5 days)
3. Create the AI Module (3 days)
4. Develop the Embedded System and Integrate with Raspberry Pi (3 days)
5. Design UI/UX (2 days)

📅 Deployment: End of Sprint 1

*System Explanation:*
The AI module used for face recognition can be developed using frameworks like *TensorFlow* or *OpenCV*. The camera, connected to a Raspberry Pi, captures images, and the AI model processes them to recognize registered individuals. Once recognized, their attendance is logged into an Excel sheet, organized by grade level. This file is then securely uploaded to a dedicated website accessible only by authorized personnel such as the principal or vice principal. This ensures secure access to attendance records for specific users.

### Sprint 2: Chatbot System (13 Days)
*Goal:* Develop an AI-powered chatbot to assist students with their questions.

#### Tasks:
1. Choose the AI Module (2 days)
2. Collect Questions & Answers Data (3 days)
3. Develop the Chatbot Module (7 days)
4. Test the Chatbot (1 day)

📅 Deployment: End of Sprint 2

*System Explanation:*
The chatbot is developed using *GPT-4* and trained with a dataset of common school-related questions and answers in different languages (Arabic and English). Prompt engineering is used to guide the chatbot’s responses to focus on school-specific queries, ensuring relevance and accuracy. The chatbot is hosted on a cloud platform, such as *AWS* or *Heroku*, and integrated into the school's website or mobile app. The backend is linked to a school database, allowing it to provide personalized responses based on user information (e.g., grade level or status as an applicant or enrolled student).

### Sprint 3: Web-Based Substitute Class Management (15 Days)
*Goal:* Develop a system to manage substitute classes, notify teachers, and automate the school bell ringing.

#### Tasks:
1. Develop Reminder System Using Python Libraries (Time and SMS) (3 days)
2. Design and Develop Web Interface for Class Distribution (10 days)
3. Implement Alarm System for Class and Break Times (2 days)

📅 Deployment: End of Sprint 3

*System Explanation:*
The substitute class management system is built as a *web application* using Python-based frameworks like *Flask* or *Django. The interface allows Mr. Ahmed Fouad to assign substitute teachers and notify them via SMS, using **Twilio* or similar services. The web application includes a timetable for class distribution, allowing teachers to view their schedules in real-time. An alarm system is integrated into the application, controlling the school bell’s ringing times through a connected hardware system.

---

## Contributors
- Mohamed Adly (Supervisor)
- Ahmed Fouad (Scheduler)
- Mohand Sayed (Contributor)
- Abdallah Essam (Contributor)
- Ziad Aymen (Contributor)
- Amgad Khaled (Contributor)
- Shaza Mohamed (Contributor) 

---

This README now includes the *enhanced attendance process* (using Excel and secure portal integration) and the *details of the chatbot system* (with multilingual support and prompt engineering).

---
