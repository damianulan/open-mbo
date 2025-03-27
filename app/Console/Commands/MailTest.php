<?php

namespace App\Console\Commands;

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
        if(config('app.env') !== 'production'){
            $settings = new MailSettings();
            $settings->mail_username = 'openmbo@damianulan.me';
            $settings->mail_password = '2D#tE!U/UP!s';
            $settings->mail_port = 465;
            $settings->mail_host = 'smtp.hostinger.com';
            $settings->mail_encryption = 'ssl';
            $settings->mail_from_address = 'openmbo@damianulan.me';
            $settings->mail_from_name = config('app.name');
            $settings->mail_catchall_enabled = true;
            $settings->mail_catchall_receiver = 'damian.ulan@protonmail.com';
            if($settings->save()){
                $this->info('Mail settings saved.');
            } else {
                $this->error('Error occured while saving mail settings.');
            }
        } else {
            $this->error("Application runs in production mode!");
        }
    }
}
