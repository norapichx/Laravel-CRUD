<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello : {{Auth::user()->name}}

            <b class="float-end">Current User : {{count($users)}}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table table-striped table-bordered ">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Create Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1
                        @endphp
                        @foreach ($users as $value)
                        <tr>
                            <th>{{$count++}}</th>
                            <td>{{$value->name}}</td>
                            <td>{{$value->email}}</td>
                            {{-- <td>{{$value->created_at->diffForHumans()}}</td> --}}
                            <td>{{Carbon\Carbon::parse($value->created_at)->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
