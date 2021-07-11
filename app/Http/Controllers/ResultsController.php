<?php

namespace App\Http\Controllers;

use Auth;
use App\Test;
use App\TestAnswer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'show');
    }

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $results = Test::all()->load('user');
            foreach ($results as $key => $row) {
                // $masuk = $masuk.$row->topics_id."<br/>";
                $topic_name = DB::table('topics')
                    ->where('id', '=', $row->topics_id)
                    ->get();

                $question = DB::table('questions')
                    ->where('topic_id', '=', $row->topics_id)
                    ->count();
                $row['hitung'] = $question;
                foreach ($topic_name as $key => $value) {
                    // return($value->title);
                    $row['nama_topics'] =  $value->title; 
                }
                                   
            }
        }

        if (!Auth::user()->isAdmin()) {
            $results = DB::table('tests')->select('*')->where('user_id', '=', Auth::id())->get();
            // return($results);
            foreach ($results as $key => $row) {
                $topic_name = DB::table('topics')->select('*')
                    ->where('id', $row->topics_id)
                    ->get();
                    // return($topic_name[0]->title);
                $row->nama_topics =  $topic_name[0]->title;                    
            }

        }
        
        // return($results);
        return view('results.index', compact('results'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $test = Test::find($id)->load('user');
        if ($test) {
            $results = TestAnswer::where('test_id', $id)
                ->with('question')
                ->with('question.options')
                ->get()
            ;
        }
        // return($id);
        return view('results.show', compact('test', 'results', 'id'));
    }

    public function score(Request $request)
    {

        DB::table('tests')
            ->where('id', $request->id)
            ->update(['score' => $request->score]);
        $results = Test::all()->load('user');    
        return redirect('/results');
    }
}
