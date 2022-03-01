<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\area;
use App\Models\cruiseShipRoomType;
use App\Models\hotelRoomType;
use App\Models\tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CruiseShipRoomTypeController extends Controller
{
    private $uploadPath = "uploads/cruise/rooms";
    private $title = "Ship Rooms";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request,$id)
    {
        $list=cruiseShipRoomType::where("deleted_at",null)->where("cruise_ship_id",$id);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();
        return view('dashboard.cruiseline.rooms')->with(['list'=>$list,'id'=>$id]);
    }
    public function delete($id)
    {
        $city=cruiseShipRoomType::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {

        $data=$request->except(['_token']);

        cruiseShipRoomType::where('id',$id)->update($data);
        return redirect()->back()->with('doneMessage', __('backend.updateDone'));
    }
    public function create(Request $request)
    {

        $data=$request->except(['_token']);
        $city= cruiseShipRoomType::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect()->back()->with('doneMessage', __('backend.addDone'));
    }
}
