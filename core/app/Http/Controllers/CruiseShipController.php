<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\area;
use App\Models\city;
use App\Models\cruiseLine;
use App\Models\cruiseShip;

use App\Models\cruiseShipRateTable;
use App\Models\cruiseShipRoomType;
use App\Models\tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CruiseShipController extends Controller
{
    private $uploadPath = "uploads/cruiseShips";
    private $title = "cruiseShips";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {

        $list=cruiseShip::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        if ($request->has('cruise_line') && $request->cruise_line!="none")
        {
            $city= cruiseLine::find($request->cruise_line);

            Session::put('cruise_line_id',$city->id);
            Session::put('cruise_line_name',$city->name);
            $list=$list->where('cruise_line_id',$city->id);
        }
        else
        {
            Session::put('cruise_line_id','none');
            Session::put('cruise_line_name',"All");
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
        return view('dashboard.ships.list')->with(['list'=>$list]);
    }
    public function editOrCreate(Request $request,$id)
    {
        $data['cruiseShip']=cruiseShip::find($id);
        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create a cruiseShip first");
        }

        $data['cruiseShip_id']=$id;
        $data['rateTables']=[];
        $data['roomTypes']=[];
        if ($id!=0)
        {
            $data['rateTables']=cruiseShipRateTable::where("deleted_at",null)->where("cruise_ship_id",$id)->get();
            $data['roomTypes']=cruiseShipRoomType::where("deleted_at",null)->where("cruise_ship_id",$id)->get();
            $data['cruiseShip']=cruiseShip::find($id);
        }


        return view('dashboard.ships.tabs',$data);
    }
    public function delete($id)
    {
        $city=cruiseShip::find($id);
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

        $city= cruiseShip::where('id',$id)->update($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }

        return redirect(route('admin.cruiseShip.editOrCreate',$id).'?tab=Basic')->with('doneMessage', __('backend.updateDone'));

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

        $city= cruiseShip::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }

        return redirect(route('admin.cruiseShip.editOrCreate',$city->id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));

    }
    public function deleteBulk(Request $request)
    {
        cruiseShip::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
}
