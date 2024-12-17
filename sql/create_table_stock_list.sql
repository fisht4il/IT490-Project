--this holds ALL stock lists and is occasionally updated from api
CREATE TABLE stock_list (
	symbol VARCHAR(10) UNIQUE,
	name VARCHAR(255) NOT NULL,
	exchange VARCHAR(50) NOT NULL,
	type VARCHAR(25) NOT NULL
);

--this holds only a few stocks we picked. It will update from stock_list and NOT from api (this helps avoid going over usage limit)
CREATE TABLE popular_stocks (
	id INT AUTO_INCREMENT PRIMARY KEY,
	symbol VARCHAR(10) NOT NULL UNIQUE,
	name VARCHAR(255) NOT NULL,
	exchange VARCHAR(50) NOT NULL,
	type VARCHAR(25) NOT NULL,
	popular_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (symbol) REFERENCES stock_list(symbol)
);


-- query to populate the popular_stocks table:

-- INSERT INTO popular_stocks (symbol, name, exchange, type) 
-- SELECT symbol, name, exchange, type from stock_list 
-- WHERE symbol IN ('AAPL', 'ADP', 'AMC', 'AMD', 'AMZN', 'BABA', 'GME', 'GOOGL', 'HOOD', 'IBM', 'META', 'MSFT', 'NFLX', 'NVDA', 'ORCL', 'RBLX', 'SBUX', 'SPY', 'TSLA', 'TSM', 'UBER');

