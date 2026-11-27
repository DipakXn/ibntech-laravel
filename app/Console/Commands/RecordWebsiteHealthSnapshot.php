<?php

namespace App\Console\Commands;

use App\Support\Health\WebsiteHealthRecorder;
use Illuminate\Console\Command;
use Throwable;

class RecordWebsiteHealthSnapshot extends Command
{
    protected $signature = 'health:snapshot';

    protected $description = 'Record a read-only website health snapshot';

    public function handle(WebsiteHealthRecorder $recorder): int
    {
        try {
            $run = $recorder->record('scheduled');
        } catch (Throwable) {
            $this->error('The health snapshot could not be saved.');

            return self::FAILURE;
        }

        $recorder->prune();

        if ($run === null) {
            $this->comment('A health check is already running.');

            return self::SUCCESS;
        }

        $this->info('Recorded a '.$run->overall.' health snapshot.');

        return self::SUCCESS;
    }
}
