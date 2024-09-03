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

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>Name</th>
                    <th>Email</th>
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
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["student_name"] . "</td>
                        <td>" . $row["student_email"] . "</td>
                        <td>" . $row["course"] . "</td>
                        <td>" . $row["date"] . "</td>
                        <td>" . $row["start_time"] . "</td>
                        <td>" . $row["end_time"] . "</td>
                        <td>" . $row["q1"] . "</td>
                        <td>" . $row["q2"] . "</td>
                        <td>" . $row["q3"] . "</td>
                        <td>" . $row["q4"] . "</td>
                        <td>" . $row["q5"] . "</td>
                        <td>" . $row["q6"] . "</td>
                        <td>" . $row["q7"] . "</td>
                        <td>" . $row["q8"] . "</td>
                        <td>" . $row["q9"] . "</td>
                        <td>" . $row["q10"] . "</td>
                        <td>" . $row["q11"] . "</td>
                        <td>" . $row["q12"] . "</td>
                        <td>" . $row["q13"] . "</td>
                        <td>" . $row["q14"] . "</td>
                        <td>" . $row["q15"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }

        $conn->close();
        ?>

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
