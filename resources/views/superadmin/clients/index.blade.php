@extends('superadmin.layouts.app')
@section('title', 'Client List')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <div class="content m-2 text-center">
                    <a class="btn btn-primary" href="{{ route('super_admin.clients.create') }}">Add Client <i
                            class="fa fa-plus"></i></a>
                </div> --}}

                <h4 class="card-title">Clients</h4>
                <p class="card-description">
                    Show Clients
                </p>

                <div class="table-responsive">
                    <table class="table table-striped" id="User-Table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Age</th>
                                <th>Is_Blocked</th>
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
            var url = "{{ route('super_admin.clients.data') }}";

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
                        data: 'image'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'birth_date'
                    },
                    {
                        data: 'is_blocked'
                    },
                    {
                        data: 'actions'
                    }
                ],
            });
        }

        setUserDatatable();

    
    </script>
    <script>
        // $(document).ready(function () {
        // });
        function toggleStatus(id) {
                
                console.log(id);
    
    
                    $.ajax({
                        url: "{{ route('super_admin.clients.toggle') }}",
                        type: 'GET',
                        data: {
                            clientID: id
                        },
                        success: function() {
                            UsersTable.ajax.reload();
                        },
                    })
            }
       
    </script>

@stop
