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
{{ trans('Companies_trans.edit_Company') }}
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
                            {{ trans('Companies_trans.edit_Company') }}
                        </h5>

                    </div>
                    <div class="card-body">
                        <!-- add_form -->
                        <form action="{{ route('companies.update', $company->id) }}" method="post" enctype="multipart/form-data">
                            {{ method_field('patch') }}
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <label for="name_ar" class="mr-sm-2">{{ trans('Companies_trans.name_ar') }}
                                        :</label>
                                    <input id="name_ar" type="text" name="name_ar" class="form-control" value="{{ $company->getTranslation('name', 'ar') }}">
                                </div>
                                <div class="col">
                                    <label for="name_en" class="mr-sm-2">{{ trans('Companies_trans.name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="name_en" value="{{ $company->getTranslation('name', 'en') }}">
                                </div>
                            </div>



                            <div class="row">
                                <div class="col">
                                    <label for="website" class="mr-sm-2">{{ trans('Companies_trans.website') }}
                                        :</label>
                                    <input id="website" type="text" name="website" class="form-control" value="{{ $company->website }}">
                                </div>
                                <div class="col">
                                    <label for="email" class="mr-sm-2">{{ trans('Companies_trans.Email') }}
                                        :</label>
                                    <input type="text" class="form-control" name="email" value="{{ $company->email }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="website" class="mr-sm-2">{{ trans('Companies_trans.update_company_logo') }}
                                        :</label>
                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg, .gif" class="form-control">
                                </div>

                                <div class="col">
                                    <label for="website" class="mr-sm-2">{{ trans('Companies_trans.company_logo') }}
                                        :</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $company->logo) }}" width="50" height="50" alt="Image">
                                    </div>

                                </div>
                            </div>

                            <br><br>
                    </div>


                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Companies_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('Companies_trans.submit') }}</button>
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