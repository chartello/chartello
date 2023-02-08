<?php

namespace Chartello\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'chartello:install';

    protected $description = 'Install all of the Chartello resources';

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
