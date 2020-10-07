@extends('back.layouts.master')
@section('title','order')
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
            <h5 class="panel-title">Product</h5>
            <div class="heading-elements">
                <a href="{{route('admin.product.create')}}"><span class="label label-success">YENİ Product</span></a>
            </div>
        </div>

        <table class="table datatable-responsive-row-control">
            <thead>
            <tr>
<th></th>
                <th>ID</th>
                <th>Client</th>
                <th>Price</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column descending">Date</th>
                <th>Delivered time</th>
                <th>Payment</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Home</th>
                <th>Content</th>
                <th>Show</th>
                <!--<th class="text-center">Düzəlişlər</th>-->
            </tr>
            </thead>
            <tbody>

            @if($orders->count()>0)
                @foreach($orders as $key=>$order)
                    <tr {{session()->has('id') &&  $order->id==session('id') ? 'style=background:#38d28f;' : ''}} >

                        <td style="color: green;font-weight: bold"></td>
                        <td style="color: red;font-weight: bold">{{$order->unique_id}}</td>
                        <td><a href="">{{$order->fullname ?? ''}}</a>
                        </td>
                        <td style="color: green;font-weight: bold">
                            {{$order->sum}} AZN
                        </td>



                        <td>
                            <a href="">{{$order->updated_at ?? ''}}</a>
                        </td>


                        <td>
                            <a href="">{{$order->customTime ??  $order->time1.'-'.$order->time2 }}</a>
                        </td>
                        <td>@if($order->payment==1) online @elseif($order->payment==2) kart kuryer @else kuryer nagd @endif</td>
                        <td>
                            <a href="">{{$order->street}}</a>
                        </td>
                        <td>
                            <a href="">{{$order->phone}}</a>
                        </td>
                        <td>
                            <a href="">{{$order->home}}</a>
                        </td>
                        <td>
                            <a href="">{{$order->content}}</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{route('admin.order.show',$order->unique_id)}}">show</a>
                        </td>


                        <!--<td class="text-center">-->
                        <!--    <ul class="icons-list">-->
                        <!--        <li class="dropdown">-->
                        <!--            <a class="dropdown-toggle" data-toggle="dropdown">-->
                        <!--                <i class="icon-menu9"></i>-->
                        <!--            </a>-->

                        <!--            <ul class="dropdown-menu dropdown-menu-right">-->
                        <!--                <li><a href=""><i-->
                        <!--                            class="icon-database-edit2"></i> Yenilə</a></li>-->

                        <!--                <li>-->
                        <!--                    <a onclick='checkDeleteConfrim("")'><i-->
                        <!--                            class="icon-database-remove"></i> Sil</a></li>-->
                        <!--            </ul>-->


                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</td>-->
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

