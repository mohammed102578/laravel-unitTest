@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('Employees_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('Employees_trans.edit_Employee') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    @if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
    @endif



    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <br><br>


                <!-- edit_modal_Grade -->
                <div class="card ">
                    <div class="card-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('Employees_trans.edit_Employee') }}
                        </h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('employees.update', $employee->id) }}" method="post">
                            {{ method_field('patch') }}
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <label for="first_name_ar" class="mr-sm-2">{{ trans('Employees_trans.first_name_ar') }}
                                        :</label>
                                    <input id="first_name_ar" type="text" name="first_name_ar" class="form-control" value="{{ $employee->getTranslation('first_name', 'ar') }}">
                                </div>
                                <div class="col">
                                    <label for="first_name_en" class="mr-sm-2">{{ trans('Employees_trans.first_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="first_name_en" value="{{ $employee->getTranslation('first_name', 'en') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="last_name_ar" class="mr-sm-2">{{ trans('Employees_trans.last_name_ar') }}
                                        :</label>
                                    <input id="last_name_ar" type="text" name="last_name_ar" class="form-control" value="{{ $employee->getTranslation('last_name', 'ar') }}">
                                </div>
                                <div class="col">
                                    <label for="last_name_en" class="mr-sm-2">{{ trans('Employees_trans.last_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="last_name_en" value="{{ $employee->getTranslation('last_name', 'en') }}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="phone" class="mr-sm-2">{{ trans('Employees_trans.Phone') }}
                                        :</label>
                                    <input id="phone" type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                                </div>
                                <div class="col">
                                    <label for="email" class="mr-sm-2">{{ trans('Employees_trans.Email') }}
                                        :</label>
                                    <input type="text" class="form-control" name="email" value="{{ $employee->email }}">
                                </div>
                            </div>





                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('Employees_trans.Employee_name') }}
                                    :</label>
                                <select class="form-control" style="height:60px" name="company_id">
                                    <option>{{trans('Employees_trans.select_employee')}}</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}" <?php
                                                                        if ($employee->company_id == $company->id) {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br><br>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Employees_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('Employees_trans.submit') }}</button>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection