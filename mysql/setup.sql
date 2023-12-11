CREATE USER 'passwords_user'@'localhost' IDENTIFIED BY 'h3DvWQrY6z9pB';

SET block_encryption_mode = 'aes-128-cbc';
SET @key_str = UNHEX('3A7F8D1E2BC9A5F046ECD72B1F84D3A69725B0A881C3D6E90F2A871BC4D5E9B8');
SET @init_vector = UNHEX('4F9D2E8B5A76CBEF218317AF6D025BCE');

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(256) NOT NULL,
    LastName VARCHAR(256) NOT NULL,
    Username VARCHAR(256) NOT NULL,
    Email VARCHAR(256) NOT NULL,
    Comment TEXT,
);

CREATE TABLE Websites (
    WebsiteID INT PRIMARY KEY AUTO_INCREMENT,
    WebsiteName VARCHAR(256) NOT NULL,
    WebsiteURL VARCHAR(256) NOT NULL
);

CREATE TABLE Passwords (
    PasswordID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    WebsiteID INT,
    Password VARBINARY(256) NOT NULL,
    Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (WebsiteID) REFERENCES Websites(WebsiteID) ON DELETE CASCADE
);

INSERT INTO Websites (WebsiteName, WebsiteURL) VALUES
    ('Google', 'https://www.google.com'),
    ('Facebook', 'https://www.facebook.com'),
    ('Twitter', 'https://www.twitter.com'),
    ('LinkedIn', 'https://www.linkedin.com'),
    ('GitHub', 'https://github.com'),
    ('Reddit', 'https://www.reddit.com'),
    ('Wikipedia', 'https://en.wikipedia.org'),
    ('Amazon', 'https://www.amazon.com'),
    ('YouTube', 'https://www.youtube.com'),
    ('Netflix', 'https://www.netflix.com');

INSERT INTO Users (FirstName, LastName, Username, Email, Comment) VALUES
    ('John', 'Doe', 'johndoe', 'john@gmail.com', 'Good for keeping up with friends'),
    ('Jane', 'Smith', 'janesmith', 'jane@hotmail.com', 'Connecting with family and friends'),
    ('Alice', 'Johnson', 'alicej', 'alice@outlook.com', 'Sharing thoughts and updates'),
    ('Bob', 'Wilson', 'bobw', 'bob@yahoo.com', 'Professional networking and updates'),
    ('Eve', 'Brown', 'eveb', 'eve@gmail.com', 'Open source contributions and collaboration'),
    ('Charlie', 'Lee', 'charliel', 'charlie@hotmail.com', 'Exploring various interests'),
    ('Grace', 'Davis', 'graced', 'grace@outlook.com', 'Learning and sharing knowledge'),
    ('David', 'Martin', 'davidm', 'david@yahoo.com', 'Online shopping and reviews'),
    ('Olivia', 'Clark', 'oliviac', 'olivia@gmail.com', 'Watching and sharing videos'),
    ('William', 'Harris', 'williamh', 'william@yahoo.com', 'Streaming movies and TV shows');

INSERT INTO Passwords (UserID, WebsiteID, Password) VALUES
    (1, 1, AES_ENCRYPT('h3DvWQrY6z9pB', @key_str, @init_vector)),
    (2, 2, AES_ENCRYPT('sF3gM9cR1u8pL', @key_str, @init_vector)),
    (3, 3, AES_ENCRYPT('vT5kX1yZ4r7wB', @key_str, @init_vector)),
    (4, 4, AES_ENCRYPT('nG2jR7wA9l4qS', @key_str, @init_vector)),
    (5, 5, AES_ENCRYPT('bW8vH1sU3g6yL', @key_str, @init_vector)),
    (6, 6, AES_ENCRYPT('mK4oY9z2e7xPQ', @key_str, @init_vector)),
    (7, 7, AES_ENCRYPT('tZ1vX8sC3m6oK', @key_str, @init_vector)),
    (8, 8, AES_ENCRYPT('kF7bV3gH2j6nX', @key_str, @init_vector)),
    (9, 9, AES_ENCRYPT('qN9wS4xL2u7pR', @key_str, @init_vector)),
    (10, 10, AES_ENCRYPT('uX5zP3qR7w2vM', @key_str, @init_vector));
