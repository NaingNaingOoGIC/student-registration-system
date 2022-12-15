@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="mb-1 mt-1d-flex justify-content-center" id="success">
                <p class="text-success text-center" id="message"> {{ session('success') }}</p>
            </div>
        @endif
        <div class="card shadow">
            <div class="card-body ">
                <div class="d-flex justify-content-end">
                    <div class="col-md-2">
                        <input class="form-control" type="text" placeholder="日付" aria-label="Date" id="regDate">
                    </div>
                </div>
                <div class="table-responsive  ">
                    <table class="table table-borderd " id="studentTable">
                        <thead>
                            <tr>
                                <th>番</th>
                                <th>氏名</th>
                                <th>学生証番号</th>
                                <th>年齢</th>
                                <th>登録日</th>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/read.js') }}"></script>
@endsection
