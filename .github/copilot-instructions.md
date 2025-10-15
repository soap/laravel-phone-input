# AI Coding Agent Instructions for Laravel Phone Input Package

## Package Architecture

This is a **Laravel package** built with [Spatie's Laravel Package Tools](https://github.com/spatie/laravel-package-tools). Key architectural components:

- **Service Provider**: `LaravelPhoneInputServiceProvider` extends `PackageServiceProvider` and uses the fluent `configurePackage()` method
- **Main Class**: `LaravelPhoneInput` (currently empty scaffold - implement phone input logic here)
- **Facade**: `LaravelPhoneInput` facade provides static access to the main class
- **Artisan Command**: `LaravelPhoneInputInstallCommand` for package installation workflow

## Development Patterns

### Package Structure Convention
Follow Laravel package standards:
- `src/` - Core package classes with PSR-4 autoloading (`Soap\LaravelPhoneInput\`)
- `config/phone-input.php` - Package configuration (published with `--tag="laravel-phone-input-config"`)
- `resources/views/` - Blade components/views (published with `--tag="laravel-phone-input-views"`)
- `database/migrations/` - Package migrations (`.stub` files, published with `--tag="laravel-phone-input-migrations"`)

### Service Provider Pattern
Use `Spatie\LaravelPackageTools\Package` fluent interface in `configurePackage()`:
```php
$package
    ->name('laravel-phone-input')
    ->hasConfigFile()
    ->hasViews()
    ->hasCommand(LaravelPhoneInputInstallCommand::class);
```

### Testing Setup
- **Test Framework**: Pest PHP (not PHPUnit) - use `composer test`
- **Test Base**: Extends `Orchestra\Testbench\TestCase` with package provider registration
- **Factory Namespace**: `Soap\LaravelPhoneInput\Database\Factories\` (auto-configured in TestCase)
- **Database**: Uses in-memory SQLite for testing (`testing` connection)

## Build & Quality Tools

### Commands
- `composer test` - Run Pest test suite
- `composer test-coverage` - Run tests with coverage report
- `composer analyse` - Run PHPStan static analysis (level 5)
- `composer format` - Format code with Laravel Pint

### Quality Standards
- **PHP Version**: ^8.4 (cutting-edge requirement)
- **Laravel Support**: ^11.0||^12.0
- **PHPStan Level**: 5 with Octane compatibility checks
- **Code Style**: Laravel Pint (automated formatting)
- **Architecture Testing**: Pest Arch plugin for structural rules

### PHPStan Configuration
Uses `phpstan.neon.dist` with baseline file (`phpstan-baseline.neon`) for incremental adoption. Key settings:
- Checks `src`, `config`, `database` directories
- Octane compatibility validation
- Model property validation
- Build artifacts in `build/phpstan`

## Development Workflow

### Package Installation Flow
1. `composer require soap/laravel-phone-input`
2. `php artisan laravel-phone-input:install` (custom install command)
3. Publish assets: migrations, config, views using respective `--tag` flags

### Adding Features
- **Blade Components**: Add to `resources/views/` and register in service provider
- **Config Options**: Extend `config/phone-input.php` with sensible defaults
- **Commands**: Create in `src/Commands/` and register via `hasCommand()` in service provider
- **Migrations**: Add `.stub` files to `database/migrations/` for user publishing

## Testing Conventions

- Use Pest syntax, not PHPUnit
- Test files inherit from `TestCase` automatically via `Pest.php`
- Mock external dependencies (phone validation APIs, etc.)
- Test both package functionality and Laravel integration (facades, commands, etc.)

## Key Dependencies

- **spatie/laravel-package-tools**: Core package scaffolding and service provider utilities
- **orchestra/testbench**: Laravel testing environment for packages
- **pestphp/pest**: Modern PHP testing framework with Laravel plugin
- **larastan/larastan**: PHPStan integration for Laravel-specific analysis