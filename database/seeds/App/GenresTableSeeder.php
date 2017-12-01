<?php

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        $actionAdventure = new Genre([
            'name' => "Action and Adventure"
        ]);
        $actionAdventure->save();
        $this->command->info("Genre '" . $actionAdventure->name . "' has been seeded.");

        $comedy = new Genre([
            'name' => "Comedy"
        ]);
        $comedy->save();
        $this->command->info("Genre '" . $comedy->name . "' has been seeded.");

        $thriller = new Genre([
            'name' => "Thriller"
        ]);
        $thriller->save();
        $this->command->info("Genre '" . $thriller->name . "' has been seeded.");
    }
}
