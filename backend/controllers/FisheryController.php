<?php

require_once __DIR__ . '/../security/Csrf.php';
require_once __DIR__ . '/../services/FisheryService.php';

final class FisheryController
{
    public function __construct(
        private FisheryService $service,
        private Csrf $csrf
    ) {
    }

    public static function navigation(): array
    {
        return [
            'active' => ['label' => 'Active - Fisher Folk', 'url' => 'personnel-fishery.php?section=active'],
            'inactive' => ['label' => 'Inactive - Fisher Folk', 'url' => 'personnel-fishery.php?section=inactive'],
            'application' => ['label' => 'Application', 'url' => 'personnel-fishery.php?section=application'],
            'monitoring' => ['label' => 'Catch Monitoring', 'url' => 'personnel-fishery.php?section=monitoring'],
        ];
    }

    public static function sectionMeta(): array
    {
        return [
            'active' => ['title' => 'Active Fisher Folk', 'subtitle' => 'Active fisherfolk registry', 'description' => 'Review registered fisherfolk who are currently active in the fishery program.'],
            'inactive' => ['title' => 'Inactive Fisher Folk', 'subtitle' => 'Inactive fisherfolk registry', 'description' => 'Review fisherfolk records that are currently inactive in the fishery program.'],
            'application' => ['title' => 'Fishery Application', 'subtitle' => 'Application data entry', 'description' => 'Complete the Fishing Boat Insurance Application form and print it for review.'],
            'monitoring' => ['title' => 'Catch Monitoring', 'subtitle' => 'Fishery catch monitoring', 'description' => 'Record landing activity, catch volume, species, and estimated value.'],
        ];
    }

    public static function validSection(mixed $section): string
    {
        return array_key_exists((string) $section, self::sectionMeta()) ? (string) $section : 'active';
    }

    public function handle(array $input): ?string
    {
        if (!$this->csrf->valid($input['_csrf_token'] ?? null)) {
            return 'Your form session expired. Refresh and try again.';
        }

        $formType = $input['form_type'] ?? 'application';
        if ($formType === 'delete_fisherman') {
            $this->service->deleteFisherman((int) ($input['fisherman_id'] ?? 0));
            return null;
        }
        if ($formType === 'monitoring') {
            if ((int) ($input['fisherman_id'] ?? 0) < 1 || (int) ($input['species_id'] ?? 0) < 1 || (float) ($input['quantity'] ?? 0) <= 0) {
                return 'Fisherman, species, and quantity are required.';
            }
            $this->service->saveCatch($input);
            return null;
        }

        if (trim((string) ($input['applicant_first_name'] ?? '')) === '' || trim((string) ($input['applicant_last_name'] ?? '')) === '') {
            return 'Applicant first name and last name are required.';
        }

        $this->service->saveApplication($input);
        return null;
    }

    public function registry(string $status, string $search = ''): array
    {
        return $this->service->registry($status, $search);
    }

    public function fishermen(): array
    {
        return $this->service->fishermen();
    }

    public function applicationForFisherman(int $fishermanId): ?array
    {
        return $this->service->applicationForFisherman($fishermanId);
    }

    public function boats(): array
    {
        return $this->service->boats();
    }

    public function species(): array
    {
        return $this->service->species();
    }

    public function gears(): array
    {
        return $this->service->gears();
    }

    public function recentCatches(): array
    {
        return $this->service->recentCatches();
    }
}
