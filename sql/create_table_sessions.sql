CREATE TABLE sessions (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    session_id VARCHAR(255) NOT NULL UNIQUE,
    session_start BIGINT DEFAULT NULL,
    session_end BIGINT DEFAULT NULL,
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    CONSTRAINT unique_username UNIQUE (username)
);
