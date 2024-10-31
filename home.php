<?php

session_start();

if(!isset($_SESSION['username'])) {
        header("Location: ../index.html");
        exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home page</title>
</head>

    <body class="body-home">
        <header class="main-header">
            <img src="kraken-svgrepo-com.png" alt="" class="logo-home">
            <h1 class="page-title">IT-490-Project</h1>
            <nav class="header-nav">
                <ul class="link-list">
                    <li class="link-item">
                        <button class="btn">
                            <a href="#" class="placeholder-link">Link1</a>
                        </button>
                    </li>
                    <li class="link-item">
                        <button class="btn">
                            <a href="#" class="placeholder-link">Link2</a>
                        </button>
                    </li>
                     <li class="link-item">
                        <?php
                        echo "Welcome, " . htmlspecialchars($_SESSION['username']) . ".";
                        ?>
                        <button class="input-submit">
                            <a href="logout.php" class="placeholder-link">Logout</a>
                        </button>
                    </li>
                </ul>
            </nav>
        </header>
        <section class="section-text">
                <h2 class="home-title">KRAKEN</h2>
                <p class="place-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi cupiditate magnam vero dignissimos dolorum inventore ratione ipsum quisquam porro odit non neque, rem doloremque molestiae quaerat explicabo at aspernatur hic.
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, aliquid! Porro explicabo dignissimos officia officiis, dolorum harum ipsa tenetur accusantium, nihil fuga deserunt ut, consectetur fugiat ipsam nobis rem vel.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis accusamus aliquid tempore sit, molestias aspernatur modi rerum vel non amet dolor nam repellat dignissimos veniam quasi itaque mollitia quibusdam eos.
                </p>
        </section>

        <footer class="footer">
            <p class="copyright">&copy; 2024. Copyright by IT-490-Project</p>
        </footer>
    </body>

</html>
