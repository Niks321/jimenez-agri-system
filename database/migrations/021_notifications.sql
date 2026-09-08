CREATE TABLE IF NOT EXISTS notifications (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id BIGINT UNSIGNED NOT NULL,
	title VARCHAR(200) NOT NULL,
	message TEXT NOT NULL,
	notification_type VARCHAR(50) NOT NULL DEFAULT 'info',
	read_at DATETIME NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	KEY idx_notifications_user_read (user_id, read_at),
	CONSTRAINT fk_notifications_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
