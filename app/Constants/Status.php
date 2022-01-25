<?php

namespace App\Constants;

class Status
{
    public const OK = 'OK';
    public const FAILED = 'FAILED';
    public const APPROVED = 'APPROVED';
    public const REJECTED = 'REJECTED';
    public const PENDING = 'PENDING';
    public const PENDING_VALIDATION = 'PENDING_VALIDATION';
    public const UNAUTHORIZED = 'UNAUTHORIZED';
    public const REFUNDED = 'REFUNDED';
    public const ERROR = 'ERROR';

    protected string $status;
    protected string $reason;
    protected string $message = '';
    protected string $date = '';

}
