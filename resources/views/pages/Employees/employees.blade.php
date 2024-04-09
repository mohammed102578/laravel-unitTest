@extends('layouts.master')
@section('css')
<style>
    table {
        border-collapse: separate;
        border-spacing: 1;
        border: 1px solid #ddd;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
</style>
@toastr_css
@section('title')
{{ trans('Employees_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('main_trans.Employees') }}
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

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Employees_trans.add_Employee') }}
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="EmployeeDataTable"  class="display" style="border-spacing: 1px;">
                    <thead>
                    <tr>
                                <th>#</th>
                                <th>{{ trans('Employees_trans.Name') }}</th>
                                <th>{{ trans('Employees_trans.Company_name') }}</th>
                                <th>{{ trans('Employees_trans.Email') }}</th>
                                <th>{{ trans('Employees_trans.Phone') }}</th>
                                <th>{{ trans('Employees_trans.Actions') }}</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_Employee -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Employees_trans.add_Employee') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="first_name_ar" class="mr-sm-2">{{ trans('Employees_trans.first_name_ar') }}
                                    :</label>
                                <input id="first_name_ar" type="text" name="first_name_ar" class="form-control">
                            </div>
                            <div class="col">
                                <label for="first_name_en" class="mr-sm-2">{{ trans('Employees_trans.first_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="first_name_en">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="last_name_ar" class="mr-sm-2">{{ trans('Employees_trans.last_name_ar') }}
                                    :</label>
                                <input id="last_name_ar" type="text" name="last_name_ar" class="form-control">
                            </div>
                            <div class="col">
                                <label for="last_name_en" class="mr-sm-2">{{ trans('Employees_trans.last_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="last_name_en">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="phone" class="mr-sm-2">{{ trans('Employees_trans.Phone') }}
                                    :</label>
                                <input id="phone" type="text" name="phone" class="form-control">
                            </div>
                            <div class="col">
                                <label for="email" class="mr-sm-2">{{ trans('Employees_trans.Email') }}
                                    :</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>





                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('Employees_trans.Company_name') }}
                                :</label>
                            <select class="form-control" style="height:60px" name="company_id">
                                <option>{{trans('Employees_trans.select_company')}}</option>
                                @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
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

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection