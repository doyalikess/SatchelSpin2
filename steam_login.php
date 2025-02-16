<?php
// discord_login.php

if (isset($_GET['code'])) {
    $client_id = '1340701003523297320';
    $client_secret = 'E7ToLGdy63sNDD1HBFMHdDsKvABbXO5D';
    $redirect_uri = 'https://doyalikess.github.io/SatchelSpin2/index.html';
    $scope = 'openid identify';

    // Exchange authorization code for access token
    $url = 'https://discord.com/api/oauth2/token';
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'grant_type' => 'authorization_code',
        'redirect_uri' => $redirect_uri,
        'scope' => $scope
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);
    $access_token = $json['access_token'];

    // Fetch user data
    $user_url = 'https://discord.com/api/v10/users/@me';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $user_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $access_token]);
    $user_response = curl_exec($ch);
    curl_close($ch);

    $user_data = json_decode($user_response, true);
    $discord_id = $user_data['id'];
    $discord_username = $user_data['username'];

    session_start();
    $_SESSION['discord_id'] = $discord_id;
    $_SESSION['discord_username'] = $discord_username;
    $_SESSION['balance'] = 1000; // Set balance

    // Redirect to the homepage
    header('Location: index.html');
    exit;
} else {
    header('Location: https://discord.com/oauth2/authorize?client_id=1340701003523297320&response_type=code&redirect_uri=https%3A%2F%2Fdoyalikess.github.io%2FSatchelSpin2%2Findex.html&scope=openid+identify');
    exit;
}
?>
