<?php

require_once __DIR__ . '/../repositories/FisheryRepository.php';

final class FisheryService
{
    public function __construct(private FisheryRepository $repository)
    {
    }

    public function saveApplication(array $data): void
    {
        $fishermanId = (int) ($data['fisherman_id'] ?? 0);
        if ($fishermanId > 0) {
            $this->repository->updateApplication($fishermanId, $data);
            return;
        }
        $this->repository->createApplication($data);
    }

    public function applicationForFisherman(int $fishermanId): ?array
    {
        return $this->repository->applicationForFisherman($fishermanId);
    }

    public function saveCatch(array $data): void
    {
        $this->repository->createCatch($data);
    }

    public function deleteFisherman(int $fishermanId): void
    {
        $this->repository->deleteFisherman($fishermanId);
    }

    public function registry(string $status, string $search = ''): array
    {
        if (!in_array($status, ['active', 'inactive'], true)) {
            throw new InvalidArgumentException('Unsupported fisherfolk status.');
        }
        return $this->repository->registry($status, $search);
    }

    public function fishermen(): array
    {
        return $this->repository->fishermen();
    }

    public function boats(): array
    {
        return $this->repository->boats();
    }

    public function species(): array
    {
        return $this->repository->species();
    }

    public function gears(): array
    {
        return $this->repository->gears();
    }

    public function recentCatches(): array
    {
        return $this->repository->recentCatches();
    }
}
