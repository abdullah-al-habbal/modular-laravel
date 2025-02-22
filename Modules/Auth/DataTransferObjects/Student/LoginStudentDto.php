<?php

declare(strict_types=1);

namespace Modules\Auth\DataTransferObjects\Student;

use Modules\User\ValueObjects\Email;

final class LoginStudentDto
{
    public function __construct(
        public readonly Email $email,
        public readonly string $password
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: new Email($data['email']),
            password: $data['password']
        );
    }

    public function toArray(): array
    {
        return [
            'email' => (string) $this->email,
            'password' => $this->password,
        ];
    }
}
