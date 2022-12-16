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
                                <button type="submit" id="delConfirm" class="btn btn-sm my-btn me-2"
                                    id="deleteBtn">はい</button>
                                <button type="button" class="btn btn-sm my-btn-outline"
                                    data-bs-dismiss="modal">いいえ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/read.js') }}"></script>
@endsection
