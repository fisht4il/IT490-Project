CREATE TABLE user_portfolio (
    user_id INT NOT NULL,
    symbol VARCHAR(10) NOT NULL,
    quantity INT UNSIGNED DEFAULT 0,
    average_price DECIMAL (15, 4) DEFAULT 0.00,
    PRIMARY KEY (user_id, symbol),
    FOREIGN KEY (user_id) REFERENCES logindb.users(id),
    FOREIGN KEY (symbol) REFERENCES stock_quotes(symbol)
);





