CREATE DATABASE IF NOT EXISTS webchess;
USE webchess;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_white INT,
    player_black INT,
    current_turn VARCHAR(5) DEFAULT 'white',
    status VARCHAR(20) DEFAULT 'waiting', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (player_white) REFERENCES users(id),
    FOREIGN KEY (player_black) REFERENCES users(id)
);

CREATE TABLE moves (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    player_id INT NOT NULL,
    from_square VARCHAR(5),
    to_square VARCHAR(5),
    moved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (game_id) REFERENCES games(id),
    FOREIGN KEY (player_id) REFERENCES users(id)
);

INSERT INTO users (username, password_hash)
VALUES ('testuser', '$2y$10$3zE6ypRQ7zSMu0jY7iYl7ukEf88cZso1B5PNmnWjE53gUQOWVGKkq');
