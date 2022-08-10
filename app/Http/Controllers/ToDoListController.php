<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;
use Illuminate\Support\Facades\DB;



class ToDoListController extends Controller
{
    //
    public function index($id=-1){
        return view('welcome',['listItems' => ListItem::all()],['view'=>$id]);
    }

    //to delete the wanted values from the DB
    public function delete($id,$view){
        $id = rtrim($id, ".");

        $id_array = explode(",",$id);
        foreach($id_array as $value)
        {
           DB::delete('delete from list_items where id = ?',[$value]); 
        }
        
        return redirect("/".$view);
    }

    //to mark as done the wanted values from the DB
    public function markDone($id,$view){
        $listItem= ListItem::find($id);
        if($listItem->is_complete==1)
            $listItem->is_complete =0;
        else
            $listItem->is_complete =1;
        $listItem->save();
        return redirect("/".$view);
    }

    //to save the wanted values from the DB
    public function saveItem(Request $request){
        $newListItem = new ListItem;
        $newListItem ->name=$request->listItem;
        $newListItem ->name=$request->listItem;
        $newListItem ->is_complete = false;
        $newListItem ->save();

        return redirect('/');
    }

}
