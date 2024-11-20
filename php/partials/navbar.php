<header class="main-header">
        <a href="home.php">
                <img src="../media/logo.png" alt="Logo" class="logo-home">
        </a>
        <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "."; ?>
        <!-- <h1 class="page-title">IT-490-Project</h1> -->
        <nav class="header-nav">
                <a href="recommendations.php" class="placeholder-link">Recommendations</a>
                <a href="trades.php" class="placeholder-link">Trades</a>
                <a href="orders.php" class="placeholder-link">Orders</a>
                <a href="logout.php" class="placeholder-link">Logout</a>
        </nav>
</header>