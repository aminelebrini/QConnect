<?php

namespace App\Http\Controllers;

use App\Http\Services\QuestionService;
use App\Models\Favoris;
use App\Models\Question;
use Illuminate\Http\Request;
class QuestionController extends Controller
{
    private $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function Question()
    {
        $titre = request('titre');
        $description = request('description');
        $user_id = auth()->id();
        $city = request('city');

        if($this->questionService->createQuestion($titre, $description, $user_id,$city)) {
            return redirect()->route('affichage');
        }
    }

    public function Favoris()
    {
        $user_id = auth()->id();
        $question_id = request('question_id');
        $reponse_id = request('reponse_id');

        if($this->questionService->ReigstreFavoris($question_id, $user_id)) {
            return redirect()->route('affichage');
        }

    }

    public function delete()
    {
        $favoris_id = request('favid');

        if($this->questionService->delete($favoris_id)) {
            return redirect()->route('affichage');
        }
    }

    public function index()
    {
        $user = auth()->user();
        $search = request('search');
        $favoris = Favoris::with('question.reponses')->where('user_id', $user->id)->get();
        if ($search) {
            $questions = Question::where('titre', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->get();
        } else {
            $questions = Question::all();
        }

        return view('affichage', compact('questions','favoris'));

    }





}
