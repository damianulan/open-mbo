<?php

namespace App\Console\Commands\Search;

use App\Console\BaseCommand;
use App\Support\Search\Discovery\SearchModelScope;
use App\Support\Search\IndexModel;
use Throwable;

class IndexModels extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindexes all indexable models';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->logStart();
        try {
            IndexModel::truncate();
            $scope = new SearchModelScope();
            $classes = $scope->get();

            foreach ($classes as $class) {
                $models = $class::all();
                $this->comment('Indexing ' . count($models) . ' instances of ' . $class . ' ...');
                foreach ($models as $model) {
                    $model->makeIndexes();
                    $this->line('Indexed ' . $model->id);
                }

            }

            $this->log('completed', true);
        } catch (Throwable $th) {
            $this->log($th->getMessage(), false);
            $this->error($th->getMessage());
            if (config('app.debug')) {
                throw $th;
            }
        }
    }
}
