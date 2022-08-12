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

        $listItem->is_complete = !$listItem->is_complete;

        $listItem->save();
        return back();
    }

    //to save the wanted values from the DB
    public function saveItem(Request $request)
    {
        $request->validate([
            'listItem' => ['required', 'max:25'],
        ]); // returns an error to the view if validation fails

        $newListItem = ListItem::create([
            'name' => $request->listItem,
            'username' => $request->username ?? "none",
        ]);

        return back();
    }

    public function usernameChange($username, $old)
    {
        ListItem::where(['username' => $old])->update(['username' => $username]);
        return back();
    }
    public function taskTake($username, $id)
    {
        ListItem::find($id)->update(['username' => $username]);

        return back();
    }
}
