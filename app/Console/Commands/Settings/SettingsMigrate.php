<?php

namespace App\Console\Commands\Settings;

use App\Console\BaseCommand;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserObjective;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class SettingsMigrate extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:migrate {--class=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate settings';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $map = [
            'GeneralSettings' => \App\Settings\GeneralSettings::class,
            'MBOSettings' => \App\Settings\MBOSettings::class,
            'MailSettings' => \App\Settings\MailSettings::class,
            'NotificationSettings' => \App\Settings\NotificationSettings::class,
            'ReportSettings' => \App\Settings\ReportSettings::class,
            'UserSettings' => \App\Settings\UserSettings::class,
        ];
        $classOption = $this->option('class');

        try {
            DB::beginTransaction();
            if ($classOption) {
                $map = [$map[$classOption]];
            }

            foreach ($map as $class) {
                $this->comment("Migration check $class ...");
                $results = $class::migrate();
                foreach ($results as $result) {
                    $this->info($result);
                }
                $this->comment("Migration END.");
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
