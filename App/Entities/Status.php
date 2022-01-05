<?php

namespace App\Entities;

class Status
{
    public const OK = 'OK';
    public const ST_FAILED = 'FAILED';
    public const ST_APPROVED = 'APPROVED';
    public const ST_REJECTED = 'REJECTED';
    public const ST_PENDING = 'PENDING';
    public const ST_PENDING_VALIDATION = 'PENDING_VALIDATION';
    public const UNAUTHORIZED = 'UNAUTHORIZED';
    public const ST_REFUNDED = 'REFUNDED';
    public const ST_ERROR = 'ERROR';

    protected string $status;
    protected string $reason;
    protected string $message = '';
    protected string $date = '';

}
