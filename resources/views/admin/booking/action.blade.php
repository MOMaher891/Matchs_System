@if ($type == 'action')
    <a class="btn btn-primary" href="{{route('admin.bookings.edit',$data->id)}}"><i class="fa fa-pen"></i></a>
@endif