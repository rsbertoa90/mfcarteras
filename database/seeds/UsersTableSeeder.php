<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      $manager = new User();
      $manager->name = 'Pedidos online';
      $manager->email = 'pedidosonline@mfcarteras.com';
      $manager->password = bcrypt('online');
       $manager->role_id =1 ;
      $manager->save();

      $super = new User();
      $super->name = 'Gise';
      $super->email = 'roominagii@gmail.com';
      $super->password = bcrypt('roominagii');
      $super->role_id =1 ;
      $super->save();

      $super = new User();
      $super->name = 'Rodrigo';
      $super->email = 'rsbertoa90@gmail.com';
      $super->password = bcrypt('rsbertoa90');
      $super->role_id =1 ;
      $super->save();
   
    }
}
