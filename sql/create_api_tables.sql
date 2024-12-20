-- referenced source for structure primary key structure: 
-- https://medium.com/@herefindalex/designing-an-efficient-stock-price-database-from-basic-structure-to-optimization-strategies-44ba2c01fae9#:~:text=Use%20symbol%20as%20the%20primary,and%20test%20symbols%20like%20BLIST.

-- this one is for overall history
CREATE TABLE stock_prices (
    symbol VARCHAR(10) NOT NULL,
    date DATE NOT NULL,
    open DECIMAL(10, 4) NOT NULL,
    high DECIMAL(10, 4) NOT NULL,
    low DECIMAL(10, 4) NOT NULL,
    close DECIMAL(10, 4) NOT NULL,
    volume INT NOT NULL,
    PRIMARY KEY (symbol, date),
    INDEX idx_symbol (symbol)
);

--
-- this one is for single most recent price of a stock

CREATE TABLE stock_quotes (
    symbol VARCHAR(10) PRIMARY KEY UNIQUE NOT NULL,
    open DECIMAL(10, 4) NOT NULL,
    high DECIMAL(10, 4) NOT NULL,
    low DECIMAL(10, 4) NOT NULL,
    price DECIMAL (15, 4) NOT NULL,
    volume INT NOT NULL,
    latest_trading_day DATETIME,
    prev_close DECIMAL(10, 4),
    change_point DECIMAL(10, 4),
    change_percent VARCHAR(10) --there is a percent symbol. I do not think we are doing many calculations, hence storing as varchar.
);

--

CREATE TABLE limit_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    symbol VARCHAR(10) NOT NULL,
    request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    close_date DATETIME DEFAULT NULL,
    request_price DECIMAL (10,4) NOT NULL,
    request_quantity INT UNSIGNED NOT NULL,
    order_type ENUM('buy', 'sell') NOT NULL,
    status ENUM('open', 'filled', 'canceled') DEFAULT 'open',
    FOREIGN KEY (user_id) REFERENCES logindb.users(id),
    FOREIGN KEY (symbol) REFERENCES popular_stocks(symbol)
);


--will probably need to update this file later with more tables
