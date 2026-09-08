# Database setup

Database schema files are kept as numbered migrations under `database/migrations/`.
They can be imported through phpMyAdmin or the XAMPP MariaDB terminal in numeric
order after selecting the target database. Start with `001_users.sql` and finish
with `022_audit_logs.sql`.

The repository does not include a demo-user seed or a known password. This prevents
a public clone from automatically receiving an account that could be used against a
deployed database. Create local demonstration users manually, or generate them from
a private deployment process, and disable them before production use.

After the migrations, the files under `database/seeders/` add non-sensitive reference
data. The files under `database/views/` create reporting views. The PHP models and
services still need to be implemented against this schema.