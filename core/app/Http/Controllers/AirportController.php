<?php

namespace App\Http\Controllers;

use App\Models\airline;
use App\Models\airport;
use App\Models\area;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AirportController extends Controller
{
    private $uploadPath = "uploads/airports";
    private $title = "Airports";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=airport::where("deleted_at",null);
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
        foreach ($list as $l)
        {
            $l->image=asset("core/public/".$l->image);
        }
        return view('dashboard.airport.list')->with(['list'=>$list]);
    }
    public function clear()
    {
        Session::put('searchWord','');
        return redirect(url("admin/airport/list"));
    }
    public function delete($id)
    {
        $city=airport::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {

        $data=$request->except(['file','_token']);
        $city= airport::where('id',$id)->update($data);
        $city=airport::find($id);
        $city->save();
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect(route('admin.airport.list'))->with('doneMessage', __('backend.update'));
    }
    public function create(Request $request)
    {

        $request->validate([
            'IATA_code'=>'required|unique:airports'
        ],[
            'IATA_code.required'=>'IATA code is required',
            'IATA_code.unique'=>'IATA code Should be Unique'
        ]);
        $data=$request->except('file');

        $city= airport::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->image);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->image= $path;

            $city->save();
        }
        return redirect(route('admin.airport.list'))->with('doneMessage', __('backend.addDone'));
    }
    public function deleteBulk(Request $request)
    {
        airport::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function addView(Request $request)
    {
        return view('dashboard.airport.add');
    }
    public function updateView(Request $request,$id)
    {
        $data['Banner']=airport::find($id);
        return view('dashboard.airport.edit',$data);
    }
}
