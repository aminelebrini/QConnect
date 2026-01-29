<?php

    namespace App\Http\Repository;

    use App\Models\Favoris;
use App\Models\Question;

class QuestionRepository
{
    public function createQuestion($titre, $description, $user_id,$city)
    {
        $question = Question::create([
            'titre' => $titre,
            'description' => $description,
            'user_id' => $user_id,
            'city' => $city
        ]);

        $question->save();
        return $question;
    }

    public function Reigstre_Favoris($question_id, $user_id)
    {
        $favoris = Favoris::create([
            'user_id' => $user_id,
            'question_id' => $question_id,
        ]);

        $favoris->save();
        return $favoris;

    }
    public function delete($favoris_id)
    {
        $favoris = Favoris::find($favoris_id);
        $favoris->delete();
    }
}

?>
