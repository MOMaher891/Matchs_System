@if ($type == 'action')
    <a class="btn btn-primary" href="{{route('admin.bookings.edit',$data->id)}}"><i class="fa fa-pen"></i></a>
    <a class="btn btn-danger delete-confirm"   href="{{route('admin.bookings.delete',$data->id)}}"><i class="fa fa-trash"></i></a>

@endif

<script type="text/javascript">
    $('.delete-confirm').on('click', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

</script>
