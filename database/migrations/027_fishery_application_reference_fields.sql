ALTER TABLE fishery_applications
    ADD COLUMN other_description VARCHAR(255) NULL AFTER usage_description,
    ADD COLUMN breadth_meters_2 DECIMAL(8,2) NULL AFTER breadth_meters,
    ADD COLUMN boat_age_years_2 DECIMAL(6,2) NULL AFTER boat_age_years;