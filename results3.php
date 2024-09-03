<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Teacher's Dashboard</h1>
    </header>
    
    <main>
        <h2>Student Results</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Course</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th>Q5</th>
                <th>Q6</th>
                <th>Q7</th>
                <th>Q8</th>
                <th>Q9</th>
                <th>Q10</th>
                <th>Q11</th>
                <th>Q12</th>
                <th>Q13</th>
                <th>Q14</th>
                <th>Q15</th>
                <th>Grade out of 15</th>
                <th>Grade Percentage</th>
            </tr>
            <?php
            // Database connection
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

            $sql = "SELECT * FROM quiz_results";
            $result = $conn->query($sql);

            $correct_answers = array("b", "c", "a", "a", "a", "a", "a", "a", "d", "a", "a", "a", "a", "a", "a");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $student_answers = array(
                        $row["q1"], $row["q2"], $row["q3"], $row["q4"], $row["q5"],
                        $row["q6"], $row["q7"], $row["q8"], $row["q9"], $row["q10"],
                        $row["q11"], $row["q12"], $row["q13"], $row["q14"], $row["q15"]
                    );

                    $correct_count = 0;
                    for ($i = 0; $i < 15; $i++) {
                        if ($student_answers[$i] == $correct_answers[$i]) {
                            $correct_count++;
                        }
                    }

                    $percentage = ($correct_count / 15) * 100;

                    echo "<tr>";
                    echo "<td>" . $row["student_name"] . "</td>";
                    echo "<td>" . $row["course"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["start_time"] . "</td>";
                    echo "<td>" . $row["end_time"] . "</td>";
                    for ($i = 0; $i < 15; $i++) {
                        echo "<td>" . $student_answers[$i] . "</td>";
                    }
                    echo "<td>" . $correct_count . "/15</td>";
                    echo "<td>" . number_format($percentage, 2) . "%</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='23'>No results found.</td></tr>";
            }

            $conn->close();
            ?>
        </table>

        <form action="email_results.php" method="post">
            <h2>Email Results</h2>
            <label for="email">Enter email address:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Send Email</button>
        </form>
    </main>

    <footer>
        <img src="https://via.placeholder.com/100" alt="Logo" style="float: left;">
        <p style="text-align: center;">Copyright (c) 2024 Claudio F. Meis<br>Email: cfpm@live.ca</p>
    </footer>
</body>
</html>
