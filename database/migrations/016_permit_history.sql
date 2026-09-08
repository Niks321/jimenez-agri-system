CREATE TABLE IF NOT EXISTS permit_history (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	permit_id BIGINT UNSIGNED NOT NULL,
	changed_by BIGINT UNSIGNED NULL,
	previous_status VARCHAR(30) NULL,
	new_status VARCHAR(30) NOT NULL,
	remarks TEXT NULL,
	changed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	KEY idx_permit_history_permit (permit_id),
	CONSTRAINT fk_permit_history_permit FOREIGN KEY (permit_id) REFERENCES permits (id) ON DELETE CASCADE,
	CONSTRAINT fk_permit_history_user FOREIGN KEY (changed_by) REFERENCES users (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
