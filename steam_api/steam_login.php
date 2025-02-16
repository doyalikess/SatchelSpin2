<?php
// Include the Steam login PHP code
require_once 'steam_api/steamlogin.php';  // Adjust the path to where you saved the steamlogin.php file

$steam = new SteamLogin();

// If the user is logged in with Steam
if ($steam->is_logged_in()) {
    // Get the Steam ID and Steam Name
    $steam_id = $steam->get_steamid();
    $steam_name = $steam->get_steamname();

    // Start the session to store Steam user data
    session_start();

    // Store Steam user data in the session
    $_SESSION['steam_id'] = $steam_id;
    $_SESSION['steam_name'] = $steam_name;

    // Connect to your database (adjust with your credentials)
    $db = new mysqli('localhost', 'username', 'password', 'your_database');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Check if the user already exists in the database
    $stmt = $db->prepare("SELECT * FROM users WHERE steam_id = ?");
    $stmt->bind_param('s', $steam_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User already exists, log them in
        $user = $result->fetch_assoc();
        $_SESSION['balance'] = $user['balance'];  // Store user balance in session
    } else {
        // New user, create a new record in the database
        $stmt = $db->prepare("INSERT INTO users (steam_id, steam_name, balance) VALUES (?, ?, ?)");
        $balance = 1000;  // Set a default balance (fake balance for gambling site)
        $stmt->bind_param('ssi', $steam_id, $steam_name, $balance);
        $stmt->execute();

        // Get the new user's data
        $_SESSION['balance'] = $balance;
    }

    // Redirect to the dashboard or wherever you want the user to go
    header('Location: dashboard.php');
    exit;
} else {
    // If Steam login fails, redirect back to the login page
    header('Location: index.php');  // Or wherever you want to go if login fails
    exit;
}
?>
