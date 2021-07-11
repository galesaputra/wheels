<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;
use App\QuestionsOption;

class AjaxController extends Controller
{
    public function index(Request $request) {
    	$a = QuestionsOption::select('*')
		                   ->where('question_id', '=', $request->question_id)
		                   ->get();
		$b = Question::select('*')
		                   ->where('id', '=', $request->question_id)
		                   ->first();                   
		$pilihanPertanyaan = array();
		$count = 0;
       	foreach ($a as $key) {
       	$pilihanPertanyaan[$count++] = $key->option;
       	if ($key->correct > 0) {
       		$correct = "option".$count;
       	}
       	// echo $key['option'];
       }
       // return ($pilihanPertanyaan, $correct);
      // return $request->get('question_id');
		                   // return($a);
		 return response()->json(['quer'=>$pilihanPertanyaan, 'jawaban'=>$correct, 'text'=>$b->question_text, 'answer'=>$b->answer_explanation]);
      // return response()->json(array('msg'=> $msg), 200);
   }
}
