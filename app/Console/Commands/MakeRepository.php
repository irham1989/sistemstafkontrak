<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates New Repository Class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $directory = app_path('Repositories');
        $path = $directory . "/{$name}.php";

        // Ensure the directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if (file_exists($path)) {
            $this->error('Repository already exists!');
            return;
        }

        $stub = $this->getStub();
        $content = str_replace('{{ class }}', $name, $stub);

        file_put_contents($path, $content);

        $this->info("Repository created successfully: {$name}");
    }

    protected function getStub()
    {
        return <<<EOT
        <?php

        namespace App\Repositories;

        class {{ class }}
        {
            // Add your repository methods here
        }
        EOT;
    }
}
