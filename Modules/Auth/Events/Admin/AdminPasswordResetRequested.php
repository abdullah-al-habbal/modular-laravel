<?php

declare(strict_types=1);

namespace Modules\Auth\Events\Admin;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Admin\Models\Admin;

final class AdminPasswordResetRequested
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Admin $admin,
        public readonly string $token
    ) {}
}
