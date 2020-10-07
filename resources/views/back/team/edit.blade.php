@extends('back.layouts.master')
@section('title','team-edit')
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


                        <div class="panel-body" style="display: block;">


                            <div class="row">
                                <div class="">
                                    <div class="panel panel-flat">


                                        <div class="panel-body" style="display: block;">
                                            <div class="panel-heading">
                                                <h5 class="panel-title label label-success"></h5>
                                                <div class="heading-elements">
                                                    {{--                                                        <a href="{{route('admin.product.index'}}"><span--}}
                                                    {{--                                                                class="label label-success">KURSLARA QAYIT</span></a>--}}
                                                </div>
                                            </div>
                                            <form action="{{route('admin.team.update',$team->id)}}"
                                                  class="form-horizontal"
                                                  method="Post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Ad:</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{old('name',$team->name)}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Ixtisas:</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="profession"
                                                               value="{{old('profession',$team->profession)}}">
                                                    </div>
                                                </div>


{{--                                                <div class="form-group">--}}
{{--                                                    <label class="col-lg-3 control-label">Ətrafli:</label>--}}
{{--                                                    <div class="col-lg-9">--}}
{{--                                <textarea class="ckeditor" name="text" id="editor-readonly" rows="5" cols="5">--}}
{{--                                        {{old('text',$team->text)}}--}}
{{--                                </textarea>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}


                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Photo:</label>
                                                    <div class="col-lg-9">
                                                        <div class="thumbnail" style="width: 30%">
                                                            <div class="thumb">
                                                                <img
                                                                    src="{{asset("uploads/team").'/'.$team->photo ?? ''}}"
                                                                    alt="">
                                                                <div class="caption-overflow">
										<span>
											<a href="{{asset("uploads/product").'/'.$team->photo ?? ''}}"
                                               data-popup="lightbox" rel="gallery"
                                               class="btn border-white text-white btn-flat btn-icon btn-rounded"><i
                                                    class="icon-plus3"></i></a>
										</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"></label>
                                                    <div class="col-lg-9">
                                                        <input type="file" name="photo" id="productPhoto"
                                                               class="file-styled"
                                                               value="{{old('photo',$team->photo)}}">
                                                        <span class="help-block">Qəbul edilən uzantılar: gif, png, jpg, jpeg. Maksimum həcm 200kb olmalıdır.</span>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">Create <i
                                                            class="icon-arrow-right14 position-right"></i></button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>

            </div>

            <!-- /basic layout -->
        </div>

    </div>
@endsection
