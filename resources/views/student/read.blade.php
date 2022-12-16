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
                <div class="table-responsive studentTable">
                    <table id="studentList" class="table data-table">
                        <thead>

                            <th>番</th>
                            <th>学生証番号</th>
                            <th>名前</th>
                            <th>年齢</th>
                            <th>登録日</th>
                            <th>削除</th>
                        </thead>
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
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/read.js') }}"></script> --}}
    <script>
        
        $("#regDate").on('change', function() {
            var regDate = $("#regDate").val();
            $.ajax({
                type: 'get',
                url: '/dateSearch/',
                data: {
                    'regDate': regDate,
                },
                success: function(list) {

                    if (list !== null) {
                        createList(list.data);
                    }
                }
            });
        })

        function createList(data) {
            var table = $('#studentTable').DataTable();
            table.clear().draw();
            data.forEach((stu, index) => {
                table.row.add([`${index + 1}`, `${stu.name}`, `${stu.rollno}`, `${stu.age}`,
                    `${stu.register_date}`]).draw();

            });
        }
        $('#regDate').datepicker({
            beforeShow: function() {
                setTimeout(function() {
                    $('.ui-datepicker').css('z-index', 99999999999999);
                }, 0);
            },
            dateFormat: 'yy-mm-dd'
        });
        $("#message").fadeOut(3000);
        $('#studentList').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ url('allLists') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: "{{ csrf_token() }}"
                }
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "rollno"
                },
                {
                    "data": "name"
                },
                {
                    "data": "age"
                },
                {
                    "data": "register_date"
                },
                {
                    "render": function() {
                        return '<button class="btn btn-sm btn-outline-danger" type="button"' +
                            ' id="delBtn">  ' +
                            ' 削除 </button>';
                    }
                },
            ],
            // "ordering": false,
            // "info": true,
            // "lengthChange": false,
            language: {
                "info": "_START_ から _END_ まで _TOTAL_ 人の生徒を表示する",
                "infoEmpty": "",
                "emptyTable": "対象データが見つかりませんでした。",
                "paginate": {
                    "first": "初め",
                    "last": "終わり",
                    "next": "次へ",
                    "previous": "前へ"
                },
            }
        });
    </script>
@endsection
