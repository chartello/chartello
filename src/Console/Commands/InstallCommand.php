<?php

namespace Chartello\Lite\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chartello:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Chartello resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Chartello Middleware...');
        $this->callSilent('vendor:publish', ['--tag' => 'chartello-middleware']);

        $this->comment('Publishing Chartello Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'chartello-assets', '--force']);

        $this->comment('Publishing Chartello Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'chartello-config']);

        $this->info('Chartello scaffolding installed successfully.');
    }
}