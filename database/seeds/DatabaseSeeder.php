<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('attractions')->truncate();
        DB::table('photos')->truncate();
        DB::table('reviews')->truncate();

        $this->call(RolesTableSeeder::class);
        factory(App\User::class, 10)->create()->each(function ($user) {
            $attraction = $user->attractions()->save(factory(App\Attraction::class)->make());
            factory(App\Photo::class, 4)->create([
                'user_id' => $user->id,
                'attraction_id' => $attraction->id,
            ]);
//            $user->reviews()->save(factory(App\Review::class)->make(['attraction_id' => $attraction->id]));
        });

        $reviews = factory(App\Review::class, 30)->make();
        foreach ($reviews as $review)
        {
            repeat:
            try
            {
                $review->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $review = factory(App\Review::class)->make();
                goto repeat;
            }
        }

    }
}
