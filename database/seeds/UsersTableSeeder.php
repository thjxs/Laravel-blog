<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->makeVisible(['password', 'remember_toke'])->toArray());

        $user = User::find(1);
        $user->name = "a";
        $user->email ="a@mail.com";
        $user->password = bcrypt('a');
        $user->is_admin = true;
        $user->activated = true;
        $user->save();
    }
}
