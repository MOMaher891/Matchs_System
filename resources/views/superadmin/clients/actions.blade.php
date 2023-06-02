@if ($type == 'image')
    <div class="py-1">
        <img class=""
            src="{{ $data->image ? asset('uploads/client/' . $data->image) : asset('Admin/images/dashboard/people.png') }}"
            alt="">
    </div>
@elseif ($type == 'actions')
    <a class="btn btn-primary" href="{{ route('super_admin.clients.edit', $data->id) }}"><i class="fa fa-pen"></i></a>
    <a class="btn btn-danger" href="{{ route('super_admin.clients.delete', $data->id) }}"><i class="fa fa-trash"></i></a>
@elseif ($type == 'is_blocked')


    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-danger d-inline">
        <input type="checkbox" onclick="toggleStatus({{ $data->id }})" class="custom-control-input" id="is_blocked-{{$data->id}}"
            @if ($data->is_blocked == 1) checked @endif />
        <label class="custom-control-label" for="is_blocked-{{$data->id}}"></label>
    </div>

@endif
