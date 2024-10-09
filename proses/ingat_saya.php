<?php
// Include the config file                                                                                                                                                   
include 'config.php';
// Check if the form is submitted  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Get the username and password from the form

    $rememberMe = isset($_POST['remember_me']);

    // Prepare the SQL statement                                                                                                                                             
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password                                                                                                                                               
        if (password_verify($password, $row['password'])) {
            // Set the session variables
            $_SESSION['username'] = $username;

            // Set the cookie if "Remember Me" is checked                                                                                                                    
            if ($rememberMe) {
                setcookie("username", $username, time() + (86400 * 30), "/"); // Cookie expires in 30 days
            }

            // Redirect to the index page
            $_COOKIE['username'] = $username ;
            header("Location: ../pages/login.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>