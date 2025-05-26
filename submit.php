 <?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "student_activity_v2");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استلام البيانات من الفورم
$student_id = intval($_POST['student_id']);
$name = $_POST['name'];
$program = $_POST['program'];
$level = $_POST['level'];
$phone = $_POST['phone'];
$activity_type = $_POST['activity_type'];

// التحقق إذا الطالب موجود
$check_query = $conn->prepare("SELECT * FROM students_info WHERE student_id = ?");
$check_query->bind_param("i", $student_id);
$check_query->execute();
$result = $check_query->get_result();

if ($result->num_rows == 0) {
    // الطالب غير موجود → إدخاله
    $insert_student = $conn->prepare("INSERT INTO students_info (student_id, name, program, level, phone) VALUES (?, ?, ?, ?, ?)");
    $insert_student->bind_param("issss", $student_id, $name, $program, $level, $phone);
    if (!$insert_student->execute()) {
        die("Error inserting student: " . $insert_student->error);
    }
}

// رفع صورة الإثبات
$proof_image_name = $_FILES['proof_image']['name'];
$proof_image_tmp = $_FILES['proof_image']['tmp_name'];
$proof_path = "uploads/" . basename($proof_image_name);

if (!move_uploaded_file($proof_image_tmp, $proof_path)) {
    die("Failed to upload proof image.");
}

// تنفيذ الإدخال حسب نوع النشاط
if ($activity_type === 'Training') {
    $training_name = $_POST['training_name'];
    $organization = $_POST['organization'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $insert_training = $conn->prepare("INSERT INTO training_info (student_id, training_name, organization, start_date, end_date, proof_image) VALUES (?, ?, ?, ?, ?, ?)");
    $insert_training->bind_param("isssss", $student_id, $training_name, $organization, $start_date, $end_date, $proof_path);
    if ($insert_training->execute()) {
        // حساب عدد الأيام بين البداية والنهاية
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $interval = $start->diff($end);
        $days = $interval->days + 1; // +1 لحساب اليومين كاملين

        // تحديث الأيام المتبقية
        $update_days = $conn->prepare("UPDATE students_info SET remaining_training_days = GREATEST(remaining_training_days - ?, 0) WHERE student_id = ?");
        $update_days->bind_param("ii", $days, $student_id);
        $update_days->execute();

        echo "Training activity submitted successfully.";
    } else {
        echo "Error: " . $insert_training->error;
    }

} elseif ($activity_type === 'Visit') {
    $visit_name = $_POST['visit_name'];
    $location = $_POST['location'];
    $visit_date = $_POST['visit_date'];

    $insert_visit = $conn->prepare("INSERT INTO visit_info (student_id, visit_name, location, visit_date, proof_image) VALUES (?, ?, ?, ?, ?)");
    $insert_visit->bind_param("issss", $student_id, $visit_name, $location, $visit_date, $proof_path);
    if ($insert_visit->execute()) {
        // تحديث عدد الزيارات المتبقية بنقصان 1
        $update_visits = $conn->prepare("UPDATE students_info SET remaining_visits = GREATEST(remaining_visits - 1, 0) WHERE student_id = ?");
        $update_visits->bind_param("i", $student_id);
        $update_visits->execute();

        echo "Visit activity submitted successfully.";
    } else {
        echo "Error: " . $insert_visit->error;
    }
} else {
    echo "Invalid activity type selected.";
}

$conn->close();
?>
























































