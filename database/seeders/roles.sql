INSERT INTO roles (name, description) VALUES
	('administrator', 'Full system administration access'),
	('staff', 'Standard municipal staff access'),
	('viewer', 'Read-only reporting access')
ON DUPLICATE KEY UPDATE description = VALUES(description);
