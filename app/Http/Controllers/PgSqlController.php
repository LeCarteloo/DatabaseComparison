<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PgSqlController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::connection('pgsql')->select('select * from users where active = ?', [1]);


        $msc = microtime(true);

        //Informacje o pracownikach
        $select1 = DB::connection('pgsql')->select(
            'SELECT * 
            FROM employees
        ');

        //Informacje o pracowniku i jego wynagrodzeniach
        $select2 = DB::connection('pgsql')->select(
            'SELECT * 
            FROM employees e, salaries s
            WHERE e.id = 1
            AND e.id = s.employee_id
        ');
   

        //Ile wypłat dostał pracownik i jaką największą
        $select3 = DB::connection('pgsql')->select(' 
            SELECT first_name, last_name, X.*
            FROM employees E, (
            SELECT employee_id, COUNT(*) as salaries, MAX(salary) as max_salary
            FROM salaries
            GROUP BY employee_id) X
            WHERE E.id = X.employee_id
        ');

        //Pierwszy tytuł
        $select4 = DB::connection('pgsql')->select(' 
            SELECT first_name, last_name, X.*, Y.*
            FROM employees E, (
            SELECT employee_id, COUNT(*) as salaries, MAX(salary) as max_salary
            FROM salaries
            GROUP BY employee_id) X, (
            SELECT employee_id, title
            FROM titles
            ORDER BY employee_id DESC) Y
            WHERE E.id = X.employee_id
            AND E.id = Y.employee_id
        ');

        //Usuwanie
        $delete = DB::connection('pgsql')->select(
            'DELETE 
            FROM employees 
            WHERE id > 1
            AND id < 11;
        ');

        //Update
        $update = DB::connection('pgsql')->select(
            "UPDATE titles
            SET title = 'manager'
            WHERE employee_id > 11
            AND employee_id < 110 ;
        ");

        //Insert
        $insert = DB::connection('pgsql')->select(
            "INSERT INTO employees
            (birth_date, first_name, last_name, gender, hire_date)
            VALUES
            ('1998-05-04', 'Jacek', 'Mial', 'M', '2009-04-05');
        ");


       $total_diff = microtime(true) - $msc;

      


        //odpala wszystkie zapytania 
        return view('testpgsql', [
            'select1' => $select1,
            'select2' => $select2,
            'select3' => $select3,
            'select4' => $select4,
            'delete' => $delete,
            'update' => $update,
            'insert' => $insert,
            'time' => round($total_diff, 1000 -1.1, 2),
        ]);
    }
}
