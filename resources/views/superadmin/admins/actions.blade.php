@if ($type == 'image')
    <div class="py-1">
        <img class=""
            src="{{ $data->image ? asset('uploads/superadmin/admin/' . $data->image) : asset('Admin/images/dashboard/people.png') }}"
            alt="">
    </div>
@elseif ($type == 'actions')
    <a class="btn btn-primary" href="{{ route('super_admin.admins.edit', $data->id) }}"><i class="fa fa-pen"></i></a>
    <a class="btn btn-danger" href="{{ route('super_admin.admins.delete', $data->id) }}"><i class="fa fa-trash"></i></a>
@endif
