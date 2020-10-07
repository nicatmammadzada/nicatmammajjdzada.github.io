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
            <h5 class="panel-title">Product</h5>
            <div class="heading-elements">
                <a href="{{route('admin.product.create')}}"><span class="label label-success">YENİ Product</span></a>
            </div>
        </div>

        <table class="table datatable-responsive-row-control">
            <thead>
            <tr>
                <th></th>
                <th>No</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>




            </tr>
            </thead>
            <tbody>


                @foreach($products as $key=>$product)
                    <tr {{session()->has('id') &&  $product->id==session('id') ? 'style=background:#38d28f;' : ''}} >
                    <td></td>
                         <td>{{++$key}} </td>
                       
                        <td><a  href="{{route('admin.product.edit',$product->id)}}">{{$product->name ?? ''}}</a></td>

                        <td><a class="btn btn-success" href="{{route('admin.product.edit',$product->id)}}">edit</a></td>
                        <td><a class="btn btn-danger" onclick='checkDeleteConfrim("{{route('admin.product.destroy',$product->id)}}")'>delete</a></td>








{{--                    <td class="text-center">--}}
{{--                        <ul class="icons-list">--}}
{{--                            <li class="dropdown">--}}
{{--                                <a class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                                    <i class="icon-menu9"></i>--}}
{{--                                </a>--}}

{{--                                <ul class="dropdown-menu dropdown-menu-right">--}}
{{--                                    <li><a href="{{route('admin.product.edit',$product->id)}}"><i--}}
{{--                                                class="icon-database-edit2"></i> Yenilə</a></li>--}}
{{--                                    <li><a href="{{route('admin.product.promo',$product->id)}}"><i--}}
{{--                                                class="icon-database-edit2"></i> Promokod elave et</a></li>--}}
{{--                                    <li>--}}
{{--                                        <a onclick='checkDeleteConfrim("{{route('admin.product.destroy',$product->id)}}")'><i--}}
{{--                                                class="icon-database-remove"></i> Sil</a></li>--}}
{{--                                </ul>--}}


{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </td>--}}
                    </tr>

                @endforeach

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

        <script>
        function changeRow(value,id) {


            var url = "{{route('admin.product.row')}}";
            $.ajax({
                url: url,
                data: {"_token": "{{ csrf_token() }}", id: id,value:value},
                type: 'POST',
                success: function (response) {
                 //   alert('Company remove')
                 //   window.location.reload()
                }
            })
        }
    </script>


@endsection

