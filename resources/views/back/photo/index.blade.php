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
                <form action="{{route('admin.photo.create')}}" class="form-horizontal" method="Post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="thumbnail">
                        <div class="thumb">
                            <input type="file" name="photo[]" value="photo add" multiple>
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

            @foreach($photos as $key=>$photo)
                <div class="col-lg-4 col-sm-8">
                    <div class="thumbnail">
                        <div class="thumb">
                            <img src="/uploads/gallery/{{$photo->name}}" alt=""
                                 style="height: 100px!important;    object-fit: contain;">
                            <div class="caption-overflow">
										<span>


                                            ''


											<a href="/uploads/gallery/{{$photo->name}}" data-popup="lightbox"
                                               class="btn border-white text-white btn-flat btn-icon btn-rounded"><i
                                                    class="icon-plus3"></i></a>
											<a href=""
                                               class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i
                                                    class="icon-link2"></i></a>
										</span>
                            </div>
                        </div>

                        <div class="caption">
                            <h6 style="font-size: 11px;" class="no-margin-top text-semibold"><a
                                                                                                class="text-default">
<input type="text" class="form-control myInput" id="myInput" readonly value="/uploads/gallery/{{$photo->name ?? 'logo name'}}">
                                    <button style="width: 100%" class="btn btn-success" onclick="myFunction({{$key}})">Copy Path</button>



                                </a>
                            </h6>
                               <!--      <a href="{{route('admin.photo.edit',$photo->id)}}" class="btn btn-primary"-->
                               <!--style=" width: 100%;">Edit</a>-->
                            
                            <a href="{{route('admin.photo.remove',$photo->id)}}" class="btn btn-danger"
                               style=" width: 100%;">delete</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>


    </div>

@endsection


@section('foot')
    <script>
        function myFunction(id) {

            /* Get the text field */
            var copyText = document.getElementsByClassName("myInput")[id];

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */

        }
    </script>

    @endsection
