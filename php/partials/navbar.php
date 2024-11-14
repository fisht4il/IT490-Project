<header class="main-header">
        <a href="home.php">
        <img src="../finnhub-logo.png" alt="Logo" class="logo-home">
        <h1 class="page-title">IT-490-Project</h1>

        <nav class="header-nav">
            <ul class="link-list">
                <li class="link-item">
                    <button class="btn">
                        <a href="portfolio.php" class="placeholder-link">Portfolio</a>
                    </button>
                </li>
                <li class="link-item">
                    <button class="btn">
                        <a href="trades.php" class="placeholder-link">Trades</a>
                    </button>
                </li>
                <li class="link-item">
                    <button class="btn">
                        <a href="orders.php" class="placeholder-link">Orders</a>
                    </button>
                </li>
                <li class="link-item">
                    <div>
                        <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "."; ?>
                    </div>
                    <button class="input-submit">
                        <a href="logout.php" class="placeholder-link">Logout</a>
                    </button>
                </li>
            </ul>
        </nav>
</header>