@extends('superadmin.layouts.app')
@section('title', 'Stadiums List')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="content m-2 text-center">
                    <a class="btn btn-primary" href="{{ route('super_admin.stadiums.create') }}">Add Stadium <i
                            class="fa fa-plus"></i></a>
                </div>

                <h4 class="card-title">Stadiums</h4>
                <p class="card-description">
                    Show Stadiums
                </p>

                <div class="table-responsive">
                    <table class="table table-striped" id="User-Table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Phone</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        let UsersTable = null

        function setUserDatatable() {
            var url = "{{ route('super_admin.stadiums.data') }}";

            UsersTable = $("#User-Table").DataTable({
                processing: true,
                serverSide: true,
                dom: 'Blfrtip',
                lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
                pageLength: 9,
                sorting: [0, "DESC"],
                ordering: false,
                ajax: url,

                language: {
                    paginate: {
                        "previous": "<i class='mdi mdi-chevron-left'>",
                        "next": "<i class='mdi mdi-chevron-right'>"
                    },
                },


                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'actions'
                    }
                ],
            });
        }

        setUserDatatable();
    </script>


@stop
