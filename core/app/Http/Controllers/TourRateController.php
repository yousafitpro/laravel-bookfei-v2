<?php

namespace App\Http\Controllers;

use App\Models\tour;
use App\Models\tourRate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TourRateController extends Controller
{
    private $uploadPath = "uploads/toursRateTable";
    private $title = "Table";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function toggle(Request $request,$id)
    {
        $t=tourRate::find($id);
        if ($t->is_disabled)
        {
            $t->is_disabled=false;
        }
        else
        {
            $t->is_disabled=true;
        }
        $t->save();

            return "ok";

    }
    public function list(Request $request,$id)
    {
if ($id==0)
{
    return redirect()->back()->with('errorMessage',"Please Create Tour First");
}
        $list=tourRate::where("deleted_at",null);
        $tour=tour::find($id);
        if ($request->has("month"))
        {

            $date=Carbon::parse($request->month);
            $list=$list->whereMonth('created_at',$date->month)->whereYear('created_at',$date->year);

        }
        $list=$list->where('tour_id',$id);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();

        $list=$list->chunk(7);

        return view('dashboard.tourRate.list')->with(['list'=>$list,'tour'=>$tour,'sdate'=>$request->month]);
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

        $this->validate($request, [
            'day' => 'required',
            'date' => 'required|date|after_or_equal:start',
            'date' => 'required|date|before_or_equal:end',
        ],[
            'day.required'=>"Error! Please Select a Day"
        ]);

        $data=$request->except('file');

        if (!$request->has("is_disabled"))
        {

            $data['is_disabled']=0;

        }
        else
        {
            $data['is_disabled']=1;
        }


        $city= tourRate::create($data);

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

    //asas
}
