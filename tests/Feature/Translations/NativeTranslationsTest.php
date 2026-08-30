<?php

namespace Tests\Feature\Translations;

use Tests\TestCase;

class NativeTranslationsTest extends TestCase
{
    public function test_translations_are_loaded_from_default_laravel_language_files(): void
    {
        app()->setLocale('en');

        $this->assertSame('These credentials do not match our records.', __('auth.failed'));

        app()->setLocale('pl');

        $this->assertSame('Nie możemy odnaleźć użytkownika z takimi danymi', __('auth.failed'));
    }
}
