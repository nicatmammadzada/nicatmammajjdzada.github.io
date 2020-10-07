@extends('back.layouts.master')
@section('title','photos')
@section('content')


    <div class="content">
    @include('back.layouts.include.alert-messages')
    <!-- Image grid -->
        <h6 class="content-group text-semibold">
            Image grid

        </h6>


        <div class="row">

            <div class="col-lg-3 col-sm-6">
                <form action="{{route('admin.slider.add')}}" class="form-horizontal" method="Post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="thumbnail">
                        <div class="thumb">
                            <input type="file" name="photo" value="photo add" multiple>
                        </div>

                        <div class="caption">
                            <h6 class="no-margin-top text-semibold"><a href="#" class="text-default"></a> <a href="#"
                                                                                                             class="text-muted"><i
                                        class="icon-download pull-right"></i></a></h6>
                            <input value="əlavə et" type="submit" href="" class="btn btn-primary" style=" width: 100%;">
                        </div>
                    </div>
                </form>
            </div>

            @foreach($sliders as $slider)
                <div class="col-lg-4 col-sm-8">
                    <div class="thumbnail">
                        <div class="thumb">
                            <img src="/uploads/slider/{{$slider->photo}}" alt="" style="height: 100px!important;">

                        </div>

                        <div class="caption">
                            <a class="btn btn-danger" style="width: 100%;" onclick='checkDeleteConfrim("{{route('admin.slider.delete',$slider->id)}}")'> Sil</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>


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
