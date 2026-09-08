CREATE OR REPLACE VIEW fisheries_summary AS
SELECT
	fc.id,
	fc.catch_date,
	CONCAT_WS(' ', f.first_name, f.middle_name, f.last_name) AS fisherman_name,
	fs.common_name AS species,
	b.name AS boat_name,
	fg.name AS gear_name,
	fc.quantity,
	fc.unit,
	fc.estimated_value
FROM fish_catch fc
JOIN fishermen f ON f.id = fc.fisherman_id
LEFT JOIN fish_species fs ON fs.id = fc.species_id
LEFT JOIN boats b ON b.id = fc.boat_id
LEFT JOIN fishing_gears fg ON fg.id = fc.gear_id;
