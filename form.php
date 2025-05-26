 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Activity Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="mb-4 text-center">Student Activity Form</h2>
            <form action="submit.php" method="POST" enctype="multipart/form-data" id="activityForm">

                <div class="mb-3">
                    <label class="form-label">Student ID</label>
                    <input type="text" name="student_id" class="form-control" placeholder="Enter student ID" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter full name" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Program</label>
                    <input type="text" name="program" class="form-control" placeholder="Enter program" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <input type="text" name="level" class="form-control" placeholder="Enter level" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter phone number" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Activity Type</label>
                    <select name="activity_type" id="activity_type" class="form-select" onchange="toggleFields()" required>
                        <option value="">-- Select --</option>
                        <option value="Training">Training</option>
                        <option value="Visit">Visit</option>
                    </select>
                </div>

                <!-- Training Fields -->
                <div id="training_fields" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Training Name</label>
                        <input type="text" name="training_name" id="training_name" class="form-control" placeholder="Enter training name" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Organization</label>
                        <input type="text" name="organization" id="organization" class="form-control" placeholder="Enter organization" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" />
                    </div>
                </div>

                <!-- Visit Fields -->
                <div id="visit_fields" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Visit Name</label>
                        <input type="text" name="visit_name" id="visit_name" class="form-control" placeholder="Enter visit name" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Enter location" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Visit Date</label>
                        <input type="date" name="visit_date" id="visit_date" class="form-control" />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Proof Image</label>
                    <input type="file" name="proof_image" class="form-control" required />
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function toggleFields() {
            const activity = document.getElementById("activity_type").value;

            const trainingFields = document.getElementById("training_fields");
            const visitFields = document.getElementById("visit_fields");

            // Toggle visibility
            trainingFields.style.display = activity === "Training" ? "block" : "none";
            visitFields.style.display = activity === "Visit" ? "block" : "none";

            // Manage required attribute dynamically
            document.getElementById("training_name").required = activity === "Training";
            document.getElementById("organization").required = activity === "Training";
            document.getElementById("start_date").required = activity === "Training";
            document.getElementById("end_date").required = activity === "Training";

            document.getElementById("visit_name").required = activity === "Visit";
            document.getElementById("location").required = activity === "Visit";
            document.getElementById("visit_date").required = activity === "Visit";
        }

        // Initialize on page load in case of reload
        window.onload = function() {
            toggleFields();
        };
    </script>
</body>
</html>
