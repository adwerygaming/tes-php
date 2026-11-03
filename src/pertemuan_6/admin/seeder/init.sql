DROP DATABASE IF EXISTS dataweb3654;
CREATE DATABASE dataweb3654;

USE dataweb3654;

CREATE TABLE user (
    username VARCHAR(20) PRIMARY KEY,
    passwd VARCHAR(20) NOT NULL,
    full_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL
);

CREATE TABLE news (
    id INT(11) PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    isi TEXT NOT NULL,
    image VARCHAR(25),
    created_at DATE NOT NULL DEFAULT (CURRENT_DATE),
    username VARCHAR(20) REFERENCES user(username) ON DELETE CASCADE
);

INSERT INTO user VALUES 
    ('masdepan', 'masdepanwashere', 'Devan Aditiya', 'masdepan@masdepan.my.id'),
    ('mika', '123123123123', 'Mikael', 'mikael@masdepan.my.id'),
    ('usman', '123123123123', 'Usmanul', 'usman@masdepan.my.id');
    
INSERT INTO news VALUES 
    ('2026102701', 'Perawatan Layanan Internet Amikom & Eduroam', 'wifinya maintenance dulu ya hehe', NULL, NOW(), 'masdepan');