<?php
require_once 'steam_api/steamlogin.php';  // Include the Steam login API

$steam = new SteamLogin();

if ($steam->is_logged_in()) {
    $steam_id = $steam->get_steamid();
    $steam_name = $steam->get_steamname();

    session_start();
    $_SESSION['steam_id'] = $steam_id;
    $_SESSION['steam_name'] = $steam_name;

    // You can store the balance in the session, or fetch from the database
    $_SESSION['balance'] = 1000;  // Example fake balance

    header('Location: dashboard.php');  // Redirect to a dashboard or other page after login
    exit;
} else {
    header('Location: index.php');  // Redirect back to the index if login fails
    exit;
}
?>
