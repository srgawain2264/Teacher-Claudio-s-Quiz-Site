<?php
// submit_quiz.php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching form data
$student_name = $_POST['student_name'];
$student_email = $_POST['student_email'];
$course = $_POST['course'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

// Collecting answers
$answers = [];
for ($i = 1; $i <= 15; $i++) {
    $answers["q$i"] = isset($_POST["q$i"]) ? $_POST["q$i"] : '';
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO quiz_results (student_name, student_email, course, date, start_time, end_time, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssssssssssss", $student_name, $student_email, $course, $date, $start_time, $end_time, $answers['q1'], $answers['q2'], $answers['q3'], $answers['q4'], $answers['q5'], $answers['q6'], $answers['q7'], $answers['q8'], $answers['q9'], $answers['q10'], $answers['q11'], $answers['q12'], $answers['q13'], $answers['q14'], $answers['q15']);

// Execute and check for errors
if ($stmt->execute()) {
    echo "Quiz submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Closing the statement and connection
$stmt->close();
$conn->close();

// Adding a 5-second delay and redirect
//echo '<script>
//        setTimeout(function(){
//            window.location.href = "results3.php";
//        }, 5000);
//      </script>';
?>

