CREATE DATABASE IF NOT EXISTS tourist_spot_db;
USE tourist_spot_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(250) NOT NULL,
    role ENUM('admin','editor','user') DEFAULT 'user',
    token VARCHAR(250) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert admin user (replace password hash)
INSERT INTO users (username,password,role) 
VALUES ('admin','$2y$10$pgwC3EUh3sayoS9GRiDb7u817L26Psb7E6/KZ7GD/V56O2gkbyPEi','admin');

-- Tourist spots table
CREATE TABLE IF NOT EXISTS tourist_spots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    description TEXT,
    location VARCHAR(250),
    image VARCHAR(250),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample tourist spots
INSERT INTO tourist_spots (name, description, location, image) VALUES
('Eiffel Tower','Iconic wrought-iron lattice tower in Paris, France.','Paris, France','eiffel.jpg'),
('Grand Canyon','Vast canyon carved by the Colorado River.','Arizona, USA','grand_canyon.jpg'),
('Great Wall of China','Historic wall stretching over 13,000 miles.','Beijing, China','great_wall.jpg');