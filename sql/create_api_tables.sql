-- referenced source for structure primary key structure: 
-- https://medium.com/@herefindalex/designing-an-efficient-stock-price-database-from-basic-structure-to-optimization-strategies-44ba2c01fae9#:~:text=Use%20symbol%20as%20the%20primary,and%20test%20symbols%20like%20BLIST.

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

CREATE TABLE limit_orders (
    id INT AUTO_INCREMENT,
    user_id INT NOT NULL,
    symbol VARCHAR(10) NOT NULL,
    request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    close_date DATETIME DEFAULT NULL. --close is for both 'filled' and 'canceled' status
    request_price DECIMAL (10,4) NOT NULL,
    request_quantity INT UNSIGNED NOT NULL,
    order_type ENUM('buy', 'sell') NOT NULL,
    status ENUM('open', 'filled', 'canceled') DEFAULT 'open',
    PRIMARY KEY (user_id, symbol, id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);


--will probably need to update this file later with more tables
