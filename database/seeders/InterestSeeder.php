<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Interest;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Don't run if interests table is not empty because
        // the name column is unique

        if (Interest::count() > 0) {
            return;
        }

        $interests = [
            'swimming', 'running', 'eating', 'reading', 'cycling', 'hiking', 'cooking', 'traveling',
            'gardening', 'fishing', 'painting', 'drawing', 'knitting', 'sewing', 'blogging', 'photography',
            'coding', 'gaming', 'listening to music', 'watching movies', 'dancing', 'yoga', 'meditation',
            'rock climbing', 'surfing', 'kayaking', 'skateboarding', 'skiing', 'snowboarding', 'skydiving',
            'horseback riding', 'archery', 'fencing', 'rowing', 'camping', 'backpacking', 'hunting',
            'birdwatching', 'collecting', 'volunteering', 'pottery', 'sculpting', 'magic', 'comedy',
            'theater', 'opera', 'ballet', 'choir singing', 'playing musical instruments', 'composing music',
            'board games', 'card games', 'puzzle solving', 'escape rooms', 'book club participation',
            'language learning', 'calligraphy', 'origami', 'astrology', 'astronomy', 'philosophy',
            'history', 'geography', 'psychology', 'sociology', 'political science', 'economics',
            'environmentalism', 'veganism', 'animal welfare activism', 'fitness training', 'martial arts',
            'boxing', 'wrestling', 'mixed martial arts', 'weightlifting', 'crossfit', 'pilates', 'spinning',
            'aerobics', 'Zumba', 'kickboxing', 'jujitsu', 'taekwondo', 'karate', 'judo', 'sumo wrestling',
            'cricket', 'football', 'soccer', 'basketball', 'baseball', 'tennis', 'golf', 'bowling',
            'billiards', 'chess', 'checkers', 'dominoes', 'car racing', 'motorcycle racing', 'bicycle racing'
        ];
        
        foreach ($interests as $interest) {
            Interest::create([
                "name" => $interest,
            ]);
        }

    }
}
