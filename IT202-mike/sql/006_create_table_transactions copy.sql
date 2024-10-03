CREATE TABLE IF NOT EXISTS `Transactions` (
    `id` INT AUTO_INCREMENT,
    `account_src` INT NOT NULL,
    `account_dest` INT NOT NULL,
    `balance_change` INT,
    `transaction_type` INT NOT NULL,
    `memo` VARCHAR(100),
    `expected_total` INT NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`account_src`) REFERENCES Accounts(id),
    FOREIGN KEY (`account_dest`) REFERENCES Accounts(id)
);