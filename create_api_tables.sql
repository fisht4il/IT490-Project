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

--will probably need to update this file later with more tables
