<?php

namespace App\Http\Controllers;

use App\Topic;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTopicsRequest;
use App\Http\Requests\UpdateTopicsRequest;
use App\Http\Requests\UpdateUsersRequest;
use Illuminate\Support\Facades\DB;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating new Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('*')
                           ->where('role_id', '!=', '1')
                           ->get();
                           // return($users);
        return view('topics.create', compact('users'));
    }

    /**
     * Store a newly created Topic in storage.
     *
     * @param  \App\Http\Requests\StoreTopicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicsRequest $request)
    {

        Topic::insert([
                        'title' => $request->title,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'semua' => "semua"
                    ]);

        $maxIdTopic = Topic::find(\DB::table('topics')->max('id'));
        // echo $maxIdTopic['id'];


        // $e = explode(",", $request->idMahasiswa);
        // for ($i=0; $i < count($e)-1; $i++) { 
        //     DB::table('class')->insert([
        //         'users_id' => $e[$i],
        //         'topics_id' => $maxIdTopic['id'],
        //         'topics_title' => $request->title,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        // }


        // for ($i=0; $i < count($e); $i++) { 
        //     $usersTopic = User::select('topics')
        //                    ->where('id', '=', $e[$i])
        //                    ->first();
        //     $masukTopic = $maxIdTopic['id'].",".$usersTopic['topics'];
        //     User::where('id', $e[$i])
        //           ->update(['topics' => $masukTopic]);
        // }
        return redirect()->route('topics.index');
    }


    /**
     * Show the form for editing Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        return view('topics.edit', compact('topic'));
    }

    /**
     * Update Topic in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return($id);
        DB::table('topics')
              ->where('id', $id)
              ->update(['title' => $request->title]);
        // return $request;
        return redirect()->route('topics.index');
    }


    /**
     * Display Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        $klass = DB::table('class')
                     ->select(DB::raw('*'))
                     ->where('topics_id', '=', $id)
                     ->get();
        foreach ($klass as $key => $row) {
                    $nama = DB::table('users')
                     ->select(DB::raw('*'))
                     ->where('id', '=', $row->users_id)
                     ->get(); 
                     foreach ($nama as $n => $q) {
                        $row->nama =  $q->name;
                     }
                     
                    }            
                    // return($klass);
        return view('topics.show', compact('topic', 'klass'));
    }


    /**
     * Remove Topic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        $klass = DB::table('class')
                     ->where('topics_id', '=', $id)
                     ->delete();

        return redirect()->route('topics.index');
    }

    /**
     * Delete all selected Topic at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Topic::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
