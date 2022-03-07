<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\area;
use App\Models\hotel;
use App\Models\hotelRateTable;
use App\Models\hotelRoomType;
use App\Models\tour;
use App\Models\tourRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    private $uploadPath = "uploads/tours";
    private $title = "Tours";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=tour::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
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
        return view('dashboard.tour.list')->with(['list'=>$list]);
    }
    public function editOrCreate(Request $request,$id)
    {
        if ($id==0 && $request->tab!="Basic")
        {
            return redirect()->back()->with('errorMessage', "Please Create a Hotel first");
        }
        $data['tour_id']=$id;
        if ($id!=0)
        {

            $data['tour']=tour::find($id);

        }


        return view('dashboard.tour.tabs',$data);

    }
    public function delete($id)
    {
        $city=tour::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {

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

        $city= tour::where('id',$id)->update($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect()->back()->with('doneMessage', __('backend.updateDone'));
    }
    public function create(Request $request)
    {
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
        $this->validate($request, [
            'effective_end_date' => 'after_or_equal:effective_start_date'
        ]);
        $data=$request->except('file');

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

        $city= tour::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect(route('admin.tour.editOrCreate',$city->id).'?tab=Basic')->with('doneMessage', __('backend.addDone'));
    }
    public function deleteBulk(Request $request)
    {
        tour::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
}
