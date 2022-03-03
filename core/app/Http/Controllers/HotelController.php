<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Gendergroup;
use App\Models\area;
use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\hotelRoomType;
use App\Models\tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    private $uploadPath = "uploads/hotels";
    private $title = "Hotels";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=hotel::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();
        return view('dashboard.hotel.list')->with(['list'=>$list]);
    }
    public function editOrCreate(Request $request,$id)
    {
        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create a Hotel first");
        }
        $data['hotel_id']=$id;
        $data['rateTables']=[];
        $data['roomTypes']=[];
        if ($id!=0)
        {
            $data['rateTables']=hotelRateTable::where("deleted_at",null)->get();
            $data['roomTypes']=hotelRoomType::where("deleted_at",null)->where("hotel_id",$id)->get();
            $data['hotel']=hotel::find($id);
        }


        return view('dashboard.hotel.tabs',$data);
    }
    public function delete($id)
    {
        $city=hotel::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Gendergroup $request,$id)
    {



        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date',

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

        $city= hotel::where('id',$id)->update($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect(route('admin.hotel.editOrCreate',$id).'?tab=RoomType')->with('doneMessage', __('backend.updateDone'));

    }
    public function create(Gendergroup $request)
    {


        $data=$request->except('file');

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

        $city= hotel::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }

        return redirect(route('admin.hotel.editOrCreate',$city->id).'?tab=RoomType')->with('doneMessage', __('backend.addDone'));

    }
}
