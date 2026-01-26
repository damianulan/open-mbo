<?php

namespace App\Console\Commands\Core;

use App\Console\BaseCommand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Spatie\TranslationLoader\LanguageLine;

class LangList extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:list {--nofile} {--group=} {--lang=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List language values';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('db:seed', ['--class' => 'LanguageSeeder']);
        $lang = $this->option('lang') ?? config('app.locale');
        $group = $this->option('group') ?? null;

        $query = LanguageLine::orderBy('group')->orderBy('key');
        if ( ! $this->option('nofile')) {
            $this->toFile($query);
        }
        if ($group) {
            $query->where('group', $group);
        }
        $langs = $query->get();

        $langs->each(function (LanguageLine $line) use ($lang): void {
            $text = $line->text[$lang] ?? '';
            $this->info($line->group . '.' . $line->key . ' => ' . $text);
        });
    }

    public function toFile(Builder $query): void
    {
        $output = [];

        $query->get()->each(function (LanguageLine $line) use (&$output): void {
            $text = $line->text[config('app.fallback_locale')] ?? '';
            $output[$line->group . '.' . $line->key] = $text;
        });

        $output = json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        File::put(base_path('lang/texts_to_translate.json'), $output);
    }
}
