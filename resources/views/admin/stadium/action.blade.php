@switch($type)
    @case('actions')

    @if ($data->is_open == '0')
    <div class="form-check form-switch text-center">
        <input class="form-check-input" type="checkbox" role="switch" onclick="toggleSwitch({{$data->id}},1)" id="switch-{{$data->id}}" >
    </div>
        
    @elseif ($data->is_open == '1')
    <div class="form-check form-switch text-center">
        <input class="form-check-input" type="checkbox" role="switch" onclick="toggleSwitch({{$data->id}},0)" id="switch-{{$data->id}}" checked>
    </div>
        
    @endif
    @break
    @case('image')
    <div class="py-1">
        <img class=""
            src="{{ $data->stadium_image[0]->image ? asset('uploads/stadium/' . $data->stadium_image[0]->image) : asset('Admin/images/dashboard/people.png') }}"
            alt="">
    </div>
    @break

    @default
        
@endswitch