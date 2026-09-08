CREATE TABLE IF NOT EXISTS boats (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	fisherman_id BIGINT UNSIGNED NOT NULL,
	registration_number VARCHAR(50) NULL,
	name VARCHAR(100) NULL,
	boat_type VARCHAR(100) NULL,
	length_meters DECIMAL(8,2) NULL,
	capacity_kg DECIMAL(10,2) NULL,
	status ENUM('active', 'inactive', 'retired') NOT NULL DEFAULT 'active',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE KEY uq_boats_registration (registration_number),
	KEY idx_boats_fisherman (fisherman_id),
	CONSTRAINT fk_boats_fisherman FOREIGN KEY (fisherman_id) REFERENCES fishermen (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
