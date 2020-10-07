@extends('back.layouts.master')
@section('title','product-edit')

@section('head')
    {{--    <script type="text/javascript" src="/back/assets/js/plugins/loaders/pace.min.js"></script>--}}
    <script type="text/javascript" src="/back/assets/js/pages/form_checkboxes_radios.js"></script>
@endsection

@section("content")
    <div class="row" id="categoryDiv">
        <div class="col-md-12">

            <!-- Basic layout-->
            <form action="{{route('admin.photo.store',$photo->id)}}" class="form-horizontal"
                  method="POST" novalidate="" enctype="multipart/form-data"
                  autocomplete="off">


                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">edit</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    @include('back.layouts.include.alert-messages')

                    <div class="panel-body">
                        <div class="form-group">
{{--                            <label class="col-lg-2 control-label"> Product name*:</label>--}}
                     
                     
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Photo:</label>
                            <div class="col-lg-9">
                                <div class="thumbnail" style="width: 30%">
                                    <div class="thumb">
                                        <img src="{{asset("uploads/gallery").'/'.$photo->name ?? ''}}" alt="">
                                        <div class="caption-overflow">
										<span>
											<a href="{{asset("uploads/gallery").'/'.$photo->name ?? ''}}" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
										</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"></label>
                            <div class="col-lg-9">
                                <input type="file" name="photo" id="productPhoto" class="file-styled" >
                                <span class="help-block">Qəbul edilən uzantılar: gif, png, jpg, jpeg. Maksimum həcm 500 kb olmalıdır.</span>
                            </div>
                        </div>

                        </div>
                        <div class="col-lg-3" style="float:right;">
                            <input type="submit" class="btn btn-primary" value="ok"
                            >
                        </div>


                    </div>
                </div>

            </form>





        </div>


    </div>





@endsection

@section('foot')

@endsection

