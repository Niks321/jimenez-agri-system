ALTER TABLE users
	ADD COLUMN department VARCHAR(32) NULL AFTER role,
	ADD KEY idx_users_department_status (department, status);