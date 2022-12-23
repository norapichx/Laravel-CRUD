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
                    {{-- Table Department --}}
                    <div class="card">
                        <div class="card-header">Table Department</div>
                    </div>
                    <table class="table table-striped table-bordered ">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Position</th>
                            <th scope="col">Edit By</th>
                            <th scope="col">Submit Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach ($departments as $value)
                          <tr>
                            <th>{{$departments->firstItem()+$loop->index}}</th>
                            <td>{{$value->department_name}}</td>
                            <td>{{$value->user->name}}</td>
                            <td>{{$value->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{url('/department/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="{{url('/department/softdelete/'.$value->id)}}" class="btn btn-warning">Soft Delete</a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$departments->links()}}
                    {{-- Recycle Bin --}}
                    @if(count($trashdepartments)>0)
                    <div class="card">
                        <div class="card-header">Recycle Bin</div>
                    </div>
                    <table class="table table-striped table-bordered ">
                        @php
                            $count = 1
                        @endphp
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Position</th>
                            <th scope="col">Edit By</th>
                            <th scope="col">Submit Date</th>
                            <th scope="col">Restore</th>
                            <th scope="col">Delete Permanent</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($trashdepartments as $value)
                          <tr>
                            <th>{{$trashdepartments->firstItem()+$loop->index}}</th>
                            <td>{{$value->department_name}}</td>
                            <td>{{$value->user_ids}}</td>
                            <td>{{$value->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{url('/department/restore/'.$value->id)}}" class="btn btn-primary">Restore</a>
                            </td>
                            <td>
                                <a href="{{url('/department/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      {{$trashdepartments->links()}}
                      @endif
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Form</div>
                        <div class="card-body">
                            <form action="{{route('addDepartment')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">Position Name</label>
                                <input type="text" class="form-control" name="department_name">
                                </div>
                                @error('department_name')
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
</x-app-layout>
