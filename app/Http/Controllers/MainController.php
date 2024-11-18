<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function generateExercises(Request $request)
    {
        //form validation 
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction, check_miltiplication, check_division',
            'check_subtraction' => 'required_without_all:check_sum, check_miltiplication, check_division',
            'check_miltiplication' => 'required_without_all:check_sum, check_subtraction, check_division',
            'check_division' => 'required_without_all:check_sum, check_subtraction, check_miltiplication',
            'number_one' => 'required|integer|min:0|max:999|lt:number_two',
            'number_two' => 'required|integer|min:0|max:999',
            'number_exercises' => 'required|integer|min:5|max:50',
        ]);

        //get selected operations 
        $operations = [];
        $operations[] = $request->check_sum ? 'sum' : '';
        $operations[] = $request->check_subtraction ? 'subtraction' : '';
        $operations[] = $request->check_multiplication ? 'multiplication' : '';
        $operations[] = $request->check_division ? 'division' : '';

        //get numbers (min and max)
        $min = $request->number_one;
        $max = $request->number_two;

        //get number of exercices 
        $numberExercises = $request->number_exercises;

        //generate exercises 
        $exercises = [];
        for ($index = 1; $index <= $numberExercises; $index++) {
            $operation = $operations[array_rand($operations)];
            $number1 = rand($min, $max);
            $number2 = rand($min, $max);

            $exercise = '';
            $sollution = '';

            switch ($operation) {
                case 'sum':
                    $exercise = "$number1 + $number2 =";
                    $sollution = $number1 + $number2;
                    break;
                case 'subtraction':
                    $exercise = "$number1 + $number2 =";
                    $sollution = $number1 + $number2;
                    break;
                case 'multiplication':
                    $exercise = "$number1 + $number2 =";
                    $sollution = $number1 + $number2;
                    break;
                case 'division':
                    $exercise = "$number1 + $number2 =";
                    $sollution = $number1 + $number2;
                    break;
            }

            $exercises[] = [
                'exercise_number' => $index,
                'exercise' => $exercise,
                'sollution' => "$exercise $sollution"
            ];

        }

        dd($exercises);

    }

    public function printExercises()
    {
        echo "Imprimir exercícios no navegador";
    }

    public function exportExercises()
    {
        echo "Exportar exercícios para um arquivo de texto";
    }
}
