<?php

namespace App\Http\Controllers;

use App\Models\myfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyFileController extends Controller
{

    public static function upload(Request $request)
    {
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $myfile=new myfile();
            $myfile->type=$request->type;
            $myfile->item_id=$request->item_id;
            $myfile->extension=$extension;
            $myfile->save();
            $path = $request->file('file')->storeAs('uploads/myfiles',$myfile->id.'.'.$extension);
            $myfile->path= $path;
            $myfile->save();
            return response()->json(['message'=>"File Successfully Uploaded"]);
        }
    }
    public static function list(Request $request)
    {
        $list=myfile::where('type',$request->type)->where('item_id',$request->item_id)->get();
        return $list;
    }
    public function removeFile(Request $request)
    {
        $file=myfile::find($request->id);
        Storage::disk('public')->delete($file->path);
        $file->delete();
        return response()->json(['message'=>"File Successfully Deleted"]);

    }
    public static function getCardImages(Request $request)
    {
      $list=myfile::where('type',$request->type)->where('item_id',$request->item_id)->get();
        foreach ($list as $l)
        {
            $l->image=asset("core/public/".$l->path);
        }
        return view('fileUploader.images',['list'=>$list,'type'=>$request->type,'item_id'=>$request->item_id]);


    }
}
