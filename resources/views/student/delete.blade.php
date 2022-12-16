@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-body ">
                <div class="table-responsive  ">
                    <table class="table table-borderd " id="deleteStudentTable">
                        <thead>
                            <tr>
                                <th>番</th>
                                <th>氏名</th>
                                <th>学生証番号</th>
                                <th>年齢</th>
                                <th>登録日</th>
                                <th>削除</th>
                            </tr>
                        </thead>
                        @php($i = 0)
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->rollno }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>{{ $student->register_date }}</td>
                                    <td>
                                        {{-- <input type="hidden" id="deleteId" value="{{$student->id}}"> --}}
                                        <button type="button" class="btn btn-outline-danger deleteBtn" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" value="{{ $student->id }}">
                                            {{ __('削除') }}
                                        </button>
                                        {{-- onclick="deleteFunction({{ $student->id }})" --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">確認</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title text-center w-100" id="exampleModalLabel">本当に削除しますか?</h5>
                </div>
                <div class="modal-footer">
                    <form id="delForm" method="POST" action="/delete-student">
                        @csrf
                        <input type="hidden" value="" name="delId" id="delId">
                        <button type="submit" id="delConfirm" class="btn btn-outline-danger">削除</button>
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">キャンセル</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/delete.js') }}"></script>
