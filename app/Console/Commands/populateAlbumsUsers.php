<?php

namespace App\Console\Commands;

use App\Models\Album;
use Illuminate\Console\Command;

class populateAlbumsUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:populate-albums-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Temporary command to associate all existing albums to my user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // for each album in the database
        foreach (Album::all() as $album) {
            // associate the album to my user
            $album->users()->attach(1);

            // set the ALBUMS_USERS.last_played date to a random date in the past 3 years
            $album->users()->updateExistingPivot(1, [
                'last_played' => now()->subDays(rand(0, 1095)),
                'num_plays' => rand(1, 10),
            ]);
        }
    }
}
