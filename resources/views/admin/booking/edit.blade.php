@extends('admin.layouts.app')
@section('title', 'Edit Stadium')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Booking</h4>
                <p class="card-description">
                    Edit Booking
                </p>
                <form class="forms-sample" action="{{ route('admin.bookings.update',$data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                 
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail3">Stadium</label>
                            <select name="stadium_id" class="form-control" id="stadium_search" >
                                <option value="">Select Stadium</option>
                                @foreach ($stadiums as $d)
                                    <option value="{{ old('stadium_id',$d->id) }}" {{old('stadium_id',$d->id) == $data->stadium->id ? 'selected' : ''}}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                            @error('stadium_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail3">User</label>
                            <select name="client_id" class="form-control" id="user_search">
                                <option value="{{old('client_id')}}" disabled>Select Phone</option>
                                @foreach ($clients as $d)
                                <option value="{{ old('client_id',$d->id) }}" {{ old('client_id',$d->id) == $data->client_id ? 'checked' : '' }}>{{ $d->phone }} - {{ $d->name }}</option>
                            @endforeach
                            </select>
                            @error('client_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>


                        
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail3">Date</label>
                            <input type="date" name="date" class="form-control" value="{{old('date',$data->date)}}" onchange="getTime()" id="date">
                            @error('date')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                  

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail3">Select Time</label>
                            <select name="times[]" id="times"  multiple class="form-control">
                                @foreach ($times as $item)
                                    <option value="{{$item->id}}" {{ in_array($item->id,$dataTime) ? 'selected' : '' }} >{{$item->from }} - {{$item->to}}</option>
                                @endforeach
                            </select>
                        </div>


                        
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail3">Total</label>
                            <input type="text" name="total" value="{{$data->total}}" class="form-control" id="total">
                        </div>

                    </div>

                   

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



    <script>

        $(document).ready(function() {
            $('#user_search').select2({
                placeholder: 'Select an User Phone',
                allowClear: true
            });
            $('#stadium_search').select2({
                placeholder: 'Select an Stadium',
                allowClear: true
            });
        });

        function getTime() {
            let stadium_id = $("#stadium_search").find(":selected").val();
            let date = $("#date").val();
            $.ajax({
                type: 'GET',
                url: `{{route('admin.bookings.get-time')}}`,
                data:{stadium_id,date},
                success: function(data) {
                    console.log(data);
                    $("#times").empty();

                    $("#times").html(data);
                },
                error: function(error) {
                    console.log('error');
                    alert('error')
                }
            });
        }

        // function getTotal()
        // {
           
        //     let times = $("#times").val();
        //     let month = $("#month_num").val();

        //     let type = $('input[name="type"]:checked').val(); 
        //     let stadium_id = $("#stadium_search").val();

        //     if(type === 'once')
        //     {
        //         $("#month_num").addClass('d-none');

        //     }

        //     console.log(times);
        //     console.log(month);
        //     console.log(type);
        //     console.log(stadium_id);

        //     $.ajax({
        //         type: 'GET',
        //         url: `{{route('admin.bookings.total')}}`,
        //         data:{
        //             times,
        //             month,
        //             type,
        //             stadium_id
        //         },
        //         success: function(data) {
        //             console.log(data);
        //             $("#total").val(data);
        //         },
        //         error: function(error) {
        //             console.log('error');
        //             // alert('error')
        //         }
        //     });
        // }


        // function showTime()
        // {
        //     $("#month_num").removeClass('d-none');
        // }
    </script>

   
@stop
