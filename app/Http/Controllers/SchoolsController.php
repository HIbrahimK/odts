<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use DataTables;
class SchoolsController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->getSchools();
        }
        return view('schools.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        -
        $school = School::create();

        if ($school) {
            toast('New Role Added Successfully.', 'success');
            return view('schools.index');
        }
        toast('Error on Saving role', 'error');
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('schools.show')->with(['school' => $school]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('schools.edit')->with(['school' => $school]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(School $school, Request $request)
    {
        $this->validate($request, [
            'okul_adi' => 'required',
            'okul_website' => 'required',
        ]);
        $school->update($request->only('okul_adi'));
        if ($school) {
            toast('Role Updated Successfully.', 'success');
            return view('schools.index');
        }
        toast('Error on Updating role', 'error');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        if ($request->ajax() && $role->delete()) {
            return response(["message" => "Role Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }

    private function getschools()
    {
        $data =  School::get();
        //select(['id','okul_adi','il_adi','ilce_adi','okul_website','tip'])->get();


        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return ucfirst($row->id);
            })
            ->addColumn('okul_adi', function ($row) {
                return ucfirst($row->okul_adi);
            })
            ->addColumn('il_adi', function ($row) {
                return ucfirst($row->il_adi);
            })
            ->addColumn('ilce_adi', function ($row) {
                return ucfirst($row->ilce_adi);
            })
            ->addColumn('okul_website', function ($row) {
                return ucfirst($row->okul_website);
            })
            ->addColumn('tip', function ($row) {
                return ucfirst($row->tip);
            })
            ->addColumn('action', function ($row) {
                $action = "";
                $action .= "<a class='btn btn-xs btn-success' id='btnShow' href='" . route('schools.show', $row->id) . "'><i class='fas fa-eye'></i></a> ";
                $action .= "<a class='btn btn-xs btn-warning' id='btnEdit' href='" . route('schools.edit', $row->id) . "'><i class='fas fa-edit'></i></a>";
                $action .= " <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='" . $row->id . "'><i class='fas fa-trash'></i></button>";
                return $action;
            })
            ->make('true');
    }
}
