<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateAndImportWilayah extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:wilayah {--import : Import data wilayah setelah migrate:fresh}';


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
        $this->call('migrate:fresh');

        if ($this->option('import')) {
            $this->info('Importing wilayah data...');

            $password = $this->secret('Enter your MySQL root password');
            $command = "mysql -u root -p$password nexgen_hospital < " . base_path("database/data/wilayah_indonesia.sql");

            shell_exec($command);

            $this->info('Wilayah data imported successfully.');
        } else {
            $this->info('Skipped import wilayah.');
        }

        $this->info('Migrate fresh process done sir.');
    }
}
