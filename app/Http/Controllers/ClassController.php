<?php

namespace App\Http\Controllers;

use App\Topic;
use App\User;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreTopicsRequest;
// use App\Http\Requests\UpdateTopicsRequest;
// use App\Http\Requests\UpdateUsersRequest;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
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

        return view('class.index', compact('topics'));
    }

    public function update(Request $request, $id)
    {
        // return($request);
        if ($request->nama_mahasiswa == "") {
            DB::table('class')->where('topics_id', $id)->delete();
            
            DB::table('topics')
                  ->where('id', $request->topics_id)
                  ->update(['title' => $request->title, 'semua' => 'semua']);
        }else{
            DB::table('class')->where('topics_id', $id)->delete();
            $id_mahasiswa = explode(",", $request->IdMahasiswa);
            // return($id_mahasiswa);
            $nama_mahasiswa = explode(",", $request->nama_mahasiswa);
            $masuk_query=[];
            for ($i=0; $i < count($id_mahasiswa) - 1; $i++) { 
                $masuk_query[] = 
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                        'users_id'  => $id_mahasiswa[$i],
                        'topics_id' => $request->topics_id,
                        'topics_title' => $request->title
                    ];
            }

            DB::table('class')->insert($masuk_query);
            DB::table('topics')
                  ->where('id', $request->topics_id)
                  ->update(['title' => $request->title, 'semua' => 'tidak']);
        }
        
        // return $request;
        return redirect()->route('class.index');
    }

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        // return($topic);
        $users = User::select('*')
                           ->where('role_id', '!=', '1')
                           ->get();
                           $masukk=[];
        foreach ($users as $key => $row) {
            $klass = DB::table('class')
                     ->select(DB::raw('*'))
                     ->where('users_id', '=', $row->id)
                     ->where('topics_id', '=', $id)
                     ->count();
                     if ($klass > 0) {
                            $row["pilih"] = "Display: none;";
                            $row["hapus"] = "Display: block;";
                      } 
                      else{
                            $row["pilih"] = "Display: block;";
                            $row["hapus"] = "Display: none;";
                      }
        }
        // return($users);
                           // return($users['role_id']);
        $class = DB::table('class')
                     ->select(DB::raw('*'))
                     ->where('topics_id', '=', $id)
                     ->get(); 
        $nama_users = "";
        $id_users = "";
        foreach ($class as $key => $row) {
                    $nama = DB::table('users')
                        ->where('id', '=', $row->users_id)->get();
                        // return($nama[0]->name);
                    $nama_users = $nama_users.$nama[0]->name.",";
                    $id_users = $id_users.$row->users_id.",";
                }                  
                // return($nama_users);
        return view('class.edit', compact('topic', 'users', 'id_users', 'id', 'nama_users'));
    }


}
