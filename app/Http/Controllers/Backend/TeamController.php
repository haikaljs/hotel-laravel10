<?php

namespace App\Http\Controllers\Backend;

use App\Models\Team;
use App\Models\BookArea;
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

    public function EditTeam($id){
        $team = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('team'));
    }

    public function UpdateTeam(Request $request){
        $team_id = $request->id;
        if($request->file('image')){

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(550, 670)->save('upload/team/'.$name_gen);
            $save_url = 'upload/team/'.$name_gen;
    
            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now()
            ]);
    
            $notification = [
                'message' => 'Team updated with image successfully',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('all.team')->with($notification);
        }else{
            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
               
                'created_at' => Carbon::now()
            ]);
    
            $notification = [
                'message' => 'Team updated without image successfully',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('all.team')->with($notification);
        }
    }

    public function DeleteTeam($id){
        $item = Team::findOrFail($id);
        $img = $item->image;
        unlink($img);

        Team::findOrFail($id)->delete();

        $notification = [
            'message' => 'Team deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ============= Book Area All Methods ==============

    public function BookArea(){
        $book = BookArea::find(1);
        return view('backend.bookarea.book_area', compact('book'));
    }

    public function BookAreaUpdate(Request $request){
        $book_id = $request->id;


        if($request->file('image')){

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/bookarea/'.$name_gen);
            $save_url = 'upload/bookarea/'.$name_gen;
    
            BookArea::findOrFail($book_id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'image' => $save_url,
             
            ]);
    
            $notification = [
                'message' => 'Book Area updated with image successfully',
                'alert-type' => 'success'
            ];
    
            return redirect()->back()->with($notification);
        }
        else{
            BookArea::findOrFail($book_id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
               
                
            ]);
    
            $notification = [
                'message' => 'Book Area updated without image successfully',
                'alert-type' => 'success'
            ];
    
            return redirect()->back()->with($notification);
        }
        
    }

  

}
