<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-transform: uppercase">
            Hello : {{Auth::user()->name}} !
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Service</div>
                        <div class="card-body">
                            <form action="{{url('/service/update/'.$edit_service->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">Service Name</label>
                                    <input type="text" class="form-control" name="service_name" value="{{$edit_service->service_name}}">
                                </div>
                                @error('service_name')
                                    <div class="my-1">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group">
                                    <label for="service_image">Image</label>
                                    <input type="file" class="form-control" name="service_image">
                                </div>
                                @error('service_image')
                                    <div class="my-1">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <br>
                                <input type="hidden" name="old_image" value="{{asset($edit_service->service_image)}}">
                                <div class="from-group">
                                    <img src="{{asset($edit_service->service_image)}}" alt="" width="300px" height="300px">
                                </div>
                                <input type="submit" value="update" class="btn btn-primary" style="color: black;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
