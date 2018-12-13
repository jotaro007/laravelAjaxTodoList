<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(){
        $items = Item::all();
//        return $items;
        return view('list', compact('items'));
    }

    public function create(Request $request){
        $item = new Item;
        $item->item = $request->text;
        $item->save();
        return "Done";
    }

    public function delete(Request $request){
        Item::where('id', $request->id)->delete();
        return $request->all();
    }

    public function update(Request $request){
        $item = Item::find($request->id);
        $item->item = $request->value;
        $item->save();
        return $request->all();
    } 

    public function search(Request $request){
        // $item = Item::find($request->id);
        // $item->item = $request->value;
        // $item->save();
        $term = $request->term;
        $item = Item::where('item','LIKE','%'.$term.'%')->get();
        // return $item;
        if (count($item) == 0) {
           $searchResult[] = 'No Item found';
        }else{
            foreach ($item as $key => $value) {
                $searchResult[] = $value->item;
            }
        }

        return $searchResult;
    //     return $availableTags = [
    //   "ActionScript",
    //   "AppleScript",
    //   "Asp",
    //   "BASIC",
    //   "C",
    //   "C++",
    //   "Clojure",
    //   "COBOL",
    //   "ColdFusion",
    //   "Erlang",
    //   "Fortran",
    //   "Groovy",
    //   "Haskell",
    //   "Java",
    //   "JavaScript",
    //   "Lisp",
    //   "Perl",
    //   "PHP",
    //   "Python",
    //   "Ruby",
    //   "Scala",
    //   "Scheme"
    // ];
    }


}
