<?php

require_once __DIR__ . '/../core/Database.php';

final class PersonnelDataService
{
    public function __construct(private Database $database)
    {
    }

    public function addFarmer(array $data): void
    {
        $statement = $this->database->connection()->prepare(
            'INSERT INTO farmers (registration_number, first_name, middle_name, last_name, sex, birth_date, phone, address, barangay) '
            . 'VALUES (:registration_number, :first_name, :middle_name, :last_name, :sex, :birth_date, :phone, :address, :barangay)'
        );
        $statement->execute([
            'registration_number' => $data['registration_number'] ?: null,
            'first_name' => trim($data['first_name']),
            'middle_name' => trim($data['middle_name']) ?: null,
            'last_name' => trim($data['last_name']),
            'sex' => $data['sex'] ?: null,
            'birth_date' => $data['birth_date'] ?: null,
            'phone' => trim($data['phone']) ?: null,
            'address' => trim($data['address']) ?: null,
            'barangay' => trim($data['barangay']) ?: null,
        ]);
    }

    public function addLivestock(array $data): void
    {
        $statement = $this->database->connection()->prepare(
            'INSERT INTO livestock (farmer_id, species, breed, tag_number, sex, birth_date, quantity, notes) '
            . 'VALUES (:farmer_id, :species, :breed, :tag_number, :sex, :birth_date, :quantity, :notes)'
        );
        $statement->execute([
            'farmer_id' => (int) $data['farmer_id'],
            'species' => trim($data['species']),
            'breed' => trim($data['breed']) ?: null,
            'tag_number' => trim($data['tag_number']) ?: null,
            'sex' => $data['sex'] ?: 'unknown',
            'birth_date' => $data['birth_date'] ?: null,
            'quantity' => max(1, (int) $data['quantity']),
            'notes' => trim($data['notes']) ?: null,
        ]);
    }

    public function addFishCatch(array $data): void
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
            'landing_site' => trim($data['landing_site']) ?: null,
            'quantity' => (float) $data['quantity'],
            'unit' => trim($data['unit']) ?: 'kg',
            'estimated_value' => $data['estimated_value'] ?: null,
            'notes' => trim($data['notes']) ?: null,
        ]);
    }

    public function addVegetable(array $data): void
    {
        $statement = $this->database->connection()->prepare(
            'INSERT INTO crops (name, variety, category, unit) VALUES (:name, :variety, :category, :unit)'
        );
        $statement->execute([
            'name' => trim($data['name']),
            'variety' => trim($data['variety']) ?: null,
            'category' => 'Vegetable',
            'unit' => trim($data['unit']) ?: 'kg',
        ]);
    }

    public function addPrice(array $data): void
    {
        $statement = $this->database->connection()->prepare(
            'INSERT INTO price_monitoring (product_id, recorded_by, market_name, location, recorded_date, minimum_price, maximum_price, average_price, source) '
            . 'VALUES (:product_id, :recorded_by, :market_name, :location, :recorded_date, :minimum_price, :maximum_price, :average_price, :source)'
        );
        $statement->execute([
            'product_id' => (int) $data['product_id'],
            'recorded_by' => $_SESSION['user']['id'] ?? null,
            'market_name' => trim($data['market_name']) ?: null,
            'location' => trim($data['location']) ?: null,
            'recorded_date' => $data['recorded_date'],
            'minimum_price' => $data['minimum_price'] ?: null,
            'maximum_price' => $data['maximum_price'] ?: null,
            'average_price' => (float) $data['average_price'],
            'source' => trim($data['source']) ?: null,
        ]);
    }

    public function addInsurance(array $data): void
    {
        $statement = $this->database->connection()->prepare(
            'INSERT INTO insurance (policy_number, provider, insured_name, farmer_id, fisherman_id, coverage_type, coverage_amount, premium_amount, start_date, end_date, status, notes) '
            . 'VALUES (:policy_number, :provider, :insured_name, :farmer_id, :fisherman_id, :coverage_type, :coverage_amount, :premium_amount, :start_date, :end_date, :status, :notes)'
        );
        $statement->execute([
            'policy_number' => trim((string) ($data['policy_number'] ?? '')) ?: 'POL-' . date('YmdHis') . '-' . random_int(1000, 9999),
            'provider' => trim((string) ($data['provider'] ?? '')) ?: 'Municipal Agriculture Office',
            'insured_name' => trim((string) ($data['insured_name'] ?? '')),
            'farmer_id' => isset($data['farmer_id']) && $data['farmer_id'] !== '' ? (int) $data['farmer_id'] : null,
            'fisherman_id' => isset($data['fisherman_id']) && $data['fisherman_id'] !== '' ? (int) $data['fisherman_id'] : null,
            'coverage_type' => trim((string) ($data['coverage_type'] ?? '')) ?: 'Crop',
            'coverage_amount' => (float) ($data['coverage_amount'] ?? 0),
            'premium_amount' => (float) ($data['premium_amount'] ?? 0),
            'start_date' => $data['start_date'] ?: date('Y-m-d'),
            'end_date' => $data['end_date'] ?: null,
            'status' => $data['status'] ?: 'pending',
            'notes' => trim((string) ($data['notes'] ?? '')) ?: null,
        ]);
    }

    public function farmers(): array
    {
        return $this->database->connection()->query('SELECT id, registration_number, first_name, middle_name, last_name, barangay FROM farmers ORDER BY last_name, first_name')->fetchAll();
    }

    public function fishermen(): array
    {
        return $this->database->connection()->query('SELECT id, first_name, middle_name, last_name FROM fishermen ORDER BY last_name, first_name')->fetchAll();
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

    public function products(): array
    {
        return $this->database->connection()->query("SELECT id, name, unit FROM products WHERE status = 'active' ORDER BY name")->fetchAll();
    }

    public function insurances(): array
    {
        return $this->database->connection()->query(
            'SELECT i.*, f.first_name AS farmer_first_name, f.last_name AS farmer_last_name, ' 
            . 'fm.first_name AS fisherman_first_name, fm.last_name AS fisherman_last_name ' 
            . 'FROM insurance i ' 
            . 'LEFT JOIN farmers f ON f.id = i.farmer_id ' 
            . 'LEFT JOIN fishermen fm ON fm.id = i.fisherman_id ' 
            . 'ORDER BY i.id DESC LIMIT 12'
        )->fetchAll();
    }

    public function recent(string $table, int $limit = 8): array
    {
        $allowed = ['farmers', 'livestock', 'fish_catch', 'crops', 'price_monitoring', 'insurance'];
        if (!in_array($table, $allowed, true)) {
            throw new InvalidArgumentException('Unsupported monitoring table.');
        }
        $limit = max(1, min(50, $limit));
        return $this->database->connection()->query("SELECT * FROM {$table} ORDER BY id DESC LIMIT {$limit}")->fetchAll();
    }

    public function dashboardAnalytics(): array
    {
        $connection = $this->database->connection();
        $count = static function (PDO $connection, string $query): int {
            return (int) $connection->query($query)->fetchColumn();
        };

        return [
            'counts' => [
                'farmers' => $count($connection, 'SELECT COUNT(*) FROM farmers WHERE status = "active"'),
                'livestock' => $count($connection, 'SELECT COALESCE(SUM(quantity), 0) FROM livestock WHERE status = "active"'),
                'fish_catch' => $count($connection, 'SELECT COUNT(*) FROM fish_catch'),
                'price_entries' => $count($connection, 'SELECT COUNT(*) FROM price_monitoring'),
                'insurance_entries' => $count($connection, 'SELECT COUNT(*) FROM insurance'),
            ],
            'priceTrend' => $connection->query(
                'SELECT DATE_FORMAT(recorded_date, "%b %d") AS label, ROUND(AVG(average_price), 2) AS value '
                . 'FROM price_monitoring WHERE recorded_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) '
                . 'GROUP BY recorded_date ORDER BY recorded_date'
            )->fetchAll(),
            'catchTrend' => $connection->query(
                'SELECT DATE_FORMAT(catch_date, "%b %d") AS label, ROUND(SUM(quantity), 2) AS value '
                . 'FROM fish_catch WHERE catch_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) '
                . 'GROUP BY catch_date ORDER BY catch_date'
            )->fetchAll(),
            'livestockBySpecies' => $connection->query(
                'SELECT species AS label, SUM(quantity) AS value FROM livestock '
                . 'WHERE status = "active" GROUP BY species ORDER BY value DESC LIMIT 8'
            )->fetchAll(),
            'farmersByBarangay' => $connection->query(
                'SELECT COALESCE(NULLIF(barangay, ""), "Unassigned") AS label, COUNT(*) AS value '
                . 'FROM farmers WHERE status = "active" GROUP BY label ORDER BY value DESC LIMIT 8'
            )->fetchAll(),
            'latestPrices' => $connection->query(
                'SELECT p.name AS product, pm.recorded_date, pm.average_price, pm.market_name, pm.location '
                . 'FROM price_monitoring pm JOIN products p ON p.id = pm.product_id '
                . 'ORDER BY pm.recorded_date DESC, pm.id DESC LIMIT 8'
            )->fetchAll(),
        ];
    }
}
