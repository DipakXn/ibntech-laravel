<?php

namespace App\Console\Commands;

use App\Support\EditorialPublication;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class PublishScheduledContent extends Command
{
    protected $signature = 'content:publish-scheduled';

    protected $description = 'Publish editorial content whose scheduled time has arrived';

    public function handle(): int
    {
        $published = 0;

        foreach (EditorialPublication::models() as $modelClass) {
            $modelClass::query()
                ->where('status', EditorialPublication::SCHEDULED)
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->lazyById()
                ->each(function (Model $model) use (&$published): void {
                    $model->status = EditorialPublication::PUBLISHED;
                    $model->save();
                    $published++;
                });
        }

        $this->info("Published {$published} scheduled ".($published === 1 ? 'record' : 'records').'.');

        return self::SUCCESS;
    }
}
