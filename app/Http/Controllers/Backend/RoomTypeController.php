<?php

namespace App\Http\Controllers\Backend;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allData = RoomType::orderBy('id', 'desc')->get();
        return view('backend.allroom.roomtype.view_roomtype', compact('allData'));
    }

    public function AddRoomType(){
        return view('backend.allroom.roomtype.add_roomtype');
    }

    public function RoomTypeStore(Request $request){
        RoomType::insert([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Room Type inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('room.type.list')->with($notification);
    }


}
