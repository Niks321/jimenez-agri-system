CREATE TABLE IF NOT EXISTS users (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
	email VARCHAR(150) NOT NULL,
	password_hash VARCHAR(255) NOT NULL,
	full_name VARCHAR(150) NOT NULL,
	role VARCHAR(50) NOT NULL DEFAULT 'staff',
	status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
	last_login_at DATETIME NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE KEY uq_users_username (username),
	UNIQUE KEY uq_users_email (email),
	KEY idx_users_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
