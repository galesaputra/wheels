<?php

namespace App\Http\Controllers;

use App\Uploads;
use App\UploadsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUploadsRequest;
use App\Http\Requests\UpdateUploadsRequest;
use Image;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UploadsController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        $this->middleware('admin');
        //DEFINISIKAN PATH
        $this->path = storage_path('app/public/files');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['350'];
    }

    /**
     * Display a listing of Uploads.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_id == 1){
            $uploads = DB::table('uploads')
                ->join('users', 'users.id', '=', 'uploads.user_id')
                ->select('users.name as name','uploads.*')
                ->whereNull('uploads.deleted_at')
                ->get();

        }
        else{
            $uploads = DB::table('uploads')
                ->join('users', 'users.id', '=', 'uploads.user_id')
                ->select('users.name as name' ,'uploads.*')
                ->where('uploads.user_id',auth()->user()->id)
                ->whereNull('uploads.deleted_at')
                ->get();
        }

        return view('uploads.index', compact('uploads'));
    }

    /**
     * Show the form for creating new Uploads.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created Uploads in storage.
     *
     * @param  \App\Http\Requests\StoreUploadsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUploadsRequest $request)
    {

        $file = $request->file('files');
        $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalName();
        // File upload location
        $location = 'files';

        // Upload file
        $file->move($location,$filename);

        // File path
        $filepath = 'files/'.$filename;

        $request->request->set('file', $filepath);
        Uploads::create($request->all());

        return redirect()->route('uploads.index');
    }


    /**
     * Show the form for editing Uploads.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $uploads = Uploads::findOrFail($id);

        return view('uploads.edit', compact('uploads'));
    }

    /**
     * Update Uploads in storage.
     *
     * @param  \App\Http\Requests\UpdateUploadsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUploadsRequest $request, $id)
    {
        $question = Uploads::findOrFail($id);



        $file = $request->file('files');
        if ($file) {
            File::delete($question->file);
            $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalName();
            // File upload location
            $location = 'files';

            // Upload file
            $file->move($location, $filename);

            // File path
            $filepath = 'files/' . $filename;

            $request->request->set('file', $filepath);
        }
        else{
            $request->request->set('file', $question->file);
        }
        $question->update($request->all());

        return redirect()->route('uploads.index');
    }


    /**
     * Display Uploads.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $question = Uploads::findOrFail($id);

        return view('uploads.show', compact('question') + $relations);
    }


    /**
     * Remove Uploads from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Uploads::findOrFail($id);
//        File::delete($question->file);
        $question->delete();

        return redirect()->route('uploads.index');
    }

    /**
     * Delete all selected Uploads at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Uploads::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
