CREATE TABLE IF NOT EXISTS expiration_history (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	entity_type VARCHAR(50) NOT NULL,
	entity_id BIGINT UNSIGNED NOT NULL,
	expiry_date DATE NOT NULL,
	notification_date DATE NULL,
	status ENUM('pending', 'notified', 'resolved') NOT NULL DEFAULT 'pending',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	KEY idx_expiration_entity (entity_type, entity_id),
	KEY idx_expiration_date (expiry_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
