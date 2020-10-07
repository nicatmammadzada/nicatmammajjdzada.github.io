@extends('back.layouts.master')
@section('title','product-create')
@section('head')
    <script type="text/javascript" src="/back/ckeditor/ckeditor.js"></script>
@endsection
@section('page-header')
    {{--    @include('back.layouts.include.page-header',compact('crumbs'))--}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
        @include('back.layouts.include.alert-messages')
        <!-- Basic layout-->

            <div class="row">
                <div class="">
                    <div class="panel panel-flat">

                        <div class="panel-heading">
                            <h6 class="panel-title"><a class="heading-elements-toggle"><i
                                        class="icon-more"></i></a></h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse" class=""></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="panel-body" style="display: block;">
                            <div class="panel-heading">
                                <h5 class="panel-title label label-success">{{$product->name ?? ''}}</h5>
                                <div class="heading-elements">
                                    <a href="{{route('admin.product.index',$product->category_id)}}"><span
                                            class="label label-success">Productlara QAYIT</span></a>
                                </div>
                            </div>


                            <form action="{{route('admin.product.promokod',$product->id)}}"
                                  class="form-horizontal"
                                  method="Post"
                                  enctype="multipart/form-data">@csrf


                                <div class="panel-body">


                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Code:</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" name="code"
                                                   value="{{old('code')}}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Start date:</label>
                                        <div class="col-lg-4">
                                            <input type="date" class="form-control" name="start_date"
                                                   value="{{old('start_date')}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">End date:</label>
                                        <div class="col-lg-4">
                                            <input type="date" class="form-control" name="end_date"
                                                   value="{{old('end_date')}}">
                                        </div>
                                    </div>


                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update <i
                                            class="icon-arrow-right14 position-right"></i></button>
                                </div>

                            </form>



                        </div>



                        @if($product->promo->count()>0)
                            <table class="table datatable-responsive-row-control">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Status</th>
                                    <th class="text-center">Sil</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($product->promo as $key=>$promo)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>
                                            {{$promo->code ?? ''}}
                                        </td>

                                        <td>
                                            {{$promo->start_date ?? ''}}
                                        </td>

                                        <td>
                                            {{$promo->end_date ?? ''}}
                                        </td>

                                        <td>
                                          @if($promo->deleted_at)
                                              <span class="btn btn-danger">
                                                  passiv
                                              </span>
                                              @else
                                                <span class="btn btn-primary">
                                                 aktiv
                                              </span>
                                              @endif
                                        </td>

                                        <td>
                                            sil
                                        </td>


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>

            <!-- /basic layout -->
        </div>

    </div>
@endsection
