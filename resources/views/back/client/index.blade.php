@extends('back.layouts.master')
@section('title','order')
@section('head')

    <!-- Theme JS files -->
    <script type="text/javascript" src="/back/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript"
            src="/back/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <script type="text/javascript" src="/back/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="/back/assets/js/pages/datatables_responsive.js"></script>

{{--    <link href="/back/assets/css/components.css" rel="stylesheet" type="text/css">--}}

{{--    <script type="text/javascript" src="/back/assets/js/pages/form_select2.js"></script>--}}
@endsection
@section('page-header')
    {{--    @include('back.layouts.include.page-header',compact('crumbs'))--}}
@endsection
@section('content')
    @include('back.layouts.include.alert-messages')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Clients</h5>
            <div class="heading-elements">
                {{--                <a href="{{route('admin.client.create')}}"><span class="label label-success">YENİ Product</span></a>--}}
            </div>
        </div>
        <div style="margin-bottom: 2rem;">
            <form action="{{route('admin.client.filter')}}" class="form-horizontal"

                  enctype="multipart/form-data">@csrf





                <div class="col-md-3">
                    <label>Product:</label>
                    <select class="form-control " name="product_id" >
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>min:</label>
                    <input type="number" name="min" placeholder="Price:min" class="form-control" min="0" value="0"
                           style="width: 100%;" onkeyup="minn(this.value)">
                </div>
                <div class="col-md-3">
                    <label>max:</label>

                    <input type="number" name="max" placeholder="Price:max" class="form-control" min="0" value="0"
                           style="width: 100%;" onkeyup="maxx(this.value)">
                </div>

                                <div class="col-md-3">
                                    <label>Filter</label>

                                    <input type="submit" class="btn btn-success" value="Filter" style="width: 100%;">
                                </div>
            </form>
        </div>

        <form action="{{route('admin.client.mail')}}" class="form-horizontal"
              method="Post"
              enctype="multipart/form-data">@csrf


            <div class="panel panel-flat">
                <table class="table datatable-responsive dataTable no-footer dtr-inline" id="DataTables_Table_0"
                       role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr role="row">
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Phone</th>
                        <th>Total price</th>
                        <th>Birth Date</th>
                        <th>Location</th>

                        <th>Sec</th>


                        <th class="text-center">Düzəlişlər</th>

                    </tr>
                    </thead>

                    @if(isset($clients) && $clients->count()>0)
                        <tbody>

                        @foreach($clients as $key=>$client)
                            <tr role="row" class="trr">
                                <td style="color: red;font-weight: bold">{{$client->id}}</td>

                                <td><a href="">{{$client->fullname ?? ''}}</a>
                                </td>
                                <td>
                                    <a href="">{{$client->phone}}</a>
                                </td>
                                <td style="color: green;font-weight: bold;" class="prices">
                                    @if($client->orders->count()>0)
                                        <a style="color: green;font-weight: bold" class=""
                                           href="{{route('admin.order.show',$client->orders[0]->unique_id)}}">{{$client->orders->sum('sum')}}
                                        </a>
                                    @else
                                        <span class="">  0</span>

                                    @endif
                                </td>
                                <td>
                                    <a href="">{{$client->bdate ?? ''}}</a>
                                </td>
                                <td>
                                    <a href="">{{$client->location}}</a>
                                </td>
                                <td style="color: red;font-weight: bold"><input name="clients[]" value="{{$client->id}}"
                                                                                style="width: 50%;" type="checkbox"
                                                                                class="form-control"></td>

                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href=""><i
                                                            class="icon-database-edit2"></i> Yenilə</a></li>

                                                <li>
                                                    <a onclick='checkDeleteConfrim("")'><i
                                                            class="icon-database-remove"></i> Sil</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        <textarea name="mesaj" class="form-control"
                                  style="width: 100%!important;"> Mail gonder.....!</textarea>

                        <input type="submit" class="btn btn-success" value="Mail gonder" style="width: 100%;">
                    @endif
                </table>
            </div>

        </form>


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

                function minn(min) {
                    if (!min)
                        min = 0;
                    var trr = document.getElementsByClassName('trr');
                    for (var tra of trr) {
                        tra.hidden = false;
                    }
                    var prices = document.getElementsByClassName('prices');
                    for (var price of prices) {
                        var val = Number(price.innerText)
                        if (val < min) {
                            price.parentNode.hidden = true
                        }

                    }
                }

                function maxx(max) {
                    if (!max)
                        max = 100000;
                    var trr = document.getElementsByClassName('trr');
                    for (var tra of trr) {
                        tra.hidden = false;
                    }
                    var prices = document.getElementsByClassName('prices');
                    for (var price of prices) {
                        var val = Number(price.innerText)
                        if (val > max) {
                            price.parentNode.hidden = true
                        }

                    }
                }




            </script>

@endsection

