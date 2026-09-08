CREATE OR REPLACE VIEW farmer_summary AS
SELECT
	f.id,
	f.registration_number,
	CONCAT_WS(' ', f.first_name, f.middle_name, f.last_name) AS farmer_name,
	f.barangay,
	f.status,
	COUNT(DISTINCT cc.id) AS crop_cycle_count,
	COUNT(DISTINCT l.id) AS livestock_record_count
FROM farmers f
LEFT JOIN crop_cycles cc ON cc.farmer_id = f.id
LEFT JOIN livestock l ON l.farmer_id = f.id
GROUP BY f.id, f.registration_number, f.first_name, f.middle_name, f.last_name, f.barangay, f.status;
