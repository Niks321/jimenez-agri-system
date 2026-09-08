CREATE TABLE IF NOT EXISTS fishermen (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id BIGINT UNSIGNED NULL,
	registration_number VARCHAR(50) NULL,
	first_name VARCHAR(100) NOT NULL,
	middle_name VARCHAR(100) NULL,
	last_name VARCHAR(100) NOT NULL,
	phone VARCHAR(30) NULL,
	address TEXT NULL,
	barangay VARCHAR(100) NULL,
	status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE KEY uq_fishermen_registration (registration_number),
	KEY idx_fishermen_user (user_id),
	CONSTRAINT fk_fishermen_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
