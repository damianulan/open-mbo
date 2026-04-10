<?php

namespace App\Console\Commands\Settings;

use App\Console\BaseCommand;
use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use App\Settings\MboSettings;
use App\Settings\NotificationSettings;
use App\Settings\ReportSettings;
use App\Settings\UserSettings;
use Illuminate\Support\Facades\DB;
use Throwable;

class SettingsMigrate extends BaseCommand
{
    /**
     * @var string
     */
    protected $signature = 'settings:migrate {--class=}';

    /**
     * @var string
     */
    protected $description = 'Migrate settings';

    public function handle(): void
    {
        $map = [
            'GeneralSettings' => GeneralSettings::class,
            'MboSettings' => MboSettings::class,
            'MailSettings' => MailSettings::class,
            'NotificationSettings' => NotificationSettings::class,
            'ReportSettings' => ReportSettings::class,
            'UserSettings' => UserSettings::class,
        ];
        $classOption = $this->option('class');

        try {
            DB::beginTransaction();
            if ($classOption) {
                $map = [$map[$classOption]];
            }

            foreach ($map as $class) {
                $this->comment("Migration check {$class} ...");
                $results = $class::migrate();
                foreach ($results as $result) {
                    $this->info($result);
                }
                $this->comment('Migration END.');
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
