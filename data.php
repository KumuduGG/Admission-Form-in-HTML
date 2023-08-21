<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["fname"];
    $last_name = $_POST["lname"];
    $gender = $_POST["gender"];
    $date_of_birth = $_POST["dob"];
    $subject = $_POST["subject"];
    $class = $_POST["class"];
    $address = $_POST["address"];
    $telnumber = $_POST["tel"];
    $email = $_POST["email"];

    $user = "root";
    $key = "20503";
    $db = "school";
    $host = "127.0.0.1";
    $port = "3306";

    $conn = mysqli_connect($host, $user, $key, $db, $port);

    if ($conn->connect_error) {
        die("Connection Error: " . $conn->connect_error);
    } else {
        echo "Connection Successfully";
    }

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO Student (fname, lname, gender, dob, subject, class, address, tel, email) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === FALSE) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssssss", $first_name, $last_name, $gender, $date_of_birth, $subject, $class, $address, $telnumber, $email);

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
