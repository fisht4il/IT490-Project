CREATE TABLE user_wallet (
    user_id INT NOT NULL,
    current_balance DECIMAL (15, 2),
    PRIMARY KEY (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
