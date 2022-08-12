<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;
use Illuminate\Support\Facades\DB;



class ToDoListController extends Controller
{
    //
    public function index($filter = 'all')
    {

        switch ($filter) {
            case 'done':
                $listItems = ListItem::where(['is_complete' => true])->get();
                break;
            case 'active':
                $listItems = ListItem::where(['is_complete' => false])->get();
                break;
            default:
                $listItems = ListItem::all();
        }
        // dd($filter, $listItems);
        return view('welcome', ['listItems' => $listItems, 'filter' => $filter]);
    }

    //to delete the wanted values from the DB
    public function delete($id)
    {
        $id = rtrim($id, ".");

        $id_array = explode(",", $id);
        foreach ($id_array as $value) {
            ListItem::find($id)->delete() ?? null;
        }

        return back();
    }

    //to mark as done the wanted values from the DB
    public function markDone($id)
    {
        $listItem = ListItem::find($id);
        if ($listItem->is_complete == 1)
            $listItem->is_complete = 0;
        else
            $listItem->is_complete = 1;
        $listItem->save();
        return back();
    }

    //to save the wanted values from the DB
    public function saveItem(Request $request)
    {
        $newListItem = new ListItem;
        $newListItem->name = $request->listItem;
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = false;
        $newListItem->username = $request->username ?? "none";
        $newListItem->save();

        $newListItem = ListItem::create([
            'name' => $request->name,
            'username' => $request->username ?? "none",
        ]);

        return back();
    }

    public function usernameChange($username, $old)
    {
        DB::update('update list_items set username= ? where username = ?', [$username, $old]);
        return back();
    }
    public function taskTake($username, $id)
    {
        DB::update('update list_items set username= ? where id = ?', [$username, $id]);
        return back();
    }
}
