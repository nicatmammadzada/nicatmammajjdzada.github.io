@extends('back.layouts.master')
@section('title','order')
@section('head')

    <!-- Theme JS files -->
    <script type="text/javascript" src="/back/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="/back/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
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
            <h5 class="panel-title">Product</h5>
            <div class="heading-elements">
                <a href="{{route('admin.product.create')}}"><span class="label label-success">YENİ Product</span></a>
            </div>
        </div>

        <table class="table datatable-responsive-row-control">
            <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Count</th>
                <th>Price</th>
                <th>Total</th>




{{--                <th class="text-center">Düzəlişlər</th>--}}
            </tr>
            </thead>
            <tbody>

            @if($orders->count()>0)
                @foreach($orders as $key=>$order)
                    <tr   {{session()->has('id') &&  $order->id==session('id') ? 'style=background:#38d28f;' : ''}} >
                        <td style="color: green;font-weight: bold">{{$order->unique_id}}</td>
                        <td>
                            <a href="{{asset("uploads/product").'/'.$order->product->photo}}">
                                <img style="width: 50px;" src="{{asset("uploads/product").'/'.$order->product->photo}}"  alt="">
                            </a>
                        </td>

                        <td><a href="{{route('admin.product.edit',$order->id)}}">{{$order->product->name ?? ''}}</a></td>
                        <td><a href="{{route('admin.product.edit',$order->id)}}">{{$order->count ?? ''}}</a></td>

                        <td><a href="{{route('admin.product.edit',$order->id)}}">{{$order->price ?? ''}} </a></td>
                        <td><a href="{{route('admin.product.edit',$order->id)}}">{{$order->total ?? ''}} </a></td>





{{--                        <td class="text-center">--}}
{{--                            <ul class="icons-list">--}}
{{--                                <li class="dropdown">--}}
{{--                                    <a class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                                        <i class="icon-menu9"></i>--}}
{{--                                    </a>--}}

{{--                                    <ul class="dropdown-menu dropdown-menu-right">--}}
{{--                                        <li><a href="{{route('admin.product.edit',$order->id)}}"><i class="icon-database-edit2"></i> Yenilə</a></li>--}}
{{--                                        <li><a  onclick='checkDeleteConfrim("{{route('admin.product.destroy',$order->id)}}")'><i class="icon-database-remove"></i> Sil</a></li>--}}
{{--                                    </ul>--}}



{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('foot')
    <script>
        function checkDeleteConfrim(url,parentId) {
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

