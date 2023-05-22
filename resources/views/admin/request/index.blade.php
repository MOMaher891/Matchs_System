@extends('admin.layouts.app')
@section('title', 'Requests')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <div class="content m-2 text-center">
                    <a class="btn btn-primary" href="{{ route('super_admin.admins.create') }}">Add Admins <i
                            class="fa fa-plus"></i></a>
                </div> --}}

                <h4 class="card-title">Requests</h4>
                <p class="card-description">
                    Show Requests
                </p>

                <div class="table-responsive">
                    <table class="table table-striped" id="User-Table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Stadium</th>
                                <th>Times</th>
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
        let RequestsTable = null

        function setUserDatatable() {
            var url = "{{ route('request.data') }}";

            RequestsTable = $("#User-Table").DataTable({
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
                        data: 'client_id'
                    },
                    {
                        data: 'stadium_id'
                    },
                    {
                        data:'times'
                    },
                    {
                        data: 'actions'
                    }
                ],
            });
        }

        setUserDatatable();


        function toggleStatus(id,status)
        {
           
                 $.ajax({
                     type: 'GET',
                     url: "{{route('request.toggle-status')}}",
                     data: {status:status,id:id},
                     dataType: 'JSON',
                     success: function (results) {
                       console.log(results);
                       RequestsTable.ajax.reload()
                     },
                     error:function(result){
                        console.log(result);
                        alert(error)
                     }
                 });

        }
    </script>


@stop