<?php

declare(strict_types=1);

namespace Modules\About\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\About\Models\AboutPartner;

/**
 * Interface for About Partners repository operations
 */
interface AboutPartnerRepositoryInterface
{
    /**
     * Get all partners
     * 
     * @return Collection<int, AboutPartner>
     */
    public function getAll(): Collection;

    /**
     * Find a partner by ID
     * 
     * @return AboutPartner|null
     */
    public function findById(int $id): ?AboutPartner;

    /**
     * Find a partner by ID or fail
     *
     * @return AboutPartner
     */
    public function findAboutPartnerOrFail(int $id): AboutPartner;

    /**
     * Create a new partner
     */
    public function create(array $data): AboutPartner;

    /**
     * Update an existing partner
     */
    public function update(int $id, array $data): ?AboutPartner;

    /**
     * Delete a partner
     */
    public function delete(int $id): bool;

    /**
     * Reorder partners
     */
    public function reorder(array $orderedIds): bool;
}
