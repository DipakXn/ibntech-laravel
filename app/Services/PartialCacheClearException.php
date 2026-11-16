<?php

namespace App\Services;

use RuntimeException;
use Throwable;

class PartialCacheClearException extends RuntimeException
{
    /**
     * @param  list<string>  $completedSteps
     */
    public function __construct(
        public readonly string $failedStep,
        public readonly array $completedSteps,
        Throwable $previous,
    ) {
        parent::__construct($this->publicMessage(), 0, $previous);
    }

    public function publicMessage(): string
    {
        $failed = 'The '.lcfirst($this->failedStep).' could not be cleared.';

        if ($this->completedSteps === []) {
            return $failed;
        }

        $completed = array_map(
            fn (string $step): string => lcfirst($step),
            $this->completedSteps,
        );

        $list = match (count($completed)) {
            1 => $completed[0],
            2 => $completed[0].' and '.$completed[1],
            default => implode(', ', array_slice($completed, 0, -1)).', and '.end($completed),
        };

        $verb = count($completed) === 1 ? 'was' : 'were';

        return $failed.' '.ucfirst($list).' '.$verb.' already cleared.';
    }
}
