@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card shadow">
            <div class="card-header header-bg text-white">
                生徒一覧
            </div>
            <div class="card-body bg-white">
                <div class="row mb-3 d-flex justify-content-end">
                    <label for="body" class="col-md-4 col-form-label text-md-end">検索</label>

                    <div class="col-md-3">
                        <input id="search" type="text" class="form-control" name="search" value="{{ old('search') }}"
                            autocomplete="search" id="search">
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
                <div class="searchError text-center text-danger"></div>
            </div>
        </div>
    </div>

    <div class="modal fade deleteModal" id="" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header header-bg d-flex justify-content-center text-white">
                    <h1 class="modal-title fs-5 p-0 m-0">削除</h1>
                </div>

                <div class="modal-body">

                    <form id="delForm" method="POST" action="/del-student/">
                        @csrf
                        <div class="text-center my-3">本当に削除しますか？</div>
                        <input type="hidden" value="" name="delRollno" id="delId">
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" id="delConfirm" class="btn btn-sm my-btn me-2" id="deleteBtn">はい</button>
                            <button type="button" class="btn btn-sm my-btn-outline" data-bs-dismiss="modal">いいえ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // $('.input-daterange input').each(function() {
            //     $(this).datepicker('clearDates');
            // });
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
                ]
            });


            $('input').datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShow: function() {
                    setTimeout(function() {
                        $('.ui-datepicker').css('z-index', 99999999999999);
                    }, 0);
                }
            });
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var createdAt = data[0] || 0; // Our date column in the table
                if (
                    (min == "" || max == "") || (moment(createdAt).isSameOrAfter(min) && moment(createdAt)
                        .isSameOrBefore(max))) {
                    return true;
                }
                return false;
            });
            $("input").on('change', function() {
                $(this).val();
                console.log($(this).val());
            })
            // $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            //     var min = $('#min-date').val();
            //     var max = $('#max-date').val();
            //     var createdAt = data[0] || 0; // Our date column in the table
            //     if (
            //         (min == "" || max == "") || (moment(createdAt).isSameOrAfter(min) && moment(createdAt)
            //             .isSameOrBefore(max))) {
            //         return true;
            //     }
            //     return false;
            // });
            // Re-draw the table when the a date range filter changes
            // $('.date-range-filter').change(function() {
            //     $('#records').DataTable().draw();
            // });

            $('#studentList').on('click', '#delBtn', function() {
                $('.deleteModal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                console.log(data[1].length);
                console.log(data[1]);

                $('#delId').val(data[1]);
            });
        });
    </script>
@endsection
