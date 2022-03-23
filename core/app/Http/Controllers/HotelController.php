<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Gendergroup;
use App\Models\area;
use App\Models\city;
use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\hotelRoomType;
use App\Models\tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        if ($request->has('city') && $request->city!="none")
        {
            $city= city::find($request->city);
            Session::put('city_id',$city->id);
            Session::put('city_name',$city->name);
            $list=$list->where('city_id',$city->id);
        }
        else
        {
            Session::put('city_id','none');
            Session::put('city_name',"All");
        }
        if ($request->has('searchWord') && $request->searchWord!="")
        {
            $list=$list->where('name', 'LIKE',"%{$request->searchWord}%");
            Session::put('searchWord',$request->searchWord);
        }
        else
        {
            Session::put('searchWord','');
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
            $data['rateTables']=hotelRateTable::where("deleted_at",null)->where("hotel_id",$id)->get();
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
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);

            if ($request->has("is_adult"))
            {
                $this->validate($request, [
                    'adult_age_end'=>'required|gt:adult_age_start'
                ]);
            }
        if ($request->has("is_child"))
        {
            $this->validate($request, [
                'child_age_end'=>'required|gt:child_age_start'
            ]);
        }
        if ($request->has("is_toddler"))
        {
            $this->validate($request, [
                'toddler_age_end'=>'required|gt:toddler_age_start'
            ]);
        }
        if ($request->has("is_infant"))
        {
            $this->validate($request, [
                'infant_age_end'=>'required|gt:infant_age_start'
            ]);
        }


        if ($request->has("is_senior"))
        {
            $this->validate($request, [
                'senior_age_end'=>'required|gt:senior_age_start'
            ]);
        }
        if ($request->has("is_child") && $request->has("is_adult"))
        {
            $this->validate($request, [
                'child_age_end'=>'required|in:'.($request->adult_age_start-1).'',
                'adult_age_start'=>'required|gt:child_age_end',
            ]);
        }
        if ($request->has("is_toddler") && $request->has("is_child"))
        {
            $this->validate($request, [
                'toddler_age_end'=>'required|in:'.($request->child_age_start-1).'',
                'child_age_start'=>'required|gt:toddler_age_end',
            ]);
        }
        if ($request->has("is_infant") && $request->has("is_toddler"))
        {
            $this->validate($request, [
                'infant_age_end'=>'required|in:'.($request->toddler_age_start-1).'',
                'toddler_age_start'=>'required|gt:infant_age_end',
            ]);
        }
        if ($request->has("is_senior") && $request->has("is_adult"))
        {
            $this->validate($request, [
                'senior_age_start'=>'required|in:'.($request->adult_age_end+1).'',
            ]);
        }
        if ($request->has("is_adult"))
        {
            if ($request->has("is_child"))
            {
                $this->validate($request, [
                    'adult_age_start'=>'required|gt:child_age_end',
                ]);
            }
            if ($request->has("is_toddler"))
            {
                $this->validate($request, [
                    'adult_age_start'=>'required|gt:toddler_age_end',
                ]);
            }
            if ($request->has("is_infant"))
            {
                $this->validate($request, [
                    'adult_age_start'=>'required|gt:infant_age_end',
                ]);
            }

        }
        if ($request->has("is_child"))
        {
            if ($request->has("is_toddler"))
            {
                $this->validate($request, [
                    'child_age_start'=>'required|gt:toddler_age_end',
                ]);
            }
            if ($request->has("is_infant"))
            {
                $this->validate($request, [
                    'child_age_start'=>'required|gt:infant_age_end',
                ]);
            }

        }
        if ($request->has("is_toddler"))
        {
            if ($request->has("is_infant"))
            {
                $this->validate($request, [
                    'toddler_age_start'=>'required|gt:infant_age_end',
                ]);
            }

        }

        $data=$request->except(['file','_token','redirectUrl']);


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
if ($request->redirectUrl=='')
{
    return redirect()->back()->with('doneMessage', __('backend.updateDone'));
}
        return redirect($request->redirectUrl);

    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        if ($request->has("is_adult"))
        {
            $this->validate($request, [
                'adult_age_end'=>'required|gt:adult_age_start'
            ]);
        }
        if ($request->has("is_child"))
        {
            $this->validate($request, [
                'child_age_end'=>'required|gt:child_age_start'
            ]);
        }
        if ($request->has("is_toddler"))
        {
            $this->validate($request, [
                'toddler_age_end'=>'required|gt:toddler_age_start'
            ]);
        }
        if ($request->has("is_infant"))
        {
            $this->validate($request, [
                'infant_age_end'=>'required|gt:infant_age_start'
            ]);
        }


        if ($request->has("is_senior"))
        {
            $this->validate($request, [
                'senior_age_end'=>'required|gt:senior_age_start'
            ]);
        }
        if ($request->has("is_child") && $request->has("is_adult"))
        {
            $this->validate($request, [
                'child_age_end'=>'required|in:'.($request->adult_age_start-1).'',
                'adult_age_start'=>'required|gt:child_age_end',
            ]);
        }
        if ($request->has("is_toddler") && $request->has("is_child"))
        {
            $this->validate($request, [
                'toddler_age_end'=>'required|in:'.($request->child_age_start-1).'',
                'child_age_start'=>'required|gt:toddler_age_end',
            ]);
        }
        if ($request->has("is_infant") && $request->has("is_toddler"))
        {
            $this->validate($request, [
                'infant_age_end'=>'required|in:'.($request->toddler_age_start-1).'',
                'toddler_age_start'=>'required|gt:infant_age_end',
            ]);
        }
        if ($request->has("is_senior") && $request->has("is_adult"))
        {
            $this->validate($request, [
                'senior_age_start'=>'required|in:'.($request->adult_age_end+1).'',
            ]);
        }
        if ($request->has("is_adult"))
        {
            if ($request->has("is_child"))
            {
                $this->validate($request, [
                    'adult_age_start'=>'required|gt:child_age_end',
                ]);
            }
            if ($request->has("is_toddler"))
            {
                $this->validate($request, [
                    'adult_age_start'=>'required|gt:toddler_age_end',
                ]);
            }
            if ($request->has("is_infant"))
            {
                $this->validate($request, [
                    'adult_age_start'=>'required|gt:infant_age_end',
                ]);
            }

        }
        if ($request->has("is_child"))
        {
            if ($request->has("is_toddler"))
            {
                $this->validate($request, [
                    'child_age_start'=>'required|gt:toddler_age_end',
                ]);
            }
            if ($request->has("is_infant"))
            {
                $this->validate($request, [
                    'child_age_start'=>'required|gt:infant_age_end',
                ]);
            }

        }
        if ($request->has("is_toddler"))
        {
            if ($request->has("is_infant"))
            {
                $this->validate($request, [
                    'toddler_age_start'=>'required|gt:infant_age_end',
                ]);
            }

        }

        $data=$request->except('file','redirectUrl');

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
        if ($request->redirectUrl=='')
        {
            return redirect(route('admin.hotel.editOrCreate',$city->id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));

        }
        return redirect($request->redirectUrl);
        return redirect(route('admin.hotel.editOrCreate',$city->id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));

    }
    public function deleteBulk(Request $request)
    {
        hotel::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
}
