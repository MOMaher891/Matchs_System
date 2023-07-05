@extends('admin.layouts.app')
@section('title', 'Stadiums')
@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="content m-2 text-center">
                    <a class="btn btn-primary" href="{{ route('admin.stadiums.create') }}">Add Stadiums <i
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price in LB</th>
                                <th>Price in $</th>

                                <th>Description</th>
                                <th>Phone</th>
                                <th>Region</th>
                                <th>Is Open</th>

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
        let StadiumsTable = null

        function setUserDatatable() {
            var url = "{{ route('admin.stadiums.data') }}";

            StadiumsTable = $("#User-Table").DataTable({
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
                        data: 'price'
                    },
                    {
                        data: 'price_in_dolar'
                    },
                    {
                        data:'description'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'region_id'
                    },
                    {
                        data: 'is_open'
                    },
                    {
                        data: 'actions'
                    }
                ],
            });
        }

        setUserDatatable();


        function toggleSwitch(id,is_open)
        {
           
                 $.ajax({
                     type: 'GET',
                     url: "{{route('admin.stadiums.toggle-status')}}",
                     data: {is_open:is_open,id:id},
                     dataType: 'JSON',
                     success: function (results) {
                       console.log(results);
                       StadiumsTable.ajax.reload()
                     },
                     error:function(result){
                        console.log(result);
                        alert(error)
                     }
                 });

        }
     
    </script>

 

@stop
