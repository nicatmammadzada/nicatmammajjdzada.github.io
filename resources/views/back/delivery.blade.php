@extends('back.layouts.master')
@section('title','delivery')
@section('head')
    <script type="text/javascript" src="/back/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        @include('back.layouts.include.alert-messages')
        <!-- Basic layout-->
            <form action="{{route('admin.delivery.store')}}" class="form-horizontal" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"></h5>

                    </div>
                    <div class="panel-body">
{{--                        <div class="form-group">--}}
{{--                            <label class="col-lg-3 control-label">Photo:</label>--}}
{{--                            <div class="col-lg-9">--}}
{{--                                <input type="file" class="form-control" name="photo" value="{{old('photo',$delivery->photo)}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Text:</label>
                            <div class="col-lg-10">
                                <textarea class="ckeditor" name="text" id="editor-readonly" rows="5" cols="5">
                                        {{old('text',$delivery->text)}}
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
