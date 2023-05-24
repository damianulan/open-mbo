<?php

namespace App\Console\Commands\Repo;

use Illuminate\Console\Command;

class Pull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $e = exec('cd '.base_path(). ' && git pull', $o, $c);
        $this->comment($c);
    }
}
