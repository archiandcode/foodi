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
        $folder = $this->option('folder') ?? $moduleName;

        $basePath = app_path("Modules/{$folder}");

        foreach ($this->moduleStructure as $subPath) {
            $dir = "{$basePath}/{$subPath}";
            File::ensureDirectoryExists($dir);
            $this->line("📁 Директория: {$dir}");
        }

        $modelPath = "{$basePath}/Models/{$moduleName}.php";
        $controllerPath = "{$basePath}/Http/Controllers/{$moduleName}Controller.php";
        $servicePath = "{$basePath}/Services/{$moduleName}Service.php";

        $this->createFile($modelPath, $this->getModelStub($moduleName, $folder), "Модель");
        $this->createFile($controllerPath, $this->getControllerStub($moduleName, $folder), "Контроллер");
        $this->createFile($servicePath, $this->getServiceStub($moduleName, $folder), "Сервис");

        $this->info("🎉 Модуль '{$moduleName}' успешно создан в 'Modules/{$folder}'");
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

    private function getModelStub(string $class, string $folder): string
    {
        return <<<PHP
<?php

namespace App\\Modules\\{$folder}\\Models;

use Illuminate\\Database\\Eloquent\\Model;

class {$class} extends Model
{
    //
}
PHP;
    }

    private function getControllerStub(string $class, string $folder): string
    {
        return <<<PHP
<?php

namespace App\\Modules\\{$folder}\\Http\\Controllers;

use App\\Http\\Controllers\\Controller;

class {$class}Controller extends Controller
{
    //
}
PHP;
    }

    private function getServiceStub(string $class, string $folder): string
    {
        return <<<PHP
<?php

namespace App\\Modules\\{$folder}\\Services;

class {$class}Service
{
    //
}
PHP;
    }
}
