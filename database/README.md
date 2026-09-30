# Database setup

Database schema files are kept as numbered migrations under `database/migrations/`.
They can be imported through phpMyAdmin or the XAMPP MariaDB terminal in numeric
order after selecting the target database. Start with `001_users.sql` and finish
with `027_fishery_application_reference_fields.sql`.

The repository does not include a demo-user seed or a known password. This prevents
a public clone from automatically receiving an account that could be used against a
deployed database. Create local demonstration users manually, or generate them from
a private deployment process, and disable them before production use.

After importing migration `024_user_departments.sql`, assign each staff account one
department: `crop`, `vegetables`, `fishery`, or `livestock`. Accounts without a
department are denied workspace access. Administrator accounts use the
`administrator` role; staff accounts use the `staff` role and their department value.

Migration `025_department_data_isolation.sql` constrains department values, disables
unsupported legacy account types, and moves livestock owner details into a separate
livestock-owned table before removing the livestock-to-crop-farmer relationship.
Back up the database before applying it. Existing accounts outside the administrator
and department staff identities are disabled by the migration and must be reviewed.

Migration `026_fishery_review_date.sql` stores the account officer's review date with
fishery applications. Apply it to existing databases before saving a review date.

Migration `027_fishery_application_reference_fields.sql` stores the second Breadth and
Age entries and the additional boat description shown on the supplied application form.

After the migrations, the files under `database/seeders/` add non-sensitive reference
data. The files under `database/views/` create reporting views. The PHP models and
services use the database schema through department-guarded repositories and services.
