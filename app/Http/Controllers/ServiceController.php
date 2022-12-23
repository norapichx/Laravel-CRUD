<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ServiceController extends Controller
{
    public function index(){
        // $client = new Client();
        // $res_users = $client->request('GET', 'http://127.0.0.1:8000/api/users');
        // $users_body = json_decode($res_users->getBody()->getContents());

        $service = Service::paginate(10);

        return view('admin.service.index', compact('service'));
    }

    public function edit($id){
        $edit_service = Service::find($id);
        return view('admin.service.edit', compact('edit_service'));
    }

    public function update(Request $request , $id){
        $request->validate(
            [
                'service_name' => 'required|unique:services|max:255'
            ],
            [
                'service_name.required' => 'please fill the infomation.',
                'service_name.max' => 'do not fill character more than 255.'
            ],);

        $service_image = $request->file('service_image');
        if($service_image){
            $gen_name = hexdec(uniqid());
            $img_name = $gen_name.".".strtolower($service_image->getClientOriginalExtension());

            $upload_location = 'image/service/';
            $full_path = $upload_location.$img_name;

            // updata data
            Service::find($id)->update([
                'service_name'=>$request->service_name,
                'service_image'=>$full_path
            ]);
            $old_image = $request->old_image;
            @unlink($old_image);
            $service_image->move($upload_location, $img_name);
            return redirect()->route('service')->with('success','Update Name & Picture Success!');
        }else{
            Service::find($id)->update([
                'service_name'=>$request->service_name
            ]);
            return redirect()->route('service')->with('success','Update Name Success!');
        }
        // $full_path = $upload_location.$img_name;
        // Service::insert([
        //     'service_name'=>$request->service_name,
        //     'service_image'=>$full_path,
        //     'created_at'=>Carbon::now()
        // ]);
        // $service_image->move($upload_location, $img_name);

        // return redirect()->back()->with('success','Data has been save!');

        // return redirect()->route('service')->with('success', 'Update Success');
    }

    public function delete($id){
        $delete = Service::find($id)->forceDelete();
        return redirect()->back()->with('success', 'Permanence Delete Success');
    }

    public function store(Request $request){
        $request->validate(
            [
                'service_name' => 'required|unique:services|max:255',
                'service_image' => 'required|mimes:jpg,jpeg,png'
            ],
            [
                'service_name.required' => 'please fill the infomation.',
                'service_name.max' => 'do not fill character more than 255.',
                'service_name.unique' => 'Data duplicated.',
                'service_image.required' => 'please import picture.'
            ],);
        $gen_name = hexdec(uniqid());
        $service_image = $request->file('service_image');
        $img_name = $gen_name.".".strtolower($service_image->getClientOriginalExtension());
        $upload_location = 'image/service/';
        $full_path = $upload_location.$img_name;

        $userid = Auth::user()->id;
        Service::insert([
            'service_name'=>$request->service_name,
            'service_image'=>$full_path,
            'service_editby'=>$userid,
            'created_at'=>Carbon::now()
        ]);
        $service_image->move($upload_location, $img_name);

        return redirect()->back()->with('success','Data has been save!');
    }

    public function api_usercheck(Request $request){
        // dd($request->user_id_roblox);
        $request->validate(
            [
                'user_id_roblox' => 'required|unique:services|max:255',
                'user_id_roblox' => 'required|integer'
            ]);
        $userid = $request->user_id_roblox;
        $client = new Client();
        $res_userid = $client->request('GET', 'https://users.roblox.com/v1/users/'.$userid);
        $res_thumnail = $client->request('GET', 'https://thumbnails.roblox.com/v1/users/avatar-headshot?userIds='.$userid.'&size=420x420&format=Png&isCircular=false');
        $userid_body = $res_userid->getBody();
        $thumnail_body = $res_thumnail->getBody();


        $userid_data = json_decode($userid_body, true);
        $thumnail_data = json_decode($thumnail_body, true);
        return view('admin.service.roblox_user_data', compact('userid_body','userid_data','thumnail_body','thumnail_data'));
    }

    public function user_data(){

    }
}
