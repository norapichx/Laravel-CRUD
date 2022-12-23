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
                        <div class="card-header">Edit Form</div>
                        <div class="card-body">
                            <form action="{{url('/department/update/'.$department->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">Position</label>
                                <input type="text" class="form-control" name="department_name" value="{{$department->department_name}}" >
                                </div>
                                @error('department_name')
                                    <div class="my-1">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <br>
                                <input type="submit" value="update" class="btn btn-primary" style="color: black;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
