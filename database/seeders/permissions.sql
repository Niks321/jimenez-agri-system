INSERT INTO permissions (name, description) VALUES
	('dashboard.view', 'View the dashboard'),
	('farmers.manage', 'Create and manage farmer records'),
	('fisheries.manage', 'Create and manage fisheries records'),
	('livestock.manage', 'Create and manage livestock records'),
	('permits.manage', 'Create and manage permits'),
	('insurance.manage', 'Create and manage insurance records'),
	('reports.view', 'View reports'),
	('users.manage', 'Manage user accounts')
ON DUPLICATE KEY UPDATE description = VALUES(description);

INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r CROSS JOIN permissions p WHERE r.name = 'administrator';

INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r JOIN permissions p ON p.name IN ('dashboard.view', 'farmers.manage', 'fisheries.manage', 'livestock.manage', 'permits.manage', 'insurance.manage', 'reports.view') WHERE r.name = 'staff';

INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r JOIN permissions p ON p.name IN ('dashboard.view', 'reports.view') WHERE r.name = 'viewer';
