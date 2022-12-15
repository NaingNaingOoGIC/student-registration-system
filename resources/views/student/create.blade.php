@extends('layouts.app')

@section('content')
    <div class="container">        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow ">
                    <div class="card-header text-center">{{ __('生徒追加') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('create-new-student') }}">
                            @csrf
                            <div class="row mb-3"><label for="name"
                                    class="col-md-3 col-form-label offset-md-1">{{ __('名前') }}</label>
                                <div class="col-md-7">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror shadow" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3"><label for="rollno"
                                    class="col-md-3 col-form-label offset-md-1 ">{{ __('学生証番号') }}</label>
                                <div class="col-md-7">
                                    <input id="name" type="text"
                                        class="form-control @error('rollno') is-invalid @enderror shadow" name="rollno"
                                        value="{{ old('rollno') }}" autocomplete="rollno" autofocus>

                                    @error('rollno')
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
