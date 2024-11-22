<header class="main-header">
        <a href="home.php">
            <img src="../media/logo.png" alt="Logo" class="nav-logo">
        </a>
        <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "."; ?>
        <!-- <h1 class="nav-title">IT-490-Project</h1> -->
        <nav class="header-nav">
            <a href="trades.php" class="nav-link">Trades</a>
            <a href="orders.php" class="nav-link">Orders</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </nav>
</header>
