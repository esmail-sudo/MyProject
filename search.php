<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "student_activity_v2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student = null;
$trainings = [];
$visits = [];
$error = "";

if (isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']);

    // Get student info
    $stmt = $conn->prepare("SELECT * FROM students_info WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();

        // Get trainings
        $stmt_train = $conn->prepare("SELECT * FROM training_info WHERE student_id = ? ORDER BY start_date DESC");
        $stmt_train->bind_param("i", $student_id);
        $stmt_train->execute();
        $trainings = $stmt_train->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt_train->close();

        // Get visits
        $stmt_visit = $conn->prepare("SELECT * FROM visit_info WHERE student_id = ? ORDER BY visit_date DESC");
        $stmt_visit->bind_param("i", $student_id);
        $stmt_visit->execute();
        $visits = $stmt_visit->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt_visit->close();

    } else {
        $error = "No student found with this ID.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Activity Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 20px;
            direction: ltr;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 7px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }
        input[type="number"] {
            padding: 10px;
            width: 60%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .student-info, .activities {
            background: #e9f0ff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            font-size: 16px;
        }
        .student-info strong {
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: left;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px 12px;
        }
        th {
            background: #007bff;
            color: white;
        }
        img.proof {
            max-width: 80px;
            max-height: 60px;
            border-radius: 5px;
        }
        .section-title {
            margin-bottom: 10px;
            color: #003366;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Student Activity</h2>
        <form method="post" action="">
            <label for="student_id">Student ID:</label>
            <input type="number" id="student_id" name="student_id" placeholder="Enter Student ID" required />
            <button type="submit">Search</button>
        </form>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($student): ?>
            <div class="student-info">
                <p><strong>Student ID:</strong> <?= htmlspecialchars($student['student_id']) ?></p>
                <p><strong>Name:</strong> <?= htmlspecialchars($student['name']) ?></p>
                <p><strong>Program:</strong> <?= htmlspecialchars($student['program']) ?></p>
                <p><strong>Level:</strong> <?= htmlspecialchars($student['level']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($student['phone']) ?></p>
                <p><strong>Remaining Training Days:</strong> <?= htmlspecialchars($student['remaining_training_days']) ?></p>
                <p><strong>Remaining Visits:</strong> <?= htmlspecialchars($student['remaining_visits']) ?></p>
            </div>

            <div class="activities">
                <div class="section-title">Trainings</div>
                <?php if (count($trainings) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Training Name</th>
                                <th>Organization</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Proof Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trainings as $training): ?>
                                <tr>
                                    <td><?= htmlspecialchars($training['training_name']) ?></td>
                                    <td><?= htmlspecialchars($training['organization']) ?></td>
                                    <td><?= htmlspecialchars($training['start_date']) ?></td>
                                    <td><?= htmlspecialchars($training['end_date']) ?></td>
                                    <td>
                                        <?php if ($training['proof_image'] && file_exists($training['proof_image'])): ?>
                                            <img src="<?= htmlspecialchars($training['proof_image']) ?>" alt="Proof Image" class="proof" />
                                        <?php else: ?>
                                            No image
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No trainings recorded for this student.</p>
                <?php endif; ?>
            </div>

            <div class="activities">
                <div class="section-title">Visits</div>
                <?php if (count($visits) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Visit Name</th>
                                <th>Location</th>
                                <th>Visit Date</th>
                                <th>Proof Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($visits as $visit): ?>
                                <tr>
                                    <td><?= htmlspecialchars($visit['visit_name']) ?></td>
                                    <td><?= htmlspecialchars($visit['location']) ?></td>
                                    <td><?= htmlspecialchars($visit['visit_date']) ?></td>
                                    <td>
                                        <?php if ($visit['proof_image'] && file_exists($visit['proof_image'])): ?>
                                            <img src="<?= htmlspecialchars($visit['proof_image']) ?>" alt="Proof Image" class="proof" />
                                        <?php else: ?>
                                            No image
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No visits recorded for this student.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
