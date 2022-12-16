<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class PostController extends Controller
{
    public function allPosts(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'id',
            1 => 'name',
            2 => 'age',
            // 3 => '年齢',
            // 4 => '登録日',
            // 5 => '削除',

        );

        $totalDataRecord = Student::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = Student::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            // $search_text = $request->input('search.value');

            // $post_data =  Student::where('id', 'LIKE', "%{$search_text}%")
            //     ->orWhere('title', 'LIKE', "%{$search_text}%")
            //     ->offset($start_val)
            //     ->limit($limit_val)
            //     ->orderBy($order_val, $dir_val)
            //     ->get();

            // $totalFilteredRecord = Student::where('id', 'LIKE', "%{$search_text}%")
            //     ->orWhere('title', 'LIKE', "%{$search_text}%")
            //     ->count();
        }

        $data_val = array();
        if (!empty($post_data)) {
            foreach ($post_data as $post_val) {
                // $datashow =  route('posts_table.show', $post_val->id);
                // $dataedit =  route('posts_table.edit', $post_val->id);

                $postnestedData['id'] = $post_val->id;
                $postnestedData['name'] = $post_val->name;
                $postnestedData['age'] = $post_val->age;
                // $postnestedData['cr'] = date('j M Y h:i a', strtotime($post_val->created_at));
                // $postnestedData['options'] = "&emsp;<a href='{$datashow}'class='showdata' title='SHOW DATA' ><span class='showdata glyphicon glyphicon-list'></span></a>&emsp;<a href='{$dataedit}' class='editdata' title='EDIT DATA' ><span class='editdata glyphicon glyphicon-edit'></span></a>";
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
