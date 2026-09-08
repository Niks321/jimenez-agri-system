CREATE OR REPLACE VIEW livestock_summary AS
SELECT
	l.id,
	CONCAT_WS(' ', f.first_name, f.middle_name, f.last_name) AS farmer_name,
	l.species,
	l.breed,
	l.tag_number,
	l.sex,
	l.quantity,
	l.status
FROM livestock l
JOIN farmers f ON f.id = l.farmer_id;
