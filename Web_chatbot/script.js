// دالة لجلب الجداول من PHP عبر AJAX
async function loadSchedules(day, role, classId = null, subject = null) {
    const data = {
        day: day,
        role: role,
        class_id: classId,
        subject: subject
    };

    try {
        const response = await fetch('getSchedules.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(data) // تحويل البيانات إلى تنسيق URL
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const schedules = await response.json();
        displaySchedules(schedules, role);
    } catch (error) {
        console.error('Error loading schedules:', error);
    }
}

// دالة لعرض الجداول المستلمة في الصفحة
function displaySchedules(scheduleData, role) {
    let tableHtml = '<table><tr><th>Period</th><th>Time</th>';
    
    if (role === 'teacher') {
        tableHtml += '<th>Class</th>'; // للمدرسين، نعرض الحقل الإضافي "الفصل"
    }
    
    tableHtml += '</tr>';

    if (scheduleData.length > 0) {
        scheduleData.forEach(item => {
            tableHtml += `<tr><td>${item.period}</td><td>${item.time}</td>`;
            if (role === 'teacher') {
                tableHtml += `<td>${item.class_id}</td>`;
            }
            tableHtml += '</tr>';
        });
    } else {
        tableHtml += '<tr><td colspan="3">No schedule available</td></tr>';
    }

    tableHtml += '</table>';
    document.getElementById('schedule-container').innerHTML = tableHtml;
}

// حدث تغيير الدور (طالب أو مدرس)
document.getElementById('role-select').addEventListener('change', function () {
    const selectedRole = this.value;

    if (selectedRole === 'student') {
        document.getElementById('class-container').style.display = 'block';
        document.getElementById('subject-container').style.display = 'none';
    } else if (selectedRole === 'teacher') {
        document.getElementById('class-container').style.display = 'none';
        document.getElementById('subject-container').style.display = 'block';
    }

    document.getElementById('schedule-container').innerHTML = ''; // مسح الجدول الحالي
});

// حدث تغيير اليوم
document.getElementById('day-select').addEventListener('change', function () {
    const selectedDay = this.value;
    const selectedRole = document.getElementById('role-select').value;

    if (selectedRole === 'student') {
        const selectedClass = document.getElementById('class-select').value;
        loadSchedules(selectedDay, selectedRole, selectedClass);
    } else if (selectedRole === 'teacher') {
        const selectedSubject = document.getElementById('subject-select').value;
        loadSchedules(selectedDay, selectedRole, null, selectedSubject);
    }
});

// حدث تغيير الفصل (للطالب)
document.getElementById('class-select').addEventListener('change', function () {
    const selectedClass = this.value;
    const selectedDay = document.getElementById('day-select').value;
    const selectedRole = document.getElementById('role-select').value;

    loadSchedules(selectedDay, selectedRole, selectedClass);
});

// حدث تغيير المادة (للمدرس)
document.getElementById('subject-select').addEventListener('change', function () {
    const selectedSubject = this.value;
    const selectedDay = document.getElementById('day-select').value;
    const selectedRole = document.getElementById('role-select').value;

    loadSchedules(selectedDay, selectedRole, null, selectedSubject);
});
