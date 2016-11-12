<?php

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $users = array(
                [
                    'name' => 'Rey Philip Regis',
			        'email' => 'reyphilipregis@gmail.com',
			        'password' => bcrypt('secret'),
			        'remember_token' => str_random(10),
                ]
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            App\User::create($user);
        }

        Model::reguard();

        factory(App\User::class, 9)->create();
    }
}
