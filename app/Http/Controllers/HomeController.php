<?php

namespace App\Http\Controllers;

use App\Box;
use App\Http\Requests;
use App\Lucky;
use App\UserAction;
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
    public function luckyDraw()
    {
        $lucky = DB::table('lucky')
            ->select('lucky.*')
            ->where('jenis', 0)
            ->whereNull('deleted_at')
            ->get();
        $lucky2 = DB::table('lucky')
            ->select('lucky.*')
            ->where('jenis', 1)
            ->whereNull('deleted_at')
            ->get();
        return view('lucky_draw', compact('lucky', 'lucky2'));
    }

    public function getUsersByClass($id)
    {
        $users_get = DB::table('class')
            ->join('users', 'users.id', '=', 'class.users_id')
            ->select('users.*', 'class.topics_title')
            ->where('class.topics_title', $id)
            ->get();
        return response()->json(['status' => "success", 'response' => $users_get]);
        return $users_get;
    }

    public function boxPage()
    {
        $box = DB::table('box')
            ->select('box.*')
            ->whereNull('deleted_at')
            ->get();
        return view('box_page', compact('box'));
    }

    public function saveClassLucky(Request $request)
    {
        $masuk_query[] =
            [
                'created_at' => now(),
                'updated_at' => now(),
                'kelas' => $request->kelas,
                'jml_kel' => $request->jml_kel,
                'jenis' => $request->jenis,
                'detail' => json_encode($request->detail)
            ];

        DB::table('lucky')->insert($masuk_query);
        if ($request->ajax()) {
            $lucky = DB::table('lucky')
                ->select('lucky.*')
                ->where('jenis', $request->jenis)
                ->whereNull('deleted_at')
                ->get();

            return json_encode($lucky);
        }
    }

    public function destroyLucky(Request $request)
    {
        $flight = Lucky::where('kelas', $request->kelas)->first();
        $question = Lucky::findOrFail($flight->id);
        $question->delete();
        if ($request->ajax()) {
            $lucky = DB::table('lucky')
                ->select('lucky.*')
                ->whereNull('deleted_at')
                ->where('jenis', $flight->jenis)
                ->get();

            return json_encode($lucky);
        }
    }

    public function saveClassBox(Request $request)
    {
        $masuk_query[] =
            [
                'created_at' => now(),
                'updated_at' => now(),
                'materi' => $request->materi,
                'detail' => json_encode($request->detail)
            ];

        DB::table('box')->insert($masuk_query);
        if ($request->ajax()) {
            $lucky = DB::table('box')
                ->select('box.*')
                ->whereNull('deleted_at')
                ->get();

            return json_encode($lucky);
        }
    }

    public function destroyBox(Request $request)
    {
        $flight = Box::where('materi', $request->materi)->first();
        $question = Box::findOrFail($flight->id);
        $question->delete();
        if ($request->ajax()) {
            $lucky = DB::table('box')
                ->select('box.*')
                ->whereNull('deleted_at')
                ->get();

            return json_encode($lucky);
        }
    }


}
