# Repository Guidelines

## Project Structure & Module Organization
This is a Laravel 11 application that keeps the Laravel 10-style structure. Core backend code lives in `app/`, with HTTP concerns in `app/Http`, Livewire components in `app/Livewire`, domain models in `app/Models`, and supporting services, enums, DTOs, and policies in adjacent `app/*` namespaces. Routes are defined in `routes/web.php`, `routes/api.php`, and `routes/console.php`. Database migrations, factories, and seeders live in `database/`. Frontend source files are kept under `resources/themes`, while compiled assets are published to `public/themes`. Automated tests live in `tests/Feature` and `tests/Unit`.

## Build, Test, and Development Commands
- `composer install && npm install`: install PHP and frontend dependencies.
- `cp .env.example .env && php artisan key:generate`: create local configuration.
- `php artisan migrate --seed`: apply schema changes and load base data.
- `php artisan optimize:clear`: clear cached config, routes, and views after setup.
- `php artisan serve`: run the local Laravel server.
- `npm run dev` or `npm run watch`: compile Laravel Mix assets during development.
- `npm run prod`: build production assets.
- `php artisan test --compact`: run the full test suite.
- `vendor/bin/pint --dirty --format=agent`: format changed PHP files before opening a PR.

## Coding Style & Naming Conventions
Follow existing Laravel conventions and the local Pint rules in `pint.json`. Use 4-space indentation, short array syntax, explicit return types, and braces for all control structures. Match existing namespaces and keep class names descriptive, e.g. `CampaignUpdateTest`, `UserLocale`, `Notifications`. Put Livewire components in `app/Livewire/*` and Blade views in the matching `resources/views/*` location.

## Testing Guidelines
The project uses PHPUnit/Pest infrastructure with suites configured in `phpunit.xml`; tests currently follow class-based `*Test.php` naming. Prefer feature tests for HTTP, Livewire, database, and workflow behavior. The test environment uses in-memory SQLite, so keep fixtures factory-driven and deterministic. Run focused tests with `php artisan test --compact --filter=CampaignUpdateTest`.

## Commit & Pull Request Guidelines
Recent commits use short, direct subjects without prefixes, for example `dashboard fix` or `Filters form builder`. Keep commit messages concise and descriptive, and avoid mixing unrelated changes. PRs should include a clear summary, linked issue or task, testing notes, and screenshots for UI changes. Call out migrations, seed changes, or environment updates explicitly.

## Security & Configuration Tips
Never commit secrets or a populated `.env`. Keep environment access in config files, not application code. If frontend changes do not appear locally, rebuild assets with `npm run dev` or `npm run prod`.
