<?php

use Illuminate\Database\Seeder;
use App\Modules\Cms\Entities\Model\Categories;
use App\Modules\Cms\Entities\Model\Role;
use App\Modules\Cms\Entities\Model\User;
use App\Modules\Cms\Entities\Model\Game;
use App\Modules\Cms\Entities\Model\Tag;

class H5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {

            DB::table('h5_roles')->insert([
                'name' => $faker->name,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            $roleIds = Role::all()->pluck('id')->toArray();

            DB::table('h5_users')->insert([
                'appota_user_id' => random_int(1, $limit),
                'role_id' => $faker->randomElement($roleIds),
                'username' => $faker->userName,
                'password' => $faker->password,
                'email' => $faker->safeEmail,
                'fullname' => $faker->name,
                'birthday' => $faker->dateTime($max = 'now'),
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address,
                'avatar' => $faker->imageUrl($width = 1000, $height = 1000),
                'gender' => rand(1, 4),
                'register_date' => $faker->dateTime($max = 'now', $timezone = null),
                'register_ip' => $faker->ipv4,
                'last_activity' => $faker->slug,
                'is_moderator' => random_int(0, 1),
                'is_admin' => random_int(0, 1),
                'is_banned' => random_int(0, 1),
                'status' => random_int(0, 9),
                'expired_at' => $faker->dateTime($max = 'now'),
                'access_token' => $faker->sha256,
                'refresh_token' => $faker->sha256,
                'remember_token' => $faker->sha256,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            $userIds = User::all()->pluck('id')->toArray();

            DB::table('h5_categories')->insert([
                'name' => $faker->name,
                'slug' => $faker->slug,
                'order' => random_int(0, 9),
                'status' => random_int(0, 9),
                'parent_id' => random_int(1, $limit),
                'parent_slug' => $faker->slug,
                'description' => $faker->text($maxNbChars = 200),
                'cover' => $faker->imageUrl($width = 1000, $height = 1000),
                'icon' => $faker->imageUrl($width = 1000, $height = 1000),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            $categoryIds = Categories::all()->pluck('id')->toArray();

            DB::table('h5_games')->insert([
                'name' => $faker->name,
                'slug' => $faker->slug,
                'logo' => $faker->imageUrl($width = 1000, $height = 1000),
                'cover' => $faker->imageUrl($width = 1000, $height = 1000),
                'thumb_share' => $faker->imageUrl($width = 500, $height = 500),
                'description' => $faker->text($maxNbChars = 200),
                'publish_at' => $faker->dateTime($max = 'now'),
                'status' => random_int(1, 9),
                'viewed' => random_int(1, 1000),
                'played' => random_int(1, 1000),
                'is_trending' => random_int(1, $limit),
                'is_ghim' => random_int(1, $limit),
                'tags' => $faker->lastName,
                'link' => $faker->imageUrl($width = 1000, $height = 1000),
                'user_id' => $faker->randomElement($userIds),
                'category_id' => $faker->randomElement($categoryIds),
                'order' => random_int(1, 10000000),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            $gameIds = Game::all()->pluck('id')->toArray();

            DB::table('h5_game_track_play')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'user_id' => $faker->randomElement($userIds),
                'ip_address' => $faker->ipv4,
                'device_os' => $faker->asciify('OS ***'),
                'device_name' => $faker->lexify('***'),
                'os_version' => $faker->numerify('***'),
                'model_name' => $faker->bothify('Model ***'),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            DB::table('h5_game_track_score')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'user_id' => $faker->randomElement($userIds),
                'score' => random_int(0, 10000),
                'ip_address' => $faker->ipv4,
                'device_os' => $faker->asciify('OS ***'),
                'device_name' => $faker->lexify('***'),
                'os_version' => $faker->numerify('***'),
                'model_name' => $faker->bothify('Model ***'),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            DB::table('h5_game_track_view')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'ip_address' => $faker->ipv4,
                'device_os' => $faker->asciify('OS ***'),
                'device_name' => $faker->lexify('***'),
                'os_version' => $faker->numerify('***'),
                'model_name' => $faker->bothify('Model ***'),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            DB::table('h5_tags')->insert([
                'name' => $faker->title,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            $tagIds = Tag::all()->pluck('id')->toArray();

            DB::table('h5_game_tag')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'tag_id' => $faker->randomElement($tagIds),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            DB::table('h5_game_config_turn')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'user_id' => $faker->randomElement($userIds),
                'turn' => random_int(1, $limit),
                'expired_at' => $faker->dateTime($max = 'now'),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            DB::table('h5_accumulation_point')->insert([
                'user_id' => $faker->randomElement($userIds),
                'point' => random_int(1, 100000),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);

            DB::table('h5_config_score')->insert([
                'game_id' => $faker->randomElement($gameIds),
                'score' => random_int(1, 100000),
                'expired_at' => $faker->dateTime($max = 'now'),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);


        }
    }
}
