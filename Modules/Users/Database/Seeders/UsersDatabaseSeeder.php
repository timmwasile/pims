<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use modules\Users\Entities\User;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        User::factory()->create([
            'name'=>'administrator',
            'email'=> 'admin@system.com',
            'username'=>'admin',
            'phone'=>'0652308217',
            'gender'=>'male',
            'is_admin'=>1,

        ])

        // $this->call("OthersTableSeeder");
    }
}
