<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reponse;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashController extends Controller
{

    public function index()
    {
        $question = Question::all();
        $reponses = Reponse::all();
        $users = User::where('role', 'user')->get();

        return view('admindash',
        [
            'title' => "Admin Dashboard",
            'questions' => $question,
            'reponses' => $reponses,
            'users' => $users,
        ]);
    }
}
