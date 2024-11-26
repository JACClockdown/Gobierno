CREATE DATABASE store;

USE store;

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name	varchar(255)utf8mb4	utf8mb4_unicode_ci	NO	NULL,
    description	varchar(255)utf8mb4	utf8mb4_unicode_ci	NO	NULL,
    price	double	NULL	NULL	NO	NULL,
    amount	decimal(8,2),
    status	tinyint(1)	NULL	NULL	NO	NULL,						
    created_at	timestamp	NULL	NULL	YES	NULL,
    updated_at	timestamp	NULL	NULL	YES	NULL,
    deleted_at	timestamp	NULL	NULL	YES	NULL									
);