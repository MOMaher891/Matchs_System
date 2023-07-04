@switch($type)
    @case('actions')
        @if (count($data->block_user) != 0 && $data->block_user[0]->status == 'blocked')
            <div class="form-check form-switch text-center">
                <input class="form-check-input" type="checkbox" role="switch" onclick="activeUser({{ $data->id }})"
                    id="switch-{{ $data->id }}" checked>
            </div>
        @else
            <div class="form-check form-switch text-center">
                <input class="form-check-input" type="checkbox" role="switch" onclick="blockUser({{ $data->id }})"
                    id="switch-{{ $data->id }}">
            </div>
        @endif
    @break

    @case('trusted')
        @if (count($data->block_user) != 0 && $data->block_user[0]->status == 'trusted')
            <div class="form-check form-switch text-center">
                <input class="form-check-input" type="checkbox" role="switch" onclick="activeUser({{ $data->id }})"
                    id="switch-{{ $data->id }}" checked>
            </div>
        @else
            <div class="form-check form-switch text-center">
                <input class="form-check-input" type="checkbox" role="switch" onclick="trustedUser({{ $data->id }})"
                    id="switch-{{ $data->id }}">
            </div>
        @endif
    @break

    @case('image')
        <div class="py-1">
            <img class=""
                src="{{ $data->image ? asset('uploads/client/' . $data->image) : asset('Admin/images/dashboard/people.png') }}"
                alt="">
        </div>
    @break

    @default
@endswitch
