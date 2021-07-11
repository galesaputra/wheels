<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionsRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use Image;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        $this->middleware('admin');
        //DEFINISIKAN PATH
        $this->path = storage_path('app/public/images');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['350'];
    }

    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating new Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $question = [
            'questions' => \App\Question::get()->pluck('question_text', 'id')->prepend('Please select', ''),
        ];

        $correct_options = [
            'option1' => 'Option #1',
            'option2' => 'Option #2',
            'option3' => 'Option #3',
            'option4' => 'Option #4'
            // 'option5' => 'Option #5'
        ];

        return view('questions.create', compact('correct_options') + $relations + $question);
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionsRequest $request)
    {
        // if (!File::isDirectory($this->path)) {
        //     //MAKA FOLDER TERSEBUT AKAN DIBUAT
        //     File::makeDirectory($this->path);
        // }
        $file = $request->file('question_img');
        if ($file) {
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        // Image::make($file)->save($this->path . '/' . $fileName);

        //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
        //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
            
            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }
            
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $fileName);
        }
        // Image_uploaded::create([
        //     'name' => $fileName,
        //     'dimensions' => implode('|', $this->dimensions),
        //     'path' => $this->path
        // ]);
        // return($file->getClientOriginalName());

        // $file->move($tujuan_upload,$file->getClientOriginalName());
        $question = Question::create($request->all());
        $maxID = DB::table('questions')->max('id');
        DB::table('questions')->where('id', $maxID)->update(['img' => $fileName]);
        foreach ($request->input() as $key => $value) {
            if(strpos($key, 'option') !== false && $value != '') {
                $status = $request->input('correct') == $key ? 1 : 0;
                QuestionsOption::create([
                    'question_id' => $question->id,
                    'option'      => $value,
                    'correct'     => $status
                ]);
            }
        }
    }
    else{
        $question = Question::create($request->all());
        // $maxID = DB::table('questions')->max('id');
        // DB::table('questions')->where('id', $maxID)->update(['img' => $fileName]);
        foreach ($request->input() as $key => $value) {
            if(strpos($key, 'option') !== false && $value != '') {
                $status = $request->input('correct') == $key ? 1 : 0;
                QuestionsOption::create([
                    'question_id' => $question->id,
                    'option'      => $value,
                    'correct'     => $status
                ]);
            }
        }
    }
        

        return redirect()->route('questions.index');
    }


    /**
     * Show the form for editing Question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $question = Question::findOrFail($id);
        $a = QuestionsOption::select('*')
                           ->where('question_id', '=', $id)
                           // ->orderBy('correct', 'DESC')
                           ->get();
                           // return($a);
        $count = 0;
        // $pilihanPertanyaan[];
        $correct_options = array();
        foreach ($a as $key) {
            $pilihanPertanyaan[$count++] = $key->option;
            if ($key->correct > 0) {
                $c = [ $key->id => 'Option #'.$count];
            }else{
                $correct_options[$key->id] = 'Option #'.$count;
            }
        }
     
        $correct_options = $c+$correct_options;
        
        return view('questions.edit', compact('question', 'pilihanPertanyaan') + $relations, compact('correct_options'));
        // $option5 = "sadwadwa";
        // return ($pilihanPertanyaan[1]);                   
        // $pilihanJawaban = QuestionsOption::findOrFail($id);
        // return($a);
        // return ($piliha);
    }

    /**
     * Update Question in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionsRequest $request, $id)
    {
        // return($request->correct);
        $question = Question::findOrFail($id);
        $question->update($request->all());

        QuestionsOption::query()->update(['correct' => 0]);
        QuestionsOption::where('id', $request->correct)
                                ->update(['correct' => 1]);

                                

        return redirect()->route('questions.index');
    }


    /**
     * Display Question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $question = Question::findOrFail($id);

        return view('questions.show', compact('question') + $relations);
    }


    /**
     * Remove Question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index');
    }

    /**
     * Delete all selected Question at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Question::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
