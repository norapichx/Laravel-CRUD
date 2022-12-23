<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-transform: uppercase">
            Hello : {{Auth::user()->name}} !
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">Roblox Info</div>
                        <div class="class col">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                      <div class="col-sm-8">
                                        <p>Userid : {{$userid_data['id']}}</p>
                                        <p>Name : {{$userid_data['name']}}</p>
                                        <p>Display Name : {{$userid_data['displayName']}}</p>
                                        <p>Create Date : {{$userid_data['created']}}</p>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Json Output :</label>
                                            <input class="form-control" type="text" placeholder="{{$userid_body}}" aria-label="Disabled input example" disabled>
                                            <br>
                                            <input class="form-control" type="text" placeholder="{{$thumnail_body}}" aria-label="Disabled input example" disabled>
                                            <div class="mb-3">
                                                <label for="1" class="form-label"></label>
                                                <textarea class="form-control" id="1" rows="3">{{$userid_body}} {{$thumnail_body}}</textarea>
                                              </div>
                                        </div>
                                        <button class="btn btn-outline-primary" onclick="window.history.back()">Back</button>
                                      </div>
                                      <div class="col-sm-4">
                                        <img src="{{$thumnail_data['data'][0]['imageUrl']}}" class="img-thumbnail border border-secondary border-right-0" alt="" width="500" height="500" style="background-color: rgb(122, 122, 122);">
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
