<?php

namespace App\Console\Commands\Core;

use Illuminate\Console\Command;
use App\Settings\MailSettings;
use Illuminate\Support\Facades\Mail;

class MailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mail-dev';

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
        try {
            if (config('app.env') !== 'production') {
                $settings = new MailSettings();
                $settings->mail_username = env('MAIL_USERNAME');
                $settings->mail_password = env('MAIL_PASSWORD');
                $settings->mail_port = (int)env('MAIL_PORT');
                $settings->mail_host = env('MAIL_HOST');
                $settings->mail_encryption = env('MAIL_ENCRYPTION');
                $settings->mail_from_address = env('MAIL_FROM_ADDRESS');
                $settings->mail_from_name = config('app.name');
                $settings->mail_catchall_enabled = (bool)env('MAILCATCHALL_ENABLED', true);
                $settings->mail_catchall_receiver = env('MAILCATCHALL_RECEIVER');
                if ($settings->save()) {
                    $this->info('Mail settings saved.');
                } else {
                    $this->error('Error occured while saving mail settings.');
                }
            } else {
                $this->error("Application runs in production mode!");
            }
            $this->log('completed', true);
        } catch (\Throwable $th) {
            $this->log($th->getMessage(), false);
            $this->error($th->getMessage());
        }
    }
}
