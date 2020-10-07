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
            <h5 class="panel-title">Vakansiyalar</h5>
            <div class="heading-elements">
                <a href="{{route('admin.product.create')}}"><span class="label label-success">YENİ Product</span></a>
            </div>
        </div>

        <table class="table datatable-responsive-row-control">
            <thead>
            <tr>
                <th>No</th>
                <th>Photo</th>
                <th>Name,Surname</th>
                <th>Age</th>
                <th>email</th>
                <th>adress</th>
                <th>education</th>
                <th>experience</th>
                <th>langs</th>

                <th>aile veziyyeti</th>
                <th>Vetendasliq</th>

{{--                <th class="text-center">Düzəlişlər</th>--}}
            </tr>
            </thead>
            <tbody>

            @if($vacancies->count()>0)
                @foreach($vacancies as $key=>$vacancy)
                    <tr {{session()->has('id') &&  $vacancy->id==session('id') ? 'style=background:#38d28f;' : ''}} >
                        <td>{{++$key}}</td>

                        <td><img src="{{asset('uploads/vacancies/').'/'.$vacancy->photo}}" style="width: 100px;height: 100px; object-fit: contain" alt=""></td>
                        <td>{{$vacancy->name}},{{$vacancy->surname}}</td>
                        <td>{{$vacancy->age}}</td>
                        <td>{{$vacancy->email}}</td>
                        <td>{{$vacancy->adress}}</td>
                        <td>{{$vacancy->education}}</td>
                        <td>{{$vacancy->experience}}</td>
                        <td>{{$vacancy->langs}}</td>

                        <td>{{$vacancy->aile}}</td>
                        <td>{{$vacancy->ntl}}</td>


{{--                    <td class="text-center">--}}
{{--                        <ul class="icons-list">--}}
{{--                            <li class="dropdown">--}}
{{--                                <a class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                                    <i class="icon-menu9"></i>--}}
{{--                                </a>--}}

{{--                                <ul class="dropdown-menu dropdown-menu-right">--}}
{{--                                    <li><a href="{{route('admin.product.edit',$vacancy->id)}}"><i--}}
{{--                                                class="icon-database-edit2"></i> Yenilə</a></li>--}}
{{--                                    <li><a href="{{route('admin.product.promo',$vacancy->id)}}"><i--}}
{{--                                                class="icon-database-edit2"></i> Promokod elave et</a></li>--}}
{{--                                    <li>--}}
{{--                                        <a onclick='checkDeleteConfrim("{{route('admin.product.destroy',$vacancy->id)}}")'><i--}}
{{--                                                class="icon-database-remove"></i> Sil</a></li>--}}
{{--                                </ul>--}}


{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </td>--}}
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

