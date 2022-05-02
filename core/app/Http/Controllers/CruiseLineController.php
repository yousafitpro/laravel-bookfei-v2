<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Models\cruiseLine;
use App\Models\tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CruiseLineController extends Controller
{
    private $uploadPath = "uploads/cruiselines";
    private $title = "Cruise Lines";
    public function __construct()
    {
        view()->share('title',$this->title);
    }

    public function list(Request $request)
    {
        $list=cruiseLine::where("deleted_at",null);
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
            $l->image=asset("core/public/".$l->logo);
        }

        return view('dashboard.cruiseline.list')->with(['list'=>$list]);
    }
    public function delete($id)
    {
        $city=cruiseLine::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'english_name'=>'required',
            'status'=>'required',
            'file'=>'required'
        ]);
        $data=$request->except(['file','redirectUrl','_token']);
        cruiseLine::where('id',$id)->update($data);
        $city=cruiseLine::find($id);
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->logo);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->logo= $path;

            $city->save();
        }
        if ($request->redirectUrl=='')
        {
            return redirect()->back()->with('doneMessage', __('backend.update'));

        }
        return redirect($request->redirectUrl)->with('doneMessage', __('backend.addDone'));
    }
    public function create(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'english_name'=>'required',
            'status'=>'required',
            'file'=>'required'
        ]);
        $data=$request->except(['file','redirectUrl']);
        $city= cruiseLine::create($data);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->delete($city->logo);
            $path = $request->file('file')->storeAs($this->uploadPath,$city->id.'.'.$extension);

            $city->logo= $path;

            $city->save();
        }
        if ($request->redirectUrl=='')
        {
            return redirect()->back()->with('doneMessage', __('backend.update'));

        }
        return redirect($request->redirectUrl)->with('doneMessage', __('backend.addDone'));    }
    public function deleteBulk(Request $request)
    {
        cruiseLine::whereIn('id', $request->data)->update(['deleted_at'=>Carbon::now()]);

        if(Request::capture()->expectsJson())
        {
            return response()->json(['message'=>"Operation Successful"]);
        }
    }
    public function addView(Request $request)
    {
        return view('dashboard.cruiseline.add');
    }
    public function updateView(Request $request,$id)
    {
        $data['Banner']=cruiseLine::find($id);
        return view('dashboard.cruiseline.edit',$data);
    }
}
