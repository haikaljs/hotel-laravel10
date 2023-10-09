<?php

namespace App\Http\Controllers\Backend;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allData = RoomType::orderBy('id', 'desc')->get();
        return view('backend.allroom.roomtype.view_roomtype', compact('allData'));
    }
}
