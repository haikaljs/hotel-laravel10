<?php

namespace App\Http\Controllers\Backend;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function AllTeam(){
        $team = Team::latest()->get(); 
        return view('backend.team.all_team', compact('team'));
    }

    public function AddTeam(){
        return view('backend.team.add_team');
    }

    public function TeamStore(Request $request){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(550, 670)->save('upload/team/'.$name_gen);
        $save_url = 'upload/team/'.$name_gen;

        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Team Data Inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.team')->with($notification);
    }
}
