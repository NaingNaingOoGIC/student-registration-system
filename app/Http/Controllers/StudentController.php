<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function read()
    {
        $data = Student::all();
        return view('student.list', [
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
    public function ajaxList(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'id',
            1 => 'rollno',
            2 => 'name',
            3 => 'age',
            4 => 'register_date',
        );

        $totalDataRecord = Student::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = Student::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            // $post_data =  Student::where('id', 'LIKE', "%{$search_text}%")
            //     ->orWhere('register_date', 'LIKE', "%{$search_text}%")
            //     ->offset($start_val)
            //     ->limit($limit_val)
            //     ->orderBy($order, $dir_val)
            //     ->get();

            // $totalFilteredRecord = Student::where('id', 'LIKE', "%{$search_text}%")
            //     ->orWhere('register_date', 'LIKE', "%{$search_text}%")
            //     ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            $i = 0;
            foreach ($post_data as $post_val) {

                $postnestedData['no'] = ++$i;
                $postnestedData['rollno'] = $post_val->rollno;
                $postnestedData['name'] = $post_val->name;
                $postnestedData['age'] = $post_val->age;
                $postnestedData['register_date'] = $post_val->register_date;
                $data_val[] = $postnestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );

        echo json_encode($get_json_data);
    }
}
