<?php

require_once __DIR__ . '/../core/Database.php';

final class FisheryRepository
{
    public function __construct(private Database $database)
    {
    }

    public function createCatch(array $data): void
    {
        $statement = $this->database->connection()->prepare(
            'INSERT INTO fish_catch (fisherman_id, boat_id, species_id, gear_id, catch_date, landing_site, quantity, unit, estimated_value, notes) '
            . 'VALUES (:fisherman_id, :boat_id, :species_id, :gear_id, :catch_date, :landing_site, :quantity, :unit, :estimated_value, :notes)'
        );
        $statement->execute([
            'fisherman_id' => (int) $data['fisherman_id'],
            'boat_id' => $data['boat_id'] ?: null,
            'species_id' => (int) $data['species_id'],
            'gear_id' => $data['gear_id'] ?: null,
            'catch_date' => $data['catch_date'],
            'landing_site' => trim((string) ($data['landing_site'] ?? '')) ?: null,
            'quantity' => (float) $data['quantity'],
            'unit' => trim((string) ($data['unit'] ?? '')) ?: 'kg',
            'estimated_value' => $data['estimated_value'] ?: null,
            'notes' => trim((string) ($data['notes'] ?? '')) ?: null,
        ]);
    }

    public function createApplication(array $data): void
    {
        $connection = $this->database->connection();
        $connection->beginTransaction();
        try {
            $fisherman = $connection->prepare(
                'INSERT INTO fishermen (rsbsa_number, registration_number, first_name, middle_name, last_name, phone, address, barangay) '
                . 'VALUES (:rsbsa_number, :registration_number, :first_name, :middle_name, :last_name, :phone, :address, :barangay)'
            );
            $fisherman->execute([
                'rsbsa_number' => trim((string) ($data['rsbsa_number'] ?? '')) ?: null,
                'registration_number' => trim((string) ($data['registration_number'] ?? '')) ?: null,
                'first_name' => trim((string) $data['applicant_first_name']),
                'middle_name' => trim((string) ($data['applicant_middle_name'] ?? '')) ?: null,
                'last_name' => trim((string) $data['applicant_last_name']),
                'phone' => trim((string) ($data['contact_number'] ?? '')) ?: null,
                'address' => trim((string) ($data['address'] ?? '')) ?: null,
                'barangay' => trim((string) ($data['barangay'] ?? '')) ?: null,
            ]);
            $fishermanId = (int) $connection->lastInsertId();
            $fields = ['applicant_last_name', 'applicant_first_name', 'applicant_middle_name', 'fishermen_association', 'address', 'spouse_name', 'contact_number', 'sex', 'civil_status', 'beneficiary_name', 'beneficiary_relation', 'boat_type', 'boat_material', 'motor_number', 'chassis_number', 'usage_description', 'length_meters', 'breadth_meters', 'depth_meters', 'gross_tonnage', 'boat_age_years', 'boat_color', 'registration_number', 'or_number', 'or_date', 'location_of_property', 'desired_sum_insured', 'cover_from', 'cover_to', 'mortgage_to', 'mortgage_branch', 'mortgage_address', 'reviewed_by', 'application_date'];
            $columns = implode(', ', array_merge(['fisherman_id'], $fields));
            $placeholders = ':' . implode(', :', array_merge(['fisherman_id'], $fields));
            $values = ['fisherman_id' => $fishermanId, 'application_date' => $data['application_date'] ?: date('Y-m-d')];
            foreach ($fields as $field) {
                if (!array_key_exists($field, $values)) {
                    $values[$field] = is_string($data[$field] ?? null) ? trim($data[$field]) ?: null : ($data[$field] ?? null);
                }
            }
            $statement = $connection->prepare("INSERT INTO fishery_applications ($columns) VALUES ($placeholders)");
            $statement->execute($values);
            $connection->commit();
        } catch (Throwable $exception) {
            $connection->rollBack();
            throw $exception;
        }
    }

    public function applicationForFisherman(int $fishermanId): ?array
    {
        $statement = $this->database->connection()->prepare(
            'SELECT f.rsbsa_number, f.registration_number AS fisher_registration_number, f.first_name, f.middle_name, f.last_name, f.address AS fisherman_address, f.barangay, '
            . 'a.* FROM fishermen f LEFT JOIN fishery_applications a ON a.id = (SELECT MAX(latest.id) FROM fishery_applications latest WHERE latest.fisherman_id = f.id) '
            . 'WHERE f.id = :fisherman_id LIMIT 1'
        );
        $statement->execute(['fisherman_id' => $fishermanId]);
        $application = $statement->fetch();
        return $application ?: null;
    }

    public function updateApplication(int $fishermanId, array $data): void
    {
        $connection = $this->database->connection();
        $connection->beginTransaction();
        try {
            $fisherman = $connection->prepare(
                'UPDATE fishermen SET rsbsa_number = :rsbsa_number, registration_number = :registration_number, first_name = :first_name, middle_name = :middle_name, last_name = :last_name, phone = :phone, address = :address, barangay = :barangay WHERE id = :fisherman_id'
            );
            $fisherman->execute([
                'fisherman_id' => $fishermanId,
                'rsbsa_number' => trim((string) ($data['rsbsa_number'] ?? '')) ?: null,
                'registration_number' => trim((string) ($data['registration_number'] ?? '')) ?: null,
                'first_name' => trim((string) $data['applicant_first_name']),
                'middle_name' => trim((string) ($data['applicant_middle_name'] ?? '')) ?: null,
                'last_name' => trim((string) $data['applicant_last_name']),
                'phone' => trim((string) ($data['contact_number'] ?? '')) ?: null,
                'address' => trim((string) ($data['address'] ?? '')) ?: null,
                'barangay' => trim((string) ($data['barangay'] ?? '')) ?: null,
            ]);
            $fields = ['applicant_last_name', 'applicant_first_name', 'applicant_middle_name', 'fishermen_association', 'address', 'spouse_name', 'contact_number', 'sex', 'civil_status', 'beneficiary_name', 'beneficiary_relation', 'boat_type', 'boat_material', 'motor_number', 'chassis_number', 'usage_description', 'length_meters', 'breadth_meters', 'depth_meters', 'gross_tonnage', 'boat_age_years', 'boat_color', 'registration_number', 'or_number', 'or_date', 'location_of_property', 'desired_sum_insured', 'cover_from', 'cover_to', 'mortgage_to', 'mortgage_branch', 'mortgage_address', 'reviewed_by', 'application_date'];
            $values = ['fisherman_id' => $fishermanId, 'application_date' => $data['application_date'] ?: date('Y-m-d')];
            foreach ($fields as $field) {
                if (!array_key_exists($field, $values)) {
                    $values[$field] = is_string($data[$field] ?? null) ? trim($data[$field]) ?: null : ($data[$field] ?? null);
                }
            }
            $latest = $connection->prepare('SELECT id FROM fishery_applications WHERE fisherman_id = :fisherman_id ORDER BY id DESC LIMIT 1');
            $latest->execute(['fisherman_id' => $fishermanId]);
            $applicationId = $latest->fetchColumn();
            if ($applicationId) {
                $assignments = implode(', ', array_map(static fn (string $field): string => "{$field} = :{$field}", $fields));
                $statement = $connection->prepare("UPDATE fishery_applications SET {$assignments} WHERE id = :application_id");
                $values['application_id'] = $applicationId;
                $statement->execute($values);
            } else {
                $columns = implode(', ', array_merge(['fisherman_id'], $fields));
                $placeholders = ':' . implode(', :', array_merge(['fisherman_id'], $fields));
                $statement = $connection->prepare("INSERT INTO fishery_applications ($columns) VALUES ($placeholders)");
                $statement->execute($values);
            }
            $connection->commit();
        } catch (Throwable $exception) {
            $connection->rollBack();
            throw $exception;
        }
    }

    public function deleteFisherman(int $fishermanId): void
    {
        if ($fishermanId < 1) {
            throw new InvalidArgumentException('Invalid fisherman ID.');
        }

        $connection = $this->database->connection();
        $connection->beginTransaction();
        try {
            foreach (['fishery_applications', 'fish_catch', 'boats'] as $table) {
                $statement = $connection->prepare("DELETE FROM {$table} WHERE fisherman_id = :fisherman_id");
                $statement->execute(['fisherman_id' => $fishermanId]);
            }
            $statement = $connection->prepare('DELETE FROM fishermen WHERE id = :fisherman_id');
            $statement->execute(['fisherman_id' => $fishermanId]);
            $connection->commit();
        } catch (Throwable $exception) {
            $connection->rollBack();
            throw $exception;
        }
    }

    public function registry(string $status, string $search = ''): array
    {
        $statement = $this->database->connection()->prepare(
            'SELECT f.id, f.rsbsa_number, f.registration_number AS fisher_registration_number, f.first_name, f.middle_name, f.last_name, f.barangay, f.status, '
            . 'a.fishermen_association, a.address, a.spouse_name, a.contact_number, a.sex, a.civil_status, a.beneficiary_name, a.beneficiary_relation, '
            . 'a.boat_type, a.boat_material, a.motor_number, a.chassis_number, a.usage_description, a.length_meters, a.breadth_meters, a.depth_meters, '
            . 'a.gross_tonnage, a.boat_age_years, a.boat_color, a.registration_number AS boat_registration_number, a.or_number, a.or_date, '
            . 'a.location_of_property, a.desired_sum_insured, a.cover_from, a.cover_to, a.mortgage_to, a.mortgage_branch, a.mortgage_address, a.application_date '
            . 'FROM fishermen f LEFT JOIN fishery_applications a ON a.id = (SELECT MAX(latest.id) FROM fishery_applications latest WHERE latest.fisherman_id = f.id) '
            . 'WHERE f.status = :status AND (f.rsbsa_number LIKE :search_rsbsa OR f.registration_number LIKE :search_registration OR f.last_name LIKE :search_last_name OR f.first_name LIKE :search_first_name OR f.barangay LIKE :search_barangay) '
            . 'ORDER BY f.last_name, f.first_name'
        );
        $term = '%' . trim($search) . '%';
        $statement->execute([
            'status' => $status,
            'search_rsbsa' => $term,
            'search_registration' => $term,
            'search_last_name' => $term,
            'search_first_name' => $term,
            'search_barangay' => $term,
        ]);
        return $statement->fetchAll();
    }

    public function fishermen(): array
    {
        return $this->database->connection()->query('SELECT id, rsbsa_number, registration_number, first_name, middle_name, last_name, barangay, status FROM fishermen ORDER BY last_name, first_name')->fetchAll();
    }

    public function boats(): array
    {
        return $this->database->connection()->query('SELECT id, name, registration_number FROM boats ORDER BY name, registration_number')->fetchAll();
    }

    public function species(): array
    {
        return $this->database->connection()->query("SELECT id, common_name FROM fish_species WHERE status = 'active' ORDER BY common_name")->fetchAll();
    }

    public function gears(): array
    {
        return $this->database->connection()->query("SELECT id, name FROM fishing_gears WHERE status = 'active' ORDER BY name")->fetchAll();
    }

    public function recentCatches(int $limit = 8): array
    {
        $limit = max(1, min(50, $limit));
        return $this->database->connection()->query("SELECT * FROM fish_catch ORDER BY id DESC LIMIT {$limit}")->fetchAll();
    }
}
