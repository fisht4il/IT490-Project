<?php



session_start();

/* This code will stop  people from getting into home without a session.
if(!isset($_SESSION['username'])) {
        header("Location: ../index.html");
        exit();
}

 */
?>

<html>

<head>

</head>

<body>

        <header class="main-header">
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
                        <button class="logout">
                            <a href="logout.php" class="placeholder-link">Logout</a>
                        </button>
                    </li>
                </ul>
            </nav>
        </header>
        <section class="about-service">
                <p class="p-about-service">
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
