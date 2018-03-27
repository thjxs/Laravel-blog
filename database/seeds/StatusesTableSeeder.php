<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = ['2', '3', '4'];

        //使用 app 方法 获取 Faker 容器实例
        $faker = app(Faker\Generator::class);

        $statuses = factory(Status::class)->times(100)->make()->each(function ($status) use ($faker, $user_ids) {
        	$status->user_id = $faker->randomElement($user_ids);
        });

        Status::insert($statuses->toArray());
    }
}
