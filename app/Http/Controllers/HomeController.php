<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use App\Question;
use App\Result;
use App\Test;
use App\User;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::count();
        $users = User::whereNull('role_id')->count();
        $quizzes = Test::count();
        $average = Test::avg('result');
        $results  =  User::select('role_id')
                    ->where('id', '=', Auth::id())
                    ->first();

        $class  =   DB::table('class')
                    ->where('users_id', '=', Auth::id())
                    ->where('taken', '=', NULL)
                    ->get();


                    // return($class);
        if($results->role_id == NULL || $results->role_id > 1){
            $topic = DB::table('topics')
                    ->where('semua', '=', "semua")
                    ->get();
                    // $topik = $topic;
                    // foreach ($topik as $key => $row) {
                    //     $class[] = 
                    //         array('topics_id' => $row->id,
                    //         'topics_title' => $row->title,
                    //         'text' => $row->title);
                    // }
                    // return($topic);
            return view('home_users', compact('questions', 'users', 'quizzes', 'average', 'class', 'topic'));
        }else{
            $jml_topic  = DB::table('topics')
                    ->select('*')
                    ->where("deleted_at", "=", NULL)
                    ->count();
            $jml_usr  =DB::table('users')
                    ->where('role_id', '!=', '1')
                    ->count();
            $jml_dsn  =DB::table('users')
                    ->where('role_id', '=', '1')
                    ->count(); 
            $jml_test  =DB::table('view_count_test')
                    ->select('count(DISTINCT(topic_id))')
                    ->where('deleted_at', '=', NULL)
                    ->count();                       
                    // return($jml_test);
            return view('home', compact('questions', 'users', 'quizzes', 'average', 'jml_topic', 'jml_usr', 'jml_dsn', 'jml_test'));
        }
    }
}
