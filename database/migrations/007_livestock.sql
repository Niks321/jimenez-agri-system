CREATE TABLE IF NOT EXISTS livestock (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	farmer_id BIGINT UNSIGNED NOT NULL,
	species VARCHAR(100) NOT NULL,
	breed VARCHAR(100) NULL,
	tag_number VARCHAR(50) NULL,
	sex ENUM('male', 'female', 'unknown') NOT NULL DEFAULT 'unknown',
	birth_date DATE NULL,
	quantity INT UNSIGNED NOT NULL DEFAULT 1,
	status ENUM('active', 'sold', 'deceased', 'inactive') NOT NULL DEFAULT 'active',
	notes TEXT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE KEY uq_livestock_tag (tag_number),
	KEY idx_livestock_farmer (farmer_id),
	CONSTRAINT fk_livestock_farmer FOREIGN KEY (farmer_id) REFERENCES farmers (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
