CREATE TABLE user_wallet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    current_balance DECIMAL (15, 2) DEFAULT 0.00,
    FOREIGN KEY (user_id) REFERENCES logindb.users(id)
);
