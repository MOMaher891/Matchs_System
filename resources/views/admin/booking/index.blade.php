@extends('admin.layouts.app')
@section('title', 'Booking')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
             
                <h4 class="card-title">Booking</h4>
                <p class="card-description">
                    Show Bookings
                </p>

                <div class="row  w-100 ">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Stadiums</label>
                            <select name="" class="form-select" id="stadium">
                                @foreach ($stadiums as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="" class=" form-control select" id="status">
                                    <option value="accept">Accept</option>
                                    <option value="cencel">cencel</option>
                            </select>
                        </div>
                    </div>


                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="" class=" form-control select" id="type">
                                    <option value="const">Const</option>
                                    <option value="once">Once</option>
                            </select>
                        </div>
                    </div>
            
            
                    <div class="col-md-2" >
                        <div class="form-group d-inline-flex">
                            <button onclick="handleFilter()" class="btn btn-primary p-2" >Search <i class="fa-solid fa-magnifying-glass"></i></button>
                            <button onclick="ClearFilter()" class="btn btn-light" >Clear</button>
                        </div>    
                    </div> 
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <h3>Total: {{$total}} LBP</h3>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="User-Table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Stadium</th>
                                <th>Type</th>
                                <th>Total</th>
                                <th>Times</th>
                                <th>Date</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script>
          $(document).ready(function() {
            $('#stadium').select2({
                placeholder: 'Select an Stadium',
                allowClear: true
            });
           
        });

        let RequestsTable = null

        function setUserDatatable() {
            var url = "{{ route('admin.bookings.data') }}";

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
                        data: 'code'
                    },
                    {
                        data: 'client_id'
                    },
                    {
                        data: 'stadium_id'
                    },
                    {
                        data:'type'
                    },
                    
                    {
                        data: 'total'
                    },
                    {
                        data:'times'
                    },
                    {
                        data:'date'
                    },
                    
                ],
            });
        }

        setUserDatatable();


        function handleFilter()
        {
            stadium = $('#stadium').val() || '';
            status = $('#status').val() || '';
            type = $('#type').val() || '';
            
            if (RequestsTable) {
                var url = "{{ route('admin.bookings.data') }}" + `?stadium_id=${stadium}&status=${status}&type=${type}`;
                // console.log(url);
                RequestsTable.ajax.url(url).load()
            }
        }

        function ClearFilter()
        {
            stadium = $('#stadium').val('') ;
            status = $('#status').val('');
            type = $('#type').val('') ;
            var url = "{{ route('admin.bookings.data') }}";
            RequestsTable.ajax.url(url).load()
        
        }
    </script>


@stop
