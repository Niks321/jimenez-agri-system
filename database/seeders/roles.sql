INSERT INTO roles (name, description) VALUES
	('administrator', 'Full system administration access'),
	('staff', 'Department staff access; department is assigned on the user account')
ON DUPLICATE KEY UPDATE description = VALUES(description);
