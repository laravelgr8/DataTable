<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    function show()
    {
        $data["res"]=DB::table('login')->get();
        return view('home',["data"=>$data]);
    }

    function show2()
    {
        $data["res"]=DB::table('login')->get();
        return view('home2',["data"=>$data]);
    }

    function delete(Request $request)
    {
        $id=$request->allid;
        $data=DB::table('login')->whereIn('id',$id)->delete();
        return $data;
    }
}
