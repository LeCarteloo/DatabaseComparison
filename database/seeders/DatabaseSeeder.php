<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Title;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Nazwy baz (mysql, pgsql itd.) są brane z pliku config/database.php > connections

        //Komenda do migracji tabel wraz z danymi dla mysql
        //php artisan migrate --database="mysql" --seed

        //MySql seed
        $employee = Employee::factory()->connection('mysql')->count(100)->create();
        $salary = Salary::factory()->connection('mysql')->count(1000)->create();
        $title = Title::factory()->connection('mysql')->count(1000)->create();

        //Komenda do migracji tabel wraz z danymi dla pgsql
        //php artisan migrate --database="mysql" --seed

        //Pgsql seed
        $employee = Employee::factory()->connection('pgsql')->count(100)->create();
        $salary = Salary::factory()->connection('pgsql')->count(1000)->create();
        $title = Title::factory()->connection('pgsql')->count(1000)->create();


        // $employee = Employee::factory(100)->create();

        // $salary = Salary::factory(1000)->create();

        // $title = Title::factory(1000)->create();

        // for($i = 1; $i<100; $i++)
        // {
        //     $employee = Employee::factory()->create();

        //     $salary = Salary::factory(30)->create([
        //         'employee_id' => $employee->id,
        //     ]);
    
        //     $title = Title::factory(5)->create([
        //         'employee_id' => $employee->id,
        //     ]);
        // }

    }
}
