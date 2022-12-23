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
                    @if(session("success"))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">Table Service</div>
                    </div>
                    <table class="table table-striped table-bordered ">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Edit By</th>
                            <th scope="col">Submit Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($service as $value)
                          <tr>
                            <th>{{$service->firstItem()+$loop->index}}</th>
                            <td>
                                <img src="{{asset($value->service_image)}}" alt="" width="70px" height="70px">
                            </td>
                            <td>{{$value->service_name}}</td>
                            <td>{{$value->user->name}}</td>
                            <td>{{$value->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{url('/service/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="{{url('/service/delete/'.$value->id)}}" class="btn btn-danger" onclick="return confirm('You want to remove this service?')">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$service->links()}}
                    {{-- Recycle Bin --}}

                    <div class="card">
                        <div class="card-header">Roblox Online Username Checker</div>
                        <div class="card-body">
                            <form action="{{route('user_id_check')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id_roblox">Userid Roblox</label>
                                    <input type="text" class="form-control" name="user_id_roblox" value="3883981901">
                                </div>
                                @error('user_id_roblox')
                                    <div class="my-1">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <br>
                                <input type="submit" value="Check" class="btn btn-primary" style="color: black;">
                                <br>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Service</div>
                            <div class="card-body">
                                <form action="{{route('addService')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <input type="text" class="form-control" name="service_name">
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
                                    <input type="submit" value="SAVE" class="btn btn-primary" style="color: black;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
