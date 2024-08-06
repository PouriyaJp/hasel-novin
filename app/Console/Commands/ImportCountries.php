<?php

namespace App\Console\Commands;

use App\Jobs\FetchCountriesJob;
use Illuminate\Console\Command;

class ImportCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-countries';

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
        FetchCountriesJob::dispatchSync();

        $this->info('Countries import job has been dispatched successfully!');
    }
}
