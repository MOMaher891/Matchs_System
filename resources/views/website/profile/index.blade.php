@extends('website.layouts.layout')
@section('title','Profile')
@section('content')
<section class="profile">
    <div class="container mt-8">
        <div class="content">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active text-success" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link text-success" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Bookings</button>
                </li>
                
            </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              {{-- Profile --}}
              @include('website.profile.profile')
          </div>
          
          
          
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              @include('website.profile.booking')
          </div>
        </div>
            
       
        </div>
    </div>
</section>

@stop


@section('js')

    <script>
         
        let BookingsTable = null

        function setUserDatatable() {
            var url = "{{ route('client.profile.data') }}";

            BookingsTable = $("#User-Table").DataTable({
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
                        data: 'stadium_id'
                    },
                    {
                        data:'type'
                    },
                    {
                        data:'status'
                    },
                    
                    {
                        data: 'total'
                    },
                    {
                        data:'times'
                    },
                    {
                        data:'date'
                    } 
                ],
                
            });
        }

        setUserDatatable();



    </script>

@stop
