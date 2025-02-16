<?php
// discord_login.php

// Redirect user to Discord's OAuth page
header('Location: https://discord.com/oauth2/authorize?client_id=1340701003523297320&response_type=code&redirect_uri=https%3A%2F%2Fdoyalikess.github.io%2FSatchelSpin2%2Fdiscord_callback.php&scope=openid+identify');
exit;
?>
