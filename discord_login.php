<?php
// discord_login.php

// Step 1: If the user is redirected from Discord with a 'code' parameter
if (isset($_GET['code'])) {
    // Your Discord application credentials
    $client_id = '1340701003523297320';
    $client_secret = 'E7ToLGdy63sNDD1HBFMHdDsKvABbXO5D';
    $redirect_uri = 'https://doyalikess.github.io/SatchelSpin2/index.html'; // Make sure this matches your Discord redirect URI
    $scope = 'openid identify';

    // Step 2: Exchange the authorization code for an access token
    $url = 'https://discord.com/api/oauth2/token';
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'grant_type' => 'authorization_code',
        'redirect_uri' => $redirect_uri,
        'scope' => $scope
    ];

    // Send POST request to Discord to get the access token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the response to get the access token
    $json = json_decode($response, true);
    $access_token = $json['access_token'];

    // Step 3: Use the access token to get user data
    $user_url = 'https://discord.com/api/v10/users/@me';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $user_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $access_token]);
    $user_response = curl_exec($ch);
    curl_close($ch);

    // Decode the user response to get user data
    $user_data = json_decode($user_response, true);
    $discord_id = $user_data['id'];
    $discord_username = $user_data['username'];

    // Start a session and save user data
    session_start();
    $_SESSION['discord_id'] = $discord_id;
    $_SESSION['discord_username'] = $discord_username;

    // Set a fake balance for the user in their session
    $_SESSION['balance'] = 1000; // Example balance

    // Redirect to the home page or a profile page
    header('Location: index.php'); // Change to index.php instead of HTML for PHP functionality
    exit;
} else {
    // If no 'code' is received, just redirect to the login page
    header('Location: https://discord.com/oauth2/authorize?client_id=1340701003523297320&response_type=code&redirect_uri=https%3A%2F%2Fdoyalikess.github.io%2FSatchelSpin2%2Findex.html&scope=openid+identify');
    exit;
}
?>
