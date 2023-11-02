<?php

namespace App\Http\Controllers;

use App\Imports\ResultImport;
use App\Models\Result;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ResultController extends Controller
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


        return view('tests.results.index')->with(["tests"=>DB::table('tests')
            ->where('school_id',Auth::user()->school_id)
            ->where('type','=','TYT')
            ->orderBy('created_at', 'desc')->get()]);;


        //return view('tests.results.index')->with((["tests"=>Test::where('school_id','=',Auth::user()->school_id)->orderBy('created_at', 'desc')->get()]));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('tests.results.edit')
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
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
    public function import()
    {

        $data = Excel::toArray(new ResultImport, request()->file('file-input'));

        return view('tests.results.edit', ['data' => ($data)]);

       // $path1 = $request->file('mcafile')->store('temp');
        //$path=storage_path('app').'/'.$path1;
        //$data = \Excel::import(new ResultImport,$path);
         //   return view('tests.results.edit', ['data' => $data]);



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
                $action.="<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('results.edit', $row->id)."'><i class='fas fa-edit'>Sonuç Yükle</i></a>";
                $action.="";
                return $action;
            })
            ->rawColumns(['name', 'date','roles', 'action'])->make('true');
    }


}
