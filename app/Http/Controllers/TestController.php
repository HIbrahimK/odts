<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return $this->getTest();
        }
        //dd(Auth::user()->school->il_adi);


        return view('tests.tests.index')->with(["tests"=>DB::table('tests')
            ->where('school_id',Auth::user()->school_id)
            ->where('type','=','TYT')
            ->orderBy('created_at', 'desc')->get()]);;

    }
    private function getTest()
    {
        $data = Test::where('school_id',Auth::user()->school_id)->get();
        return DataTables::of($data)
            ->addColumn('id', function($row){
                return ucfirst($row->id);
            })
            ->addColumn('name', function($row){
                return ucfirst($row->name);
            })
            ->addColumn('publisher', function($row){
                return ucfirst($row->publisher);
            })
            ->addColumn('test_date', function($row){
                return Carbon::parse($row->test_date)->format('d/m/Y');
            })
            ->addColumn('level', function($row){
                return ucfirst($row->level);
            })
            ->addColumn('type', function($row){
                return ucfirst($row->type);
            })
            ->addColumn('action', function($row){
                $action = "";
                $action.="<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('tests.edit', $row->id)."'><i class='fas fa-edit'></i></a>";
                $action.=" <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
                return $action;
            })
            ->rawColumns(['name', 'date','roles', 'action'])->make('true');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Test $test)
    {
        $this->validate($request, [
            'name' => "required",
            'publisher'=>"required",
            'test_date'=>"required",
            'level'=>"required",
            'type'=>"required",
            //'school_no'=>"required|unique:students,school_id,".$request->school_id
            //'school_no' => 'required|unique:students,school_no,NULL,id,school_id,'.$request->school_id.''
        ]);

        $test->create($request->all());

        if($test)
        {
            toast('Yeni Sınav Eklendi.','success');
            return Redirect::to('tests');
        }
        toast('Test Eklemede Hata Oluştu','error');
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('tests.tests.edit')
            ->with("tests", $test)
            ->with("tyts",DB::table('tests')
                ->where('school_id',Auth::user()->school_id)
                ->where('type','=','TYT')
                ->orderBy('created_at', 'desc')->get());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Test $test)
    {
        if($request->ajax() && $test->delete())
        {
            return response(["message" => "Deneme Başarıyla Silindi"], 200);
        }
        return response(["message" => "Silme Hatası Oluştu! Lütfen Tekrar Deneyin"], 201);
    }
}
