-- Keep the five supported workspace identities: administrator plus four departments.
-- Invalid legacy identities are disabled before the department column is constrained.
UPDATE users
SET role = 'staff', department = NULL, status = 'inactive'
WHERE role NOT IN ('administrator', 'staff')
   OR (role = 'administrator' AND department IS NOT NULL AND department <> '')
   OR (role = 'staff' AND (department IS NULL OR department NOT IN ('crop', 'vegetables', 'livestock', 'fishery')));

UPDATE users SET department = NULL WHERE role = 'administrator';

ALTER TABLE users
	MODIFY department ENUM('crop', 'vegetables', 'livestock', 'fishery') NULL DEFAULT NULL,
	ADD KEY idx_users_role_department_status (role, department, status),
	ADD CONSTRAINT chk_users_active_workspace_identity CHECK (
		status <> 'active'
		OR (role = 'administrator' AND department IS NULL)
		OR (role = 'staff' AND department IS NOT NULL)
	);

-- Livestock owners are a separate data set. Existing livestock-to-farmer links are
-- copied to the new table before the cross-department foreign key is removed.
CREATE TABLE IF NOT EXISTS livestock_owners (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	full_name VARCHAR(200) NOT NULL,
	phone VARCHAR(30) NULL,
	barangay VARCHAR(100) NULL,
	legacy_farmer_id BIGINT UNSIGNED NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE KEY uq_livestock_owner_legacy_farmer (legacy_farmer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO livestock_owners (full_name, phone, barangay, legacy_farmer_id)
SELECT CONCAT_WS(' ', f.first_name, NULLIF(f.middle_name, ''), f.last_name), f.phone, f.barangay, f.id
FROM farmers f
INNER JOIN (SELECT DISTINCT farmer_id FROM livestock WHERE farmer_id IS NOT NULL) owned ON owned.farmer_id = f.id
ON DUPLICATE KEY UPDATE full_name = VALUES(full_name), phone = VALUES(phone), barangay = VALUES(barangay);

ALTER TABLE livestock ADD COLUMN owner_id BIGINT UNSIGNED NULL AFTER farmer_id;

UPDATE livestock l
INNER JOIN livestock_owners o ON o.legacy_farmer_id = l.farmer_id
SET l.owner_id = o.id;

ALTER TABLE livestock
	DROP FOREIGN KEY fk_livestock_farmer,
	DROP INDEX idx_livestock_farmer,
	DROP COLUMN farmer_id,
	DROP INDEX uq_livestock_owner_legacy_farmer,
	ADD KEY idx_livestock_owner (owner_id),
	ADD CONSTRAINT fk_livestock_owner FOREIGN KEY (owner_id) REFERENCES livestock_owners (id) ON DELETE RESTRICT;

ALTER TABLE livestock_owners DROP COLUMN legacy_farmer_id;
