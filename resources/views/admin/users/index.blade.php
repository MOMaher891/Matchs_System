@extends('admin.layouts.app')
@section('title', 'Users')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Users</h4>
                <p class="card-description">
                    Show Users
                </p>

                <div class="table-responsive">
                    <table class="table table-striped" id="User-Table">
                        <thead class="text-center">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
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
            var url = "{{ route('admin.users.data') }}";

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
                        data: 'actions'
                    }
                ],
            });
        }

        setUserDatatable();

        function activeUser(id)
        {
            $.ajax({
                type: 'GET',
                url: "{{route('admin.users.active-user')}}",
                data: {id:id},
                dataType: 'JSON',
                success: function (results) {
                  console.log(results);
                  UsersTable.ajax.reload()
                },
                error:function(result){
                   console.log(result);
                   alert(error)
                }
            });
        }

        function blockUser(id)
        {
            $.ajax({
                type: 'GET',
                url: "{{route('admin.users.block-user')}}",
                data: {id:id},
                dataType: 'JSON',
                success: function (results) {
                  console.log(results);
                  UsersTable.ajax.reload()
                },
                error:function(result){
                   console.log(result);
                   alert(error)
                }
            });
        }
     
    </script>

 

@stop
