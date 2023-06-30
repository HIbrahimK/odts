<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return $this->getLessons();
        }
        //dd(Auth::user()->school->il_adi);
        return view('lessons.index');
    }
    private function getLessons()
    {


            $data =  Lesson::get();


        return DataTables::of($data)
            ->addColumn('name', function($row){
                return ucfirst($row->name);
            })

            ->addColumn('action', function($row){
                $action = "";
                $action.="<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('lessons.edit', $row->id)."'><i class='fas fa-edit'></i></a>";
                $action.=" <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
                return $action;
            })
            ->rawColumns(['name', 'action'])
            ->make('true');
    }
    public function store(Request $request, Lesson $lesson)
    {
        $this->validate($request, [

            'name'=>"required|unique:lessons"
        ]);

        $lesson->create($request->all());

        if($lesson)
        {
            toast('Yeni Ders Eklendi.','success');
            return Redirect::to('lessons');
        }
        toast('Error Creating New User','error');
        return back()->withInput();
    }

    public function destroy(Request $request, Lesson $lesson)
    {
        if ($request->ajax() && $lesson->delete()) {
            return response(["message" => "Ders Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }
    public function edit(Lesson $lesson)
    {
        return view('lesson.edit')->with(['lesson' => $lesson]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Lesson $lesson, Request $request)
    {
        $this->validate($request, [

            'name'=>"required|unique:lessons"
        ]);
        $lesson->update($request->only('name'));
        if ($lesson) {
            toast('Ders başarı İle Güncelleştirildi.', 'success');
            return view('lessons.index');
        }
        toast('Güncelleştirme Problemi Oluştu', 'error');
        return back()->withInput();
    }
}
