<?php

declare(strict_types=1);

namespace App\Actions\Concerns;

trait BuildsPivotPayload
{
    /**
     * Convert request rows into the id => pivot attributes array expected by sync().
     */
    protected function pivotPayload(array $rows, string $key): array
    {
        return collect($rows)
            ->mapWithKeys(fn (array $row): array => [$row[$key] => ['expires_at' => $row['expires_at'] ?? null]])
            ->all();
    }
}