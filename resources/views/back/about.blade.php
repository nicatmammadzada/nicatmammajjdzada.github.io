@extends('back.layouts.master')
@section('title','haqqinda')
@section('head')
    <script type="text/javascript" src="/back/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        @include('back.layouts.include.alert-messages')
        <!-- Basic layout-->
            <form action="{{route('admin.about.store')}}" class="form-horizontal" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"></h5>

                    </div>
                    <div class="panel-body">




                        <div class="form-group">
                            <label class="col-lg-3 control-label">Banner:</label>
                            <div class="col-lg-9">
                                <div class="thumbnail" style="width: 30%">
                                    <div class="thumb" >
                                        <img src="{{asset("uploads/photo").'/'.$about->banner ?? ''}}" alt="">
                                        <div class="caption-overflow">
										<span>
											<a href="{{asset("uploads/photo").'/'.$about->banner ?? ''}}" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
										</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"></label>
                            <div class="col-lg-9">
                                <input type="file" name="banner" id="productPhoto" class="form-control" >
                                <span class="help-block">Qəbul edilən uzantılar: gif, png, jpg, jpeg. Maksimum həcm 500 kb olmalıdır.</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-3 control-label">Photo:</label>
                            <div class="col-lg-9">
                                <div class="thumbnail" style="width: 30%">
                                    <div class="thumb" >
                                        <img src="{{asset("uploads/photo").'/'.$about->photo ?? ''}}" alt="">
                                        <div class="caption-overflow">
										<span>
											<a href="{{asset("uploads/photo").'/'.$about->photo ?? ''}}" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
										</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"></label>
                            <div class="col-lg-9">
                                <input type="file" name="photo" id="productPhoto" class="form-control" >
                                <span class="help-block">Qəbul edilən uzantılar: gif, png, jpg, jpeg. Maksimum həcm 500 kb olmalıdır.</span>
                            </div>
                        </div>






                        <div class="form-group">
                            <label class="col-lg-2 control-label">Text1:</label>
                            <div class="col-lg-10">
                                <textarea class="ckeditor" name="text1" id="editor-readonly" rows="5" cols="5">
                                        {{old('text1',$about->text1)}}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Text2:</label>
                            <div class="col-lg-10">
                                <textarea class="ckeditor" name="text" id="editor-readonly" rows="5" cols="5">
                                        {{old('text',$about->text)}}
                                </textarea>
                            </div>
                        </div>





                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Yenilə <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>

    </div>
@endsection
