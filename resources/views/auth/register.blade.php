@extends('layouts.app')

@section('content')
<script>
    $(function() {
        $('.jqueryOptions').hide();

        $('#role').change(function() {
            $('.jqueryOptions').slideUp();
            $('.jqueryOptions').removeClass('current-opt');
            $("." + $(this).val()).slideDown();
            $("." + $(this).val()).addClass('current-opt');
        });
    });
</script>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        border-radius: 5px;
        margin: 50px;
    }

    .child {

        margin: 0 auto;
    }

    .card-header {
        padding: 50px;
        text-align: center;
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 30px;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .flextime {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="child">
                <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}</div>

                <div class="card-body">
                    @isset($url)
                    <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                        @else
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @endisset
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('role') }}</label>


                                <div class="col-md-6">
                                    <div class="select-area">
                                        <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <option value=''>--select--</option>
                                            <option value="Nurse">Nurse</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Guardian">Guardian</option>
                                            <option value="Teacher">Teacher</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <section class="jqueryOptions Doctor">

                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                    <div class="col-md-6">
                                        <input id="gender" type="text" class="form-control" name="doctor_gender" value="{{ old('gender') }}">


                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="address" class="form-control" name="doctor_address" value="{{ old('address') }}">

                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                                    <div class="col-md-6">
                                        <input id="designation" type="text" class="form-control" name="doctor_designation" value="{{ old('designation') }}">

                                        @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('designation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                            </section>

                            <section class="jqueryOptions Teacher">
                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                    <div class="col-md-6">
                                        <input id="gender" type="text" class="form-control" name="teacher_gender" value="{{ old('gender') }}">


                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="address" class="form-control" name="teacher_address" value="{{ old('address') }}">

                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                            </section>

                            <section class="jqueryOptions Guardian">
                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                    <div class="col-md-6">
                                        <input id="gender" type="text" class="form-control" name="guardian_gender" value="{{ old('gender') }}">


                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Relation with Child') }}</label>

                                    <div class="col-md-6">
                                        <input id="relation" type="text" class="form-control" name="relation" value="{{ old('gender') }}">


                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="address" class="form-control" name="guardian_address" value="{{ old('address') }}">

                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                            </section>


                            <section class="jqueryOptions Nurse">
                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('gender') }}</label>

                                    <div class="col-md-6">
                                        <input id="gender" type="text" class="form-control" name="gender" value="{{ old('gender') }}">


                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="address" class="form-control" name="address" value="{{ old('address') }}">

                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </section>
                            @if ($errors->has('role'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                            @endif

                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
                </form>


            </div>
        </div>
    </div>
</div>
</div>
@endsection