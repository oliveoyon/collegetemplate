<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Setting;

class UpdateConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:update-config-command';
    protected $signature = 'config:update';
    protected $description = 'Update custom configuration file based on settings in the database';


    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all settings from the database
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        // Specify the path to your custom configuration file
        $filePath = config_path('custom.php');

        // Convert settings array to PHP code
        $phpCode = '<?php return ' . var_export($settings, true) . ';';

        // Delete the existing file (if it exists)
        File::delete($filePath);

        // Write the new configuration file
        File::put($filePath, $phpCode);

        $this->info('Custom configuration file updated successfully.');
    }
}
