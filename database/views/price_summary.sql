CREATE OR REPLACE VIEW price_summary AS
SELECT
	pm.id,
	p.name AS product_name,
	p.category,
	pm.market_name,
	pm.location,
	pm.recorded_date,
	pm.minimum_price,
	pm.maximum_price,
	pm.average_price,
	pm.source
FROM price_monitoring pm
JOIN products p ON p.id = pm.product_id;
