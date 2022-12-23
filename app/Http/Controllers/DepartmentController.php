<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::orderBy('id', 'desc')->paginate(30);
        $trashdepartments = Department::onlyTrashed()->orderBy('id', 'desc')->paginate(30);
        // $departments = DB::table('departments')
        // ->join('users','departments.userids','users.id')
        // ->select('departments.*','users.name')->orderBy('id', 'desc')->paginate(5);

        return view('admin.department.index', compact('departments', 'trashdepartments'));
    }

    public function insert(Request $request){
        $request->validate(
        [
            'department_name'=>'required|unique:departments|max:10'
        ],
        [
            'department_name.required'=>"please fill the infomation.", "department_name.max"=>"do not fill character more than 255.",
            'department_name.unique'=>"Data duplicated.",
        ],);
        $department = new Department;
        $department-> department_name = $request->department_name;
        $department->userids = Auth::user()->id;
        $department->save();
        // dd($request->department_name);

        $data = array();
        $data["department_name"] = $request->department_name;
        $data["userids"] = Auth::user()->id;
        return redirect()->back()->with('success', 'Data has been save!');
    }

    public function edit($id){
        $department = Department::find($id);
        return view('admin.department.edit', compact('department'));
    }

    public function update(Request $request , $id){
        $request->validate(
            [
                'department_name'=>'required|unique:departments|max:10'
            ],
            [
                'department_name.required'=>"please fill the infomation.",
                "department_name.max"=>"do not fill character more than 255.",
                'department_name.unique'=>"Data duplicated.",
            ],);
        // dd($id, $request->department_name);
        $update = Department::find($id)->update([
            'department_name' => $request->department_name,
            'userids'=>Auth::user()->id
        ]);
        return redirect()->route('department')->with('success', 'Update Success');
    }

    public function softdelete($id){
        $delete = Department::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }

    public function restore($id){
        $restore = Department::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Restore Success');
    }

    public function delete($id){
        $delete = Department::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Permanence Delete Success');
    }
}
