@if ($type == 'image')
    <div class="py-1">
        <img class=""
            src="{{ $data->image ? asset('uploads/admin/' . $data->image) : asset('Admin/images/dashboard/people.png') }}"
            alt="">
    </div>
@elseif ($type == 'actions')
    <a class="btn btn-primary" href="{{ route('super_admin.users.edit', $data->id) }}"><i class="fa fa-pen"></i></a>
    <a class="btn btn-danger" href="{{ route('super_admin.users.delete', $data->id) }}"><i class="fa fa-trash"></i></a>
    <a class="btn btn-info" href="{{ route('super_admin.users.change-password-view', $data->id) }}"><i class="fa fa-lock"></i></a>
@endif
