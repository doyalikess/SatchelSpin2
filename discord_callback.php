<?php
// discord_callback.php

session_start();  // Start the session

// Step 1: Check if 'code' is passed from Discord
if (isset($_GET['code'])) {
    // Your Discord app credentials
    $client_id = '1340701003523297320';
    $client_secret = 'E7ToLGdy63sNDD1HBFMHdDsKvABbXO5D';
    $redirect_uri = 'https://doyalikess.github.io/SatchelSpin2/discord_callback.php';
    $scope = 'openid identify';

    // Step 2: Get the access token by sending POST request
    $url = 'https://discord.com/api/oauth2/token';
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'grant_type' => 'authorization_code',
        'redirect_uri' => $redirect_uri,
        'scope' => $scope
    ];

    // Request to get the access token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode response to get access token
    $json = json_decode($response, true);
    $access_token = $json['access_token'];

    // Step 3: Get user data using the access token
    $user_url = 'https://discord.com/api/v10/users/@me';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $user_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $access_token]);
    $user_response = curl_exec($ch);
    curl_close($ch);

    // Decode the user data
    $user_data = json_decode($user_response, true);
    $_SESSION['discord_id'] = $user_data['id'];
    $_SESSION['discord_username'] = $user_data['username'];

    // Set a default balance
    $_SESSION['balance'] = 1000;

    // Redirect to the main page (index.html)
    header('Location: index.html');
    exit;
} else {
    // If no code, redirect to login page
    header('Location: discord_login.php');
    exit;
}
?>
