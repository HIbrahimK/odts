<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Level;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$data = Student::find(1);

      //  dd($data->school->okul_adi);


        if($request->ajax())
        {
            return $this->getStudents();
        }
        //dd(Auth::user()->school->il_adi);

        return view('students.index');
    }
    private function getStudents()
    {
        if (Auth::user()->school_id == 100){
            $data =  Student::get();
        }
        else{
            $data =  Student::where('school_id',Auth::user()->school_id)->get();
        }


        return DataTables::of($data)
            ->addColumn('name', function($row){
                return ucfirst($row->name);
            })
            ->addColumn('lastname', function($row){
                return ucfirst($row->lastname);
            })
            ->addColumn('school_no', function($row){
                return ucfirst($row->school_no);
            })
            ->addColumn('tc', function($row){
                return ucfirst($row->tc);
            })
            ->addColumn('tel', function($row){
                return ucfirst($row->tel);
            })
            ->addColumn('foto', function($row){
                return ucfirst($row->foto);
            })
            ->addColumn('level_id', function($row){
                return ucfirst($row->level->level);
            })
            ->addColumn('sube', function($row){
                return ucfirst($row->level->name);
            })
            ->addColumn('school_id', function($row){
                return ucfirst($row->school->okul_adi);
            })

            ->addColumn('action', function($row){
                $action = "";
                $action.="<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('students.edit', $row->id)."'><i class='fas fa-edit'></i></a>";
                $action.=" <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
                return $action;
            })
            ->rawColumns(['action'])
            ->make('true');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siniflar = Level::get();
       return view('students.create',compact('siniflar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        //dd($request);
        $this->validate($request, [
            'name' => "required",
            'lastname'=>"required",
            //'school_no'=>"required|unique:students,school_id,".$request->school_id
            'school_no' => 'required|unique:students,school_no,NULL,id,school_id,'.$request->school_id.''
        ]);

        $student->create($request->all());

        if($student)
        {
            toast('Yeni Öğrenci Eklendi.','success');
            return Redirect::to('students');
        }
        toast('Öğrenci Eklemede Hata Oluştu','error');
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $siniflar = Level::where('school_id',Auth::user()->school_id)->get();
        return view('students.edit')->with(['student' => $student])->with(['siniflar'=>$siniflar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'name' => "required",
            'lastname'=>"required",
            //'school_no'=>"required|unique:students,school_id,".$request->school_id
            'school_no' => 'required|unique:students,school_no,school_no,id,school_id,'.$request->school_id.''
        ]);
        $student->update($request->all());
        if ($student) {
            toast('Öğrenci Başarıyla Güncellendi.', 'success');
            return view('student.index');
        }
        toast('Error on Updating role', 'error');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Student $student)
    {
        if ($request->ajax() && $student->delete()) {
            return response(["message" => "Öğrenci başarıyla Silindi"], 200);
        }
        return response(["message" => "Öğrenci Silmede Hata Oluştu tekrar Deneyiniz."], 201);
    }

    public function import(Request $request)
    {

        if (empty($request->file('file')))
        {
            return back()->with('error','custom message');
        }
        else{ request()->validate([
            'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
        ]);

           $pathTofile = $request->file('file')->store('temp');

            // Excel::import(new xxxImport,$request->file('file'));
            $import =  new StudentImport;
            $import->import($pathTofile); // we are using the trait importable in the xxxImport which allow us to handle it from the controller directly

           // dd($import->failures());
           // dd($import->failures());
            if($import->failures()->isNotEmpty()){
                $failures = $import->failures();
                dd($import->failures());
                return back()->with('failures', $failures);
            }
            return back()->with('success','Formations importées avec succès');

        }
        /*  $request->validate([
         'file' => 'required|mimes:csv,xlx,xls|max:2048'
     ]);
     $pathTofile = $request->file('file')->store('temp');

    // Excel::import(new StudentImport, $request->file('file')->store('temp'));
     $import =  new StudentImport;
     $import->import($pathTofile);
     if($import->failures()->isNotEmpty()){
         $failures = $import->failures();
         dd($import->failures());
         return back()->with('failures', $failures);
     }
     return back()->with('success', 'All good!');*/
    }
}
