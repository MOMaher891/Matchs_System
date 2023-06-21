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
                                <th>Type</th>
                                <th>Stadium</th>
                                <th>Price</th>


                                <th>Times</th>
                                <th>Date</th>

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
                        data:'type'
                    },
                    {
                        data: 'stadium_id'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data:'times'
                    },
                    {
                        data:'date'
                    },
                    {
                        data: 'actions'
                    }
                ],
            });
        }

        setUserDatatable();


        function toggleStatus(client_id,stadium_id,times,status)
        {
                 $.ajax({
                     type: 'GET',
                     url: "{{route('request.toggle-status')}}",
                     data: {
                        status:status,
                        client_id:client_id,
                        stadium_id,
                        times
                    },
                     dataType: 'JSON',
                     success: function (results) {
                       console.log(results);
                       RequestsTable.ajax.reload()
                    //    return results
                       if(results.type =='accept')
                       {
                        window.open(`https://wa.me/${results.phone}?text=Hii, Mr.${results.client},%20 your Request to Book ${results.stadium} at Has Approved. Enjoy`,'_blank')
                       }else if(results.type == 'decline')
                       {
                        window.open(`https://wa.me/${results.phone}?text=Hii, Mr.${results.client},%20 Sorry your Request to Book ${results.stadium} at Has Decline`,'_blank')
                       }

                     },
                     error:function(result){
                        console.log(result);
                        alert(error)
                     }
                 });

        }
    </script>


@stop
