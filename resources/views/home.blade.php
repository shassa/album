@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your Albums') }}</div>

                <div class="card-body">
                   
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{session('message')}}
                    </div>
                @endif

                {{-- store album --}}
                <button class="btn btn-primary" data-toggle="modal" data-target="#store_model"style="margin:10px;">
                    <i class="fas fa-plus"></i>
                    Add Album</button>

                    <form method="POST" action="{{route('addalbume')}}" style="border:1px solid black">
                        @CSRF
                        <div class="modal fade" id="store_model" tabindex="-1" role="dialog" 
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">Add New Album</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                           </button>
                                        </div>
                                              <div class="modal-body">
                                                   <label>name</label>
                                                  <input type="text" class="form-control" required name="name">
                                              </div>
                                         <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                              <button type="submit" class="btn btn-primary" id="pbtn">save</button>
                                         </div>
                                      </div>
                                  </div>
                        </div>
                    </form>
           
                    @foreach ($albums as $album)
                      <h2>{{$album->name}}
                        
                        {{-- {{$album->id}} --}}
                       {{-- update album --}}

                        <button class="btn btn-primary" data-toggle="modal" data-target="#update_model{{$album->id}}"style="margin:10px;">
                            <i class="fas fa-plus"></i>
                            Edite Album</button>

                   {{-- delete album --}}

                        <button class="btn btn-primary" data-toggle="modal" data-target="#delete_model{{$album->id}}"style="margin:10px;">
                            <i class="fas fa-plus"></i>
                            Delete Album</button>
                            
                      
                        <button class="btn btn-primary" data-toggle="modal" data-target="#image_model{{$album->id}}"style="margin:10px;">
                                <i class="fas fa-plus"></i>
                                Add Image</button>


                        </h2>
                      <hr>
                      @foreach($album->pictures as $img)
                        <div style="display:inline">
                            {{$img->name}}
                            <img src="{{asset('image/'.$img->file)}}" width="100px" height="200px">
                        </div>
                     @endforeach  
                        <form method="POST" action="{{route('addimage')}}" enctype="multipart/form-data" style="display:inline">
                            @CSRF
                            <div class="modal fade" id="image_model{{$album->id}}" tabindex="-1" role="dialog" 
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Add Image To {{$album->name}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                                <div class="modal-body">
                                                    <label>name</label>
                                                    <input type="text" class="form-control" required name="name">
                                                    <br>
                                                    <input type="file" name="file" class="form-control" >
                                                    <input type="text" name="album_id" value="{{$album->id}}" hidden>
                                                </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                                <button type="submit" class="btn btn-primary" id="pbtn">save</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </form>

                        <form method="POST" action="{{route('deletealbume',$album->id)}}" style="display:inline">
                            @CSRF
                            <div class="modal fade" id="delete_model{{$album->id}}" tabindex="-1" role="dialog" 
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> delete {{$album->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                                <div class="modal-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="radio"  onclick="myFunction2({{$album->id}});" id="flexRadioDefault{{$album->id}}" value="a" checked>
                                                        <label class="form-check-label" for="flexRadioDefault{{$album->id}}">
                                                            Delete Pictures
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="radio" onclick="myFunction({{$album->id}});" id="flexRadioDefault2{{$album->id}}" value="b" >
                                                        <label class="form-check-label" for="flexRadioDefault2{{$album->id}}">
                                                            Move pictures to                                                        </label>
                                                    </div>
                                                        <select class="form-control" name="selector" id="selector{{$album->id}}" style="display: none" >
                                                            @foreach($arr as $item)
                                                            <option value='{{$item->id}}'>{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                                <button type="submit" class="btn btn-primary" id="pbtn">continue</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </form>
                                           
                        <form method="POST" action="{{route('edite',$album->id)}}" style="display:inline">
                            @CSRF
                            <div class="modal fade" id="update_model{{$album->id}}" tabindex="-1" role="dialog" 
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> update {{$album->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                                <div class="modal-body">
                                                    <label>name</label>
                                                    <input type="text" class="form-control" required name="name">
                                                </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                                <button type="submit" class="btn btn-primary" id="pbtn">update</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
  
@endsection
