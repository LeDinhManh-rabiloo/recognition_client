<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * App install command class
 */
class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install
                {--force : Overwrite database they already exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Application';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!config('app.key') && file_exists(base_path('.env'))) {
            $this->info('Generate app key');
            $this->call('key:generate', ['--ansi']);
        }

        if ('local' === config('filesystems.default') && !file_exists(public_path('storage'))) {
            $this->info('Make storage symlink');
            $this->call('storage:link');
        }

        $this->info('Clear old optimizied files');
        $this->call('optimize:clear');

        $this->info('Migrate database');
        if ($this->option('force')) {
            $this->call('migrate:fresh', ['--force' => true]);
            $this->call('db:seed', ['--force' => true]);
        } else {
            $this->call('migrate', ['--force' => true]);
        }

        if ($this->getLaravel()->environment('local')) {
            $this->info('Generate dump database for development');
            // TODO: generate database for development
        }

        if ($this->getLaravel()->environment('production')) {
            $this->info('Make cache for speed running');
            $this->call('config:cache');
            // $this->call('route:cache');
            $this->call('view:cache');
        }
    }
}
