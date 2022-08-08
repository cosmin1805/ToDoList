<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;

class ToDoListController extends Controller
{
    //
    public function index($id){
        return view('welcome',['listItems' => ListItem::all()],['view'=>$id]);
    }
    public function index_f(){
        return view('welcome',['listItems' => ListItem::all()],['view'=>-1]);
    }
    public function markDone($id,$view){
        $listItem= ListItem::find($id);
        if($listItem->is_complete==1)
            $listItem->is_complete =0;
        else
            $listItem->is_complete =1;
        $listItem->save();
        $url = "/".$view;
        return redirect($url);
    }

    public function saveItem(Request $request){
        $newListItem = new ListItem;
        $newListItem ->name=$request->listItem;
        $newListItem ->name=$request->listItem;
        $newListItem ->is_complete = false;
        $newListItem ->save();

        return redirect('/');
    }
}
