<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ViewCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View cached variables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $spotifyAccessToken = Cache::get('spotify_access_token');
        $this->info('Spotify Access Token: ' . $spotifyAccessToken);
    }
}