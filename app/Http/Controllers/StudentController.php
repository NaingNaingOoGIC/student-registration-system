<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function read()
    {
        $data = Student::all();
        return view('student.read', [
            'students' => $data
        ]);
    }
    public function add()
    {
        return view('student.create');
    }
    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'rollno' => ['required', 'unique:students'],
            'age' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $stu = new Student;
        $stu->name = request()->name;
        $stu->rollno = request()->rollno;
        $stu->age = request()->age;
        $stu->register_date = date('Y-m-d');
        $stu->save();
        return redirect('view-all-students')->with('success', '正常に登録しました。');
    }
    public function edit()
    {
        $data = Student::latest()->get(["id", "rollno"]);
        return view('student.update', [
            'students' => $data
        ]);
    }

    public function getInfo(Request $request)
    {
        $student = Student::filter($request->all())->get();
        return response()->json(['data' => $student]);
    }
    public function update(Request $request)
    {
        $student = Student::find($request->id);
        $data = request()->validate([
            'name' => 'required',
            'rollno' => 'required',
            'age' => ['required', 'numeric'],
        ]);
        $student->update($data);
        return redirect('view-all-students')->with('success', '正常に更新しました。');
    }
    public function remove()
    {
        $data = Student::all();
        return view('student.delete', [
            'students' => $data
        ]);
    }
    public function delete()
    {
        $student = Student::find(request()->delId);
        $student->delete();
        return redirect('view-all-students')->with('success', '正常に削除しました。');
    }
}
