<?php
// Start the session to access the user data
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CSGOLuck | Best csgo casino</title>
    <link rel="icon" href="./dist/img/other/icon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link href="./dist/css/hamburgers/hamburgers.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./dist/css/style.min.css" />
    <script
      src="https://kit.fontawesome.com/bdb2f8ae99.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <nav class="nav above" data-aos="fade-in" data-aos-duration="500" data-aos-once="true">
      <ul class="nav__list">
        <li class="nav__list-item">
          <a
            class="nav__list-item-link nav__list-item-link--logo nav__list-item-link--color above"
            href="index.php"
          >
            <img
              class="nav__list-item-link-logo"
              src="./dist/img/other/icon.png"
              alt="csgoluck Logo"
            />
            <p class="nav__list-item-link-text">
              <span class="nav__list-item-link-text-green">CSGO</span>Luck
            </p>
          </a>
        </li>
        <li class="nav__list-item small">
          <a class="nav__list-item-link nav__list-item-link--underline nav__list-item-link--color" href="cases.html">Cases</a>
        </li>
        <!-- Add other menu items here -->
      </ul>
      <ul class="nav__list">
        <li class="nav__list-item small">
          <p class="nav__list-item-balance">
            <img
              class="nav__list-item-balance-icon"
              src="./dist/img/other/coin.png"
              alt="Coin Icon"
            />
            <span class="nav__list-item-balance-amount">
              <?php
                if (isset($_SESSION['discord_id'])) {
                    echo $_SESSION['balance']; // Display user balance
                } else {
                    echo '100.00'; // Default balance if not logged in
                }
              ?>
            </span>
          </p>
        </li>

        <!-- Login or show user info -->
        <?php if (!isset($_SESSION['discord_id'])): ?>
          <li class="nav__list-item small">
            <a class="nav__list-item-link nav__list-item-link--deposit" href="https://discord.com/oauth2/authorize?client_id=1340701003523297320&response_type=code&redirect_uri=https%3A%2F%2Fdoyalikess.github.io%2FSatchelSpin2%2Findex.html&scope=openid+identify">
              <button class="discord-login-btn">Login with Discord</button>
            </a>
          </li>
        <?php else: ?>
          <li class="nav__list-item small">
            <p class="nav__list-item-text">Logged in as <?php echo $_SESSION['discord_username']; ?> (ID: <?php echo $_SESSION['discord_id']; ?>)</p>
          </li>
        <?php endif; ?>
      </ul>
    </nav>

    <main class="main-index" data-aos="fade-in" data-aos-duration="500" data-aos-once="true">
      <ul class="main-index__list">
        <!-- Your content goes here -->
      </ul>
    </main>

    <script src="./dist/js/setbalance.min.js"></script>
    <script src="./dist/js/footeryear.min.js"></script>
    <script src="./dist/js/nav.min.js"></script>
    <script src="./dist/js/lastdrops.min.js"></script>
    <script src="./dist/js/chat.min.js"></script>
    <script src="./dist/js/sendmsg.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
