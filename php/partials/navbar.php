
<header class="main-header">
    <a href="home.php">
        <img src="../media/logo.png" alt="Logo" class="logo-image">
    </a>
    <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "."; ?>

    <nav class="header-nav">
        <!--<form action="" id="searchForm" role="search" class="search">
            <input type="search" id="searchInput" class="search-input" placeholder="Search...">
            <input type="submit" class="submit-search">
        </form>-->
        <a href="funds.php" class="nav-link">Funds</a>
        <a href="trades.php" class="nav-link">Trades</a>
        <a href="orders.php" class="nav-link">Orders</a>
        <a href="logout.php" class="nav-link">Logout</a>
    </nav>
</header>
