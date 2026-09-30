<?php

require_once __DIR__ . '/../security/Csrf.php';
require_once __DIR__ . '/../services/FisheryService.php';

final class FisheryController
{
    private ?int $savedFishermanId = null;

    public function __construct(
        private FisheryService $service,
        private Csrf $csrf
    ) {
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

        $this->savedFishermanId = $this->service->saveApplication($input);
        return null;
    }

    public function savedFishermanId(): ?int
    {
        return $this->savedFishermanId;
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

    public function catches(): array
    {
        return $this->service->catches();
    }
}
