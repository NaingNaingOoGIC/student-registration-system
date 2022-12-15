@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow ">
                    <div class="card-header text-center">{{ __('生徒更新') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update-student') }}">
                            @csrf

                            <div class="row mb-3"><label for="rollno"
                                    class="col-md-3 col-form-label offset-md-1 ">{{ __('学生証番号') }}</label>
                                <div class="col-md-7">
                                    <select class="form-select form-select-lg @error('rollno') is-invalid @enderror shadow"
                                        aria-label="Default select example" id="rollno" name="rollno"
                                        onchange="autoFill(this.value)" autofocus>
                                        <option selected value=''>選択してください。</option>
                                        @foreach ($students as $student)
                                            <option value={{ $student->rollno }}  {{ $student->rollno ==old('rollno') ? 'selected': '' }}> {{ $student->rollno }}</option>
                                        @endforeach
                                    </select>
                                    @error('rollno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3"><label for="name"
                                    class="col-md-3 col-form-label offset-md-1">{{ __('名前') }}</label>
                                <div class="col-md-7">
                                    <input id="name" type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror shadow"
                                        name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row"><label for="rollno"
                                    class="col-md-3 col-form-label offset-md-1 ">{{ __('年齢') }}</label>
                                <div class="col-md-7">
                                    <input id="age" type="text"
                                        class="form-control @error('age') is-invalid @enderror shadow" name="age"
                                        value="{{ old('age') }}" autocomplete="age" autofocus>

                                    @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="id" id="id"  value="{{ old('id') }}">
                            <div class="row mt-3">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-primary">
                                        {{ __('登録') }}
                                    </button>
                                    <input type="reset" class="btn btn-outline-success  btn-block" value="キャンセル">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    function autoFill(rollno) {
        $rollnumber = rollno;
        console.log($rollnumber)
        $.ajax({
            type: 'GET',
            url: "/rollSearch/",
            data: {
                'rollno': $rollnumber,
            },
            success: function(data) {
                $("#id").val(data.data[0].id);
                $("#name").val(data.data[0].name);
                $("#age").val(data.data[0].age);

            }
        });
    }
</script>
