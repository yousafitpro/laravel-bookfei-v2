<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\area;
use App\Models\hotelRoomType;
use App\Models\tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelRoomTypeController extends Controller
{
    private $uploadPath = "uploads/rooms";
    private $title = "Hotel Rooms";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request,$id)
    {
        $list=hotelRoomType::where("deleted_at",null)->where("hotel_id",$id);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();
        return view('dashboard.hotel-room.list')->with(['list'=>$list,'id'=>$id]);
    }
    public function delete($id)
    {
        $city=hotelRoomType::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {

        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date'
        ]);
        $data=$request->except(['file','_token']);


        if (!$request->has("is_adult"))
        {

            $data['is_adult']=0;

        }
        else
        {
            $data['is_adult']=1;
        }
        if (!$request->has("is_child"))
        {

            $data['is_child']=0;

        }
        else
        {
            $data['is_child']=1;
        }
        if (!$request->has("is_toddler"))
        {

            $data['is_toddler']=0;

        }
        else
        {
            $data['is_toddler']=1;
        }
        if (!$request->has("is_infant"))
        {

            $data['is_infant']=0;

        }
        else
        {
            $data['is_infant']=1;
        }
        if (!$request->has("is_senior"))
        {

            $data['is_senior']=0;

        }
        else
        {
            $data['is_senior']=1;
        }

        hotelRoomType::where('id',$id)->update($data);
        return redirect()->back()->with('doneMessage', __('backend.updateDone'));
    }
    public function create(Request $request)
    {

        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date'
        ]);
        $data=$request->except(['file','_token']);

        if (!$request->has("early_bird"))
        {

            $data['early_bird']=0;

        }
        else
        {
            $data['early_bird']=1;
        }
        if (!$request->has("is_adult"))
        {

            $data['is_adult']=0;

        }
        else
        {
            $data['is_adult']=1;
        }
        if (!$request->has("is_child"))
        {

            $data['is_child']=0;

        }
        else
        {
            $data['is_child']=1;
        }
        if (!$request->has("is_toddler"))
        {

            $data['is_toddler']=0;

        }
        else
        {
            $data['is_toddler']=1;
        }
        if (!$request->has("is_infant"))
        {

            $data['is_infant']=0;

        }
        else
        {
            $data['is_infant']=1;
        }
        if (!$request->has("is_senior"))
        {

            $data['is_senior']=0;

        }
        else
        {
            $data['is_senior']=1;
        }

        $city= hotelRoomType::create($data);

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
