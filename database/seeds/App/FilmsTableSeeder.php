<?php

use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('name', '=', env('ADMIN_NAME'))->first();

        /** FIRST FILM, WITH GENRE AND COMMENT. */
        $filmOne = new Film([
            'name' => 'Interstellar',
            'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
            'release_date' => '2014-11-07',
            'rating' => 5,
            'ticket_price' => 12.34,
            'country' => 'United States of America',
            'photo_url' => 'https://images-na.ssl-images-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SY1000_SX675_AL_.jpg'
        ]);
        $filmOne->save();
        $this->command->info("The movie '" . $filmOne->name . "' has been seeded.");
        $genreOne = Genre::where('name', '=', 'Thriller')->first();
        $filmOne->genres()->attach($genreOne->id);
        $this->command->info("The movie '" . $filmOne->name . "' has been assigned the genre '" . $genreOne->name ."'.");

        $filmOneComment = new Comment([
            'name' => $user->name,
            'comment' => '(((WOW)))...!!! It\'s almost impossible to put in words, but we have to try and give everyone what he truly deserve. In my modest opinion, Interstellar is the best Sci-Fi in human history. Believe it or not. It\'s the simple and the complicated, It\'s the usual and the different, It\'s the mind and the heart, It\'s an emotional and psychological journey through the unknown which has its own stunning visuals. It\'s an original story and thought-provoking masterpiece. Every single time with him, you just got crazy about his ideas, astonished by his mind games and inspired when he talks to the heart. Back then, he was an ambitious young director. And with his capabilities made his own way straight through the world. Now, he is an icon and a legend of directing. He is Christopher Nolan... Really guys, what\'s wrong with this guy ?!! what\'s going on inside his head ?!! It\'s our job to honor the honorable. Please, Just keep the rating UP, why ? Because Chris. and Interstellar deserve it.',
            'film_id' => $filmOne->id,
            'user_id' => $user->id
        ]);
        $filmOneComment->save();
        $this->command->info("The movie '" . $filmOne->name . "' has been assigned the comment with id '" . $filmOneComment->id ."'.");

        /** SECOND FILM, WITH GENRE AND COMMENT. */
        $filmTwo = new Film([
            'name' => 'Happy Gilmore',
            'description' => 'A rejected hockey player puts his skills to the golf course to save his grandmother\'s house.',
            'release_date' => '1996-02-16',
            'rating' => 4,
            'ticket_price' => 8.97,
            'country' => 'United States of America',
            'photo_url' => 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA4NjUxODg3Ml5BMl5BanBnXkFtZTcwNzcyODc5Mw@@._V1_.jpg'
        ]);
        $filmTwo->save();
        $this->command->info("The movie '" . $filmTwo->name . "' has been seeded.");
        $genreTwo = Genre::where('name', '=', 'Comedy')->first();
        $filmTwo->genres()->attach($genreTwo->id);
        $this->command->info("The movie '" . $filmTwo->name . "' has been assigned the genre '" . $genreTwo->name ."'.");

        $filmTwoComment = new Comment([
            'name' => $user->name,
            'comment' => 'Adam Sandler has a very funny movie here that works like no other since Caddyshack. Sandler plays a lazy guy who has to save his grandmother\'s house from being removed. So, he starts to play golf in a way that only Sandler can. He is also instructed by Carl Weathers (who memorably played Apollo Creed in Rocky), and wathcing his scenes I had to leave the theater from laughing so much (he had a wooden hand and it always gets knocked off). Sandler knows how to keep people rolling in the ailes, and this proves it. A++',
            'film_id' => $filmTwo->id,
            'user_id' => $user->id
        ]);
        $filmTwoComment->save();
        $this->command->info("The movie '" . $filmTwo->name . "' has been assigned the comment with id '" . $filmTwoComment->id ."'.");

        /** THIRD FILM, WITH GENRE AND COMMENT. */
        $filmThree = new Film([
            'name' => 'Alive',
            'description' => 'A Uruguayan rugby team stranded in the snow swept Andes are forced to use desperate measures to survive after a plane crash.',
            'release_date' => '1993-01-15',
            'rating' => 5,
            'ticket_price' => 10.67,
            'country' => 'United States of America',
            'photo_url' => 'https://images-na.ssl-images-amazon.com/images/M/MV5BOGU2ZjkzNTAtMGE0NS00N2RmLTg5YWItMDA5NjM4OWJlNWM3XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg'
        ]);
        $filmThree->save();
        $this->command->info("The movie '" . $filmThree->name . "' has been seeded.");
        $genreThree = Genre::where('name', '=', 'Action and Adventure')->first();
        $filmThree->genres()->attach($genreThree->id);
        $this->command->info("The movie '" . $filmThree->name . "' has been assigned the genre '" . $genreThree->name ."'.");

        $filmThreeComment = new Comment([
            'name' => $user->name,
            'comment' => 'The very concept that this film is based on a true story makes it great. When you watch it you can\'t help but wonder what you would do in their situation. You want to think that you wouldn\'t, but then you think of their situation. After watching this movie the whole cannibalism thing sticks in your head, but you really should look at the whole movie. It really is a great story and is uplifting. I know Roger Ebert doesn\'t think that this movie really shows, what it would be like to be stranded there for 70+ days, but I don\'t think any movie truly could. But Alive gets really close at doing that, they just keep getting in one bad situation after the other. It really shows how strong the human spirit is. I give it a 5/5!',
            'film_id' => $filmThree->id,
            'user_id' => $user->id
        ]);
        $filmThreeComment->save();
        $this->command->info("The movie '" . $filmThree->name . "' has been assigned the comment with id '" . $filmThreeComment->id ."'.");
    }
}
