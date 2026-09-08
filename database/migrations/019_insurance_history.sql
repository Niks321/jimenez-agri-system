CREATE TABLE IF NOT EXISTS insurance_history (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	insurance_id BIGINT UNSIGNED NOT NULL,
	changed_by BIGINT UNSIGNED NULL,
	previous_status VARCHAR(30) NULL,
	new_status VARCHAR(30) NOT NULL,
	remarks TEXT NULL,
	changed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	KEY idx_insurance_history_policy (insurance_id),
	CONSTRAINT fk_insurance_history_policy FOREIGN KEY (insurance_id) REFERENCES insurance (id) ON DELETE CASCADE,
	CONSTRAINT fk_insurance_history_user FOREIGN KEY (changed_by) REFERENCES users (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
