<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;
use Illuminate\Support\Facades\DB;



class ToDoListController extends Controller
{
    //
    public function index($id){
        return view('welcome',['listItems' => ListItem::all()],['view'=>$id]);
    }
    public function index_f(){
        return view('welcome',['listItems' => ListItem::all()],['view'=>-1]);
    }

    //to delete the wanted values from the DB
    public function delete($id,$view){
        error_log($id);
        //get all positions for the delete
        $lastPos = 0;
        $positions = array();

        while (($lastPos = strpos($id, ",", $lastPos))!== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen(",");
        }
        //delete the postions except the last one
        $lastv = 0;
        foreach ($positions as $value) {
            $new="";
            for($i=$lastv;$i<$value;$i++)
            {
                $new.=$id[$i];
            }
            $del_id = intval( $new );
            DB::delete('delete from list_items where id = ?',[$del_id]);
            $lastv = $value+1;
        }

        //delete the last position
        $new="";
        for($i=$lastv;$i<strlen($id);$i++)
        {
            $new.=$id[$i];
        }
        $del_id = intval( $new );
        DB::delete('delete from list_items where id = ?',[$del_id]);

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
