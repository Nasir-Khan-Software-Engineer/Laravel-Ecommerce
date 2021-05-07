<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $name = array(

            'Md Nasir',
            'Md Sakib',
            'Md Noman',
            'Md Arafat',
            'Md Sabbir | Intradocint',
            'Md Priyo | Group-shell',
            'Md Mehedi | Banatechai',
            'Md Rokon',
            'Md Shejan',
            'Md Kamrul',
            'Md Jobair | Freelancepoint',
            'Demo Name'
        );

        $email =  array(

            'nasir@gmail.com',
            'sakib@gmail.com',
            'noman@gmail.com',
            'arafat@gmail.com',
            'intradocint@gmail.com',
            'group-shell@gmail.com',
            'banatechai@gmail.com',
            'rokon@gmail.com',
            'shejan@gmail.com',
            'kamrul@gmail.com',
            'freelancepoint@gmail.com',
            'demo@gmail.com',
        );

        for($i=0;$i<12;$i++){

            $user = new User;
            $user->name                     = $name[$i];
            $user->email                    = $email[$i];
            $user->phone                    = "01637017926";
            $user->password                 = Hash::make("22222222");
            $user->un_hash_password         = "22222222";
            $user->type                     = 'admin'; // default
            $user->designation              = 'admin'; // default
            $user->permissions              = 'all';
            $user->permission_description   = "seed created";
            $user->save();

        }


        $user = new User;
        $user->name                     = "Admin";
        $user->email                    = "admin@gmail.com";
        $user->phone                    = "01637017926";
        $user->password                 = Hash::make("11112222");
        $user->un_hash_password         = "11112222";
        $user->type                     = 'admin'; // default
        $user->designation              = 'admin'; // default
        $user->permissions              = 'all';
        $user->permission_description   = "seed created";
        $user->save();


    }
}
