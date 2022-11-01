<?php

/**
 * Service to prepare common result for success and failure
 *
 * PHP version 7.4
 *
 * @author Mohan Jadhav <mohan212jadhav@gmail.com>
 */

declare(strict_types=1);

namespace App\Services;

class ResultSetter
{
    /**
     * Success result
     *
     * @param string $message
     *
     * @return array
     */
    protected function successResult(string $message): array
    {
        return ['status' => 'success', 'message' => $message];
    }

    /**
     * Failure result
     *
     * @param string $message
     *
     * @return array
     */
    protected function failureResult(string $message): array
    {
        return ['status' => 'error', 'message' => $message];
    }
}
