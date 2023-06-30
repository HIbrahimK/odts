<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class LevelController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return $this->getLevels();
        }
        //dd(Auth::user()->school->il_adi);
        return view('levels.index');
    }
    private function getLevels()
    {

        if (Auth::user()->school_id == 100){
            $data =  Level::get();
        }
        else{
            $data =  Level::where('school_id',Auth::user()->school_id)->get();
        }

        return DataTables::of($data)
            ->addColumn('level', function($row){
                return ucfirst($row->level);
            })
            ->addColumn('name', function($row){
                return ucfirst($row->name);
            })

            ->addColumn('action', function($row){
                $action = "";
                $action.="<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('levels.edit', $row->id)."'><i class='fas fa-edit'></i></a>";
                $action.=" <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
                return $action;
            })
            ->rawColumns(['level', 'name', 'action'])
            ->make('true');
    }
    public function store(Request $request, Level $level)
    {
        $this->validate($request, [
            'level' => "uniqueLevels:{$request->name}|required",
            'name'=>"required"
        ],
        [
        'level.uniqueLevels' => 'Aynı İsim ve Seviyede Sınıf Var',
        ]);

        $level->create($request->all());

        if($level)
        {
            toast('New User Created Successfully.','success');
            return Redirect::to('levels');
        }
        toast('Error Creating New User','error');
        return back()->withInput();
    }

    public function destroy(Request $request, Level $level)
    {
        if ($request->ajax() && $level->delete()) {
            return response(["message" => "Role Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }
    public function edit(Level $level)
    {
        return view('levels.edit')->with(['level' => $level]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Level $level, Request $request)
    {
        $this->validate($request, [
            'level' => "uniqueLevels:{$request->name}|required",
            'name'=>"required"
        ],
            [
                'level.uniqueLevels' => 'Aynı İsim ve Seviyede Sınıf Var',
            ]);
        $level->update($request->only('name'));
        if ($level) {
            toast('Sınıf başarı İle Güncelleştirildi.', 'success');
            return view('levels.index');
        }
        toast('Güncelleştirme Problemi Oluştu', 'error');
        return back()->withInput();
    }
}
