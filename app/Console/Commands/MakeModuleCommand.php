<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModuleCommand extends Command
{
    protected $signature = 'make:module {moduleName} {--folder=}';
    protected $description = 'Создаёт модуль со структурой: модель, контроллер, сервис';

    protected array $moduleStructure = [
        'Models',
        'Http/Controllers',
        'Services',
    ];

    public function handle(): void
    {
        $originalName = $this->argument('moduleName');
        $moduleName = Str::studly(Str::singular($originalName));

        $folderOption = $this->option('folder') ?? $moduleName;

        // Путь и namespace, корректно обрабатывающий вложенность
        $folderPath = collect(explode('/', $folderOption))
            ->map(fn($part) => Str::studly($part))
            ->implode('/');
        $namespace = collect(explode('/', $folderOption))
            ->map(fn($part) => Str::studly($part))
            ->implode('\\');

        $basePath = app_path("Modules/{$folderPath}");

        foreach ($this->moduleStructure as $subPath) {
            $dir = "{$basePath}/{$subPath}";
            File::ensureDirectoryExists($dir);
            $this->line("📁 Директория: {$dir}");
        }

        $modelPath = "{$basePath}/Models/{$moduleName}.php";
        $controllerPath = "{$basePath}/Http/Controllers/{$moduleName}Controller.php";
        $servicePath = "{$basePath}/Services/{$moduleName}Service.php";

        $this->createFile($modelPath, $this->getModelStub($moduleName, $namespace), "Модель");
        $this->createFile($controllerPath, $this->getControllerStub($moduleName, $namespace), "Контроллер");
        $this->createFile($servicePath, $this->getServiceStub($moduleName, $namespace), "Сервис");

        $this->info("🎉 Модуль '{$moduleName}' успешно создан в 'Modules/{$folderPath}'");
    }

    protected function createFile(string $path, string $content, string $type): void
    {
        if (!File::exists($path)) {
            File::put($path, $content);
            $this->info("✅ {$type} создан: " . basename($path));
        } else {
            $this->warn("⚠️ {$type} уже существует: " . basename($path));
        }
    }

    private function getModelStub(string $class, string $namespace): string
    {
        return <<<PHP
<?php

namespace App\\Modules\\{$namespace}\\Models;

use Illuminate\\Database\\Eloquent\\Model;

class {$class} extends Model
{
    //
}
PHP;
    }

    private function getControllerStub(string $class, string $namespace): string
    {
        return <<<PHP
<?php

namespace App\\Modules\\{$namespace}\\Http\\Controllers;

use App\\Http\\Controllers\\Controller;

class {$class}Controller extends Controller
{
    //
}
PHP;
    }

    private function getServiceStub(string $class, string $namespace): string
    {
        return <<<PHP
<?php

namespace App\\Modules\\{$namespace}\\Services;

class {$class}Service
{
    //
}
PHP;
    }
}
