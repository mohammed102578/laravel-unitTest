@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('Companies_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('main_trans.Companies') }}
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
                    {{ trans('Companies_trans.add_Company') }}
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="TableCompany" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('Companies_trans.company_logo')}}</th>
                                <th>{{ trans('Companies_trans.Company_name') }}</th>
                                <th>{{ trans('Companies_trans.Email') }}</th>
                                <th>{{ trans('Companies_trans.website') }}</th>
                                <th>{{ trans('Companies_trans.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content will be populated dynamically by DataTables -->
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_Company -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Companies_trans.add_Company') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ trans('Companies_trans.name_ar') }}
                                    :</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ trans('Companies_trans.name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="website" class="mr-sm-2">{{ trans('Companies_trans.website') }}
                                    :</label>
                                <input id="website" type="text" name="website" class="form-control">
                            </div>
                            <div class="col">
                                <label for="email" class="mr-sm-2">{{ trans('Companies_trans.Email') }}
                                    :</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="website" class="mr-sm-2">{{ trans('Companies_trans.company_logo') }}
                                    :</label>
                                <input type="file" name="logo" accept=".png, .jpg, .jpeg, .gif" class="form-control">
                            </div>

                        </div>



                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Companies_trans.Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('Companies_trans.submit') }}</button>
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