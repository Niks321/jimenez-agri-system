CREATE TABLE IF NOT EXISTS insurance_claims (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	insurance_id BIGINT UNSIGNED NOT NULL,
	claim_number VARCHAR(80) NOT NULL,
	incident_date DATE NULL,
	filed_date DATE NOT NULL,
	claim_amount DECIMAL(14,2) NULL,
	approved_amount DECIMAL(14,2) NULL,
	description TEXT NULL,
	status ENUM('filed', 'under_review', 'approved', 'rejected', 'paid') NOT NULL DEFAULT 'filed',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE KEY uq_insurance_claims_number (claim_number),
	KEY idx_insurance_claims_policy (insurance_id),
	CONSTRAINT fk_insurance_claims_policy FOREIGN KEY (insurance_id) REFERENCES insurance (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
