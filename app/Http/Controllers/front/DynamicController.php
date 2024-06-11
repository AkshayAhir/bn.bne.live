<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class DynamicController extends Controller
{
    public function getPage($slug){
        if(Page::where('permalink',$slug)->exists()){
            $data = Page::where('permalink',$slug)->first();
            $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
            return view('front.pages.dynamic-page',compact('page','data'));  
        }else{
            abort(404);
        }
       
    }
}
  

