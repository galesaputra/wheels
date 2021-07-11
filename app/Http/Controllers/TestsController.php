<?php

namespace App\Http\Controllers;

// use DB;
use Auth;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */

    public function class($topics_id)
    {
      $questions  =  DB::table('questions')
                    ->where('topic_id', '=', $topics_id)
                    ->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        return view('tests.create', compact('questions', 'topics_id'));
    }

    public function index()
    {
        // $topics = Topic::inRandomOrder()->limit(10)->get();
        // return(Auth::id());
        
        // $topic = Topic::where('users', 'like', Auth::id().'%')->get();
        // $results = DB::select('select * from class where ');
        $results  =  DB::table('class')
                    ->where('users_id', '=', Auth::id())
                    // ->sharedLock()
                    ->get();
        return($results);

        // panggil pertanyaan
        // $questions = Question::inRandomOrder()->limit(10)->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        /*
        foreach ($topics as $topic) {
            if ($topic->questions->count()) {
                $questions[$topic->id]['topic'] = $topic->title;
                $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
                shuffle($questions[$topic->id]['questions']['options']);
            }
        }
        */

        return view('tests.create', compact('questions'));
    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = 0;
        // return($request->topics_id);
        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
            'topics_id' => $request->topics_id
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if ($request->input('answers.'.$question) != null
                && QuestionsOption::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test->id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.'.$question),
                'correct'     => $status,
            ]);
        }

        $test->update(['result' => $result]);
        DB::table('class')->where(['users_id'=>Auth::id(),'topics_id'=>$request->topics_id])->update(['taken'=>'sudah']);

        return redirect()->route('results.show', [$test->id]);
    }
     
}
