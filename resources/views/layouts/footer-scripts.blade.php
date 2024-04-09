<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = '{{ asset('
    assets / js ') }}/';
</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>


<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>



@if (App::getLocale() == 'en')
<!-- <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script> -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
@else
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- Arabic language file for DataTables -->
<script src="https://cdn.datatables.net/plug-ins/1.11.6/i18n/Arabic.json"></script>

@endif



<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
    $(document).ready(function() {
        var locale = '{{ app()->getLocale() }}'; // Get the current locale from Laravel
        if (locale === 'ar') {



            $('#TableCompany').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/2.0.3/i18n/ar.json"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("getCompanies") }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: true
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        render: function(data, type, row) {
                            return '<img src="{{ asset("storage") }}/' + data + '" width="50" height="50" alt="Image">';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            var locale = '{{ app()->getLocale() }}'; // Get the current locale from Laravel
                            if (locale === 'en') {
                                return row.name.en; // Display the English name
                            } else {
                                return row.name.ar; // Display the Arabic name
                            }
                        },
                        searchable: true

                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true
                    },
                    {
                        data: 'website',
                        name: 'website',
                        searchable: true
                    },
                    {
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="{{ route("companies.edit", ":id") }}" class="btn btn-info btn-sm m-1" title="{{ trans("Companies_trans.Edit") }}"><i class="fa fa-edit"></i></a>'
                                .replace(':id', row.id) +
                                '<button type="button" class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteModalCompanies' + row.id + '" title="{{ trans("Companies_trans.Delete") }}"><i class="fa fa-trash"></i></button>' +
                                // Delete Modal
                                '<div class="modal fade" id="deleteModalCompanies' + row.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                '    <div class="modal-dialog" role="document">' +
                                '        <div class="modal-content">' +
                                '            <div class="modal-header">' +
                                '                <h5 class="modal-title" id="exampleModalLabel">{{ trans("Companies_trans.delete_Company") }}</h5>' +
                                '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '                    <span aria-hidden="true">&times;</span>' +
                                '                </button>' +
                                '            </div>' +
                                '            <div class="modal-body">' +
                                '                <form action="{{ route("companies.destroy", "") }}/' + row.id + '" method="post">' +
                                '                    @method("DELETE")' +
                                '                    @csrf' +
                                '                    {{ trans("Companies_trans.Warning_Company") }}' +
                                '                    <input id="id" type="hidden" name="id" class="form-control" value="' + row.id + '">' +
                                '                    <div class="modal-footer">' +
                                '                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("Companies_trans.Close") }}</button>' +
                                '                        <button type="submit" class="btn btn-danger">{{ trans("Companies_trans.submit") }}</button>' +
                                '                    </div>' +
                                '                </form>' +
                                '            </div>' +
                                '        </div>' +
                                '    </div>' +
                                '</div>';
                        }


                    }
                ]
            });



            //end company arabic




            //employee datattable


            $('#EmployeeDataTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/2.0.3/i18n/ar.json"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("getEmployees") }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: true
                    },
                    {
                        data: null,
                        name: 'name',
                        render: function(data, type, row) {
                            var locale = '{{ app()->getLocale() }}'; // Get the current locale from Laravel
                            var fullName = '';
                            if (locale === 'en') {
                                fullName = row.first_name.en + ' ' + row.last_name.en;
                            } else {
                                fullName = row.first_name.ar + ' ' + row.last_name.ar;
                            }
                            return fullName;
                        },
                        searchable: true
                    },
                    {
                        data: 'company',
                        name: 'company.name',
                        render: function(data, type, row) {
                            var locale = '{{ app()->getLocale() }}'; // Get the current locale from Laravel
                            var companyName = data.name[locale]; // Get the company name based on the locale
                            return companyName;
                        },
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: true
                    },
                    {
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="{{ route("employees.edit", ":id") }}" class="btn btn-info btn-sm m-1" title="{{ trans("Employees_trans.Edit") }}"><i class="fa fa-edit"></i></a>'
                                .replace(':id', row.id) +
                                '<button type="button" class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteEmployeeModal' + row.id + '" title="{{ trans("Employees_trans.Delete") }}"><i class="fa fa-trash"></i></button>' +
                                // Delete Modal
                                '<div class="modal fade" id="deleteEmployeeModal' + row.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                '    <div class="modal-dialog" role="document">' +
                                '        <div class="modal-content">' +
                                '            <div class="modal-header">' +
                                '                <h5 class="modal-title" id="exampleModalLabel">{{ trans("Employees_trans.delete_Employee") }}</h5>' +
                                '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '                    <span aria-hidden="true">&times;</span>' +
                                '                </button>' +
                                '            </div>' +
                                '            <div class="modal-body">' +
                                '                <form action="{{ route("employees.destroy", "") }}/' + row.id + '" method="post">' +
                                '                    @method("DELETE")' +
                                '                    @csrf' +
                                '                    {{ trans("Employees_trans.Warning_Employee") }}' +
                                '                    <input id="id" type="hidden" name="id" class="form-control" value="' + row.id + '">' +
                                '                    <div class="modal-footer">' +
                                '                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("Employees_trans.Close") }}</button>' +
                                '                        <button type="submit" class="btn btn-danger">{{ trans("Employees_trans.submit") }}</button>' +
                                '                    </div>' +
                                '                </form>' +
                                '            </div>' +
                                '        </div>' +
                                '    </div>' +
                                '</div>';
                        }


                    }
                ]
            });
            //end employee arabic





        } else {
            $('#TableCompany').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("getCompanies") }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: true
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        render: function(data, type, row) {
                            return '<img src="{{ asset("storage") }}/' + data + '" width="50" height="50" alt="Image">';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            var locale = '{{ app()->getLocale() }}'; // Get the current locale from Laravel
                            if (locale === 'en') {
                                return row.name.en; // Display the English name
                            } else {
                                return row.name.ar; // Display the Arabic name
                            }
                        },
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true
                    },
                    {
                        data: 'website',
                        name: 'website',
                        searchable: true
                    },
                    {
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="{{ route("companies.edit", ":id") }}" class="btn btn-info btn-sm m-1" title="{{ trans("Companies_trans.Edit") }}"><i class="fa fa-edit"></i></a>'
                                .replace(':id', row.id) +
                                '<button type="button" class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteModalCompanies' + row.id + '" title="{{ trans("Companies_trans.Delete") }}"><i class="fa fa-trash"></i></button>' +
                                // Delete Modal
                                '<div class="modal fade" id="deleteModalCompanies' + row.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                '    <div class="modal-dialog" role="document">' +
                                '        <div class="modal-content">' +
                                '            <div class="modal-header">' +
                                '                <h5 class="modal-title" id="exampleModalLabel">{{ trans("Companies_trans.delete_Company") }}</h5>' +
                                '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '                    <span aria-hidden="true">&times;</span>' +
                                '                </button>' +
                                '            </div>' +
                                '            <div class="modal-body">' +
                                '                <form action="{{ route("companies.destroy", "") }}/' + row.id + '" method="post">' +
                                '                    @method("DELETE")' +
                                '                    @csrf' +
                                '                    {{ trans("Companies_trans.Warning_Company") }}' +
                                '                    <input id="id" type="hidden" name="id" class="form-control" value="' + row.id + '">' +
                                '                    <div class="modal-footer">' +
                                '                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("Companies_trans.Close") }}</button>' +
                                '                        <button type="submit" class="btn btn-danger">{{ trans("Companies_trans.submit") }}</button>' +
                                '                    </div>' +
                                '                </form>' +
                                '            </div>' +
                                '        </div>' +
                                '    </div>' +
                                '</div>';
                        }
                    }
                ]
            });



            //end company english




            //employee datattable


            $('#EmployeeDataTable').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("getEmployees") }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: true
                    },
                    {
                        data: null,
                        name: 'name',
                        render: function(data, type, row) {
                            var locale = '{{ app()->getLocale() }}'; // Get the current locale from Laravel
                            var fullName = '';
                            if (locale === 'en') {
                                fullName = row.first_name.en + ' ' + row.last_name.en;
                            } else {
                                fullName = row.first_name.ar + ' ' + row.last_name.ar;
                            }
                            return fullName;
                        },
                        searchable: true
                    },
                    {
                        data: 'company',
                        name: 'company.name',
                        render: function(data, type, row) {
                            var locale = '{{ app()->getLocale() }}'; // Get the current locale from Laravel
                            var companyName = data.name[locale]; // Get the company name based on the locale
                            return companyName;
                        },
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: true
                    },
                    {
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="{{ route("employees.edit", ":id") }}" class="btn btn-info btn-sm m-1" title="{{ trans("Employees_trans.Edit") }}"><i class="fa fa-edit"></i></a>'
                                .replace(':id', row.id) +
                                '<button type="button" class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteEmployeeModal' + row.id + '" title="{{ trans("Employees_trans.Delete") }}"><i class="fa fa-trash"></i></button>' +
                                // Delete Modal
                                '<div class="modal fade" id="deleteEmployeeModal' + row.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                                '    <div class="modal-dialog" role="document">' +
                                '        <div class="modal-content">' +
                                '            <div class="modal-header">' +
                                '                <h5 class="modal-title" id="exampleModalLabel">{{ trans("Employees_trans.delete_Employee") }}</h5>' +
                                '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '                    <span aria-hidden="true">&times;</span>' +
                                '                </button>' +
                                '            </div>' +
                                '            <div class="modal-body">' +
                                '                <form action="{{ route("employees.destroy", "") }}/' + row.id + '" method="post">' +
                                '                    @method("DELETE")' +
                                '                    @csrf' +
                                '                    {{ trans("Employees_trans.Warning_Employee") }}' +
                                '                    <input id="id" type="hidden" name="id" class="form-control" value="' + row.id + '">' +
                                '                    <div class="modal-footer">' +
                                '                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("Employees_trans.Close") }}</button>' +
                                '                        <button type="submit" class="btn btn-danger">{{ trans("Employees_trans.submit") }}</button>' +
                                '                    </div>' +
                                '                </form>' +
                                '            </div>' +
                                '        </div>' +
                                '    </div>' +
                                '</div>';
                        }


                    }
                ]
            });



            //end employee english

        }

    });
</script>