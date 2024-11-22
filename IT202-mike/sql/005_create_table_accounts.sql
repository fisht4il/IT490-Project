CREATE TABLE IF NOT EXISTS `Accounts` (
    `id` INT AUTO_INCREMENT,
    `account_number` CHAR(12) UNIQUE,
    `user_id` INT,
    `balance` DECIMAL(15, 2) DEFAULT 0,
    `account_type` VARCHAR(50),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`user_id`) REFERENCES Users(`id`),
    CHECK (LENGTH(`account_number`) = 12)
);