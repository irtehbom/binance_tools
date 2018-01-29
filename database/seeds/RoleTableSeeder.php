<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
  {
    $role_employee = new Role();
    $role_employee->name = 'Administrator';
    $role_employee->description = 'Binance Tools Administrator';
    $role_employee->save();
    
    $role_employee = new Role();
    $role_employee->name = 'Paying Member';
    $role_employee->description = 'Binance Tools Paying Member';
    $role_employee->save();
    
    $role_employee = new Role();
    $role_employee->name = 'Member';
    $role_employee->description = 'Binance Tools Member';
    $role_employee->save();
    
    $role_employee = new Role();
    $role_employee->name = 'Guest';
    $role_employee->description = 'Binance Tools Guest';
    $role_employee->save();

  }
}
