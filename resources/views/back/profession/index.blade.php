@extends('back.layouts.master')
@section('title','product')
@section('head')

    <!-- Theme JS files -->
    <script type="text/javascript" src="/back/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript"
            src="/back/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <script type="text/javascript" src="/back/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="/back/assets/js/pages/datatables_responsive.js"></script>
@endsection
@section('page-header')
    {{--    @include('back.layouts.include.page-header',compact('crumbs'))--}}
@endsection
@section('content')
    @include('back.layouts.include.alert-messages')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">SAHELER</h5>
            <div class="heading-elements">
                <a href="{{route('admin.profession.create')}}"><span
                        class="label label-success">YENİ sahe</span></a>
            </div>
        </div>

        <table class="table datatable-responsive-row-control">
            <thead>
            <tr>
                <th></th>
                <th>No</th>
                   <th>Icon</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tbody>

            @if($professions->count()>0)
                @foreach($professions as $key=>$profession)
                    <tr {{session()->has('id') &&  $profession->id==session('id') ? 'style=background:#38d28f;' : ''}} >
                        <td> </td>
                        <td> {{++$key}} </td>
                        <td>
                            <a href="{{route('admin.profession.edit',$profession->id)}}">
                                <img style="width: 50px;" src="{{asset("uploads/profession").'/'.$profession->icon}}" alt="">
                            </a>
                        </td>
                        
                        <td><a href="{{route('admin.profession.edit',$profession->id)}}">{{$profession->name ?? ''}}</a></td>
                        <td><a class="btn btn-success" href="{{route('admin.profession.edit',$profession->id)}}">edit</a></td>
                        <td><a class="btn btn-danger"
                               onclick='checkDeleteConfrim("{{route('admin.profession.remove',$profession->id)}}")'>delete</a>
                        </td>



                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('foot')
    <script>
        function checkDeleteConfrim(url, parentId) {
            swal({
                title: "Silmək istədiynizdən əminsizmi?",
                text: "Silinəndən sonra bu əməliyyatı bərpa edə bilməyəcəksiniz!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        location.href = url;
                    } else {
                        swal("Heç bir əməliyyat aparılmadı");
                    }
                });


        }
    </script>




@endsection

