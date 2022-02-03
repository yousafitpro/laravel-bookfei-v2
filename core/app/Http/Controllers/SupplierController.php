<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $uploadPath = "uploads/suppliers";
    private $title = "Suppliers";
    public function __construct()
    {
        view()->share('title',$this->title);
    }
    public function list(Request $request)
    {
        $list=supplier::where("deleted_at",null);
        if($request->has("status"))
        {
            $list=$list->where('status',$request->status);
        }
        $list=$list->get();
//        foreach ($list as $l)
//        {
//            $l->image=asset("core/public/".$l->image);
//        }
        return view('dashboard.supplier.list')->with(['list'=>$list]);
    }
    public function delete($id)
    {
        $city=Country::find($id);
        $city->deleted_at=Carbon::now();
        if($city->save())
        {
            return redirect()->back()->with('doneMessage', __('backend.deleteDone'));
        }
    }
    public function update(Request $request,$id)
    {


        $city=supplier::find($id);

        $city->name=$request->name;
        $city->type=$request->type;
        $city->supplier_code=$request->supplier_code;
        $city->contact_name=$request->contact_name;
        $city->email=$request->email;
        $city->phone=$request->phone;
        $city->status=$request->status;

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
        return redirect()->back()->with('doneMessage', __('backend.update'));
    }
    public function create(Request $request)
    {

        $data=$request->except('file');
        $city= supplier::create($data);

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
