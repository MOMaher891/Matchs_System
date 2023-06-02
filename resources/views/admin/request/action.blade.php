@switch($type)
    @case('actions')
    <a class="btn btn-sm btn-success" onclick="toggleStatus({{$data->client_id}},{{$data->stadium_id}},{{$data->times}},'accept')" ><i class="fa-solid fa-check"></i></a>    
    <a class="btn btn-sm btn-danger" onclick="toggleStatus({{$data->client_id}},{{$data->stadium_id}},{{$data->times}},'decline')" ><i class="fa-solid fa-x"></i></a>    
    @break
    @case('image')
    <div class="py-1">
        <img class=""
            src="{{ $data->user->image ? asset('uploads/client/' . $data->user->image) : asset('Admin/images/dashboard/people.png') }}"
            alt="">
    </div>  
    @break
    @case('times')
        @foreach ($times as $item)
            <p>{{$item->from}} || {{$item->to}}</p>
        @endforeach
    @break
    @default
        
@endswitch