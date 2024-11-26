<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    //
    public function index(){

        $items = Items::where('status',1)->get();
        
        return view('items.index', compact('items') );
    }

    public function create(){
        return view('items.create');
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'status' => 'required|in:1,0',
        ]);
        
        try{
            
            
            $item = DB::transaction(function() use($request){

                $item = Items::create( $request->only([
                    'name',
                    'description',
                    'price',
                    'amount',
                    'status'
                ]));
            });

            return redirect()->route('dashboard')->with('success', 'Item create Success');
            
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function me($id){
        $item = Items::findOrFail($id);
        return view('items.update', compact('item') );
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'status' => 'required|in:1,0',
        ]);
        
        try{
            
            
            $item = DB::transaction(function() use($request, $id){

                $item = Items::where('id',$id)->update( $request->only([
                    'name',
                    'description',
                    'price',
                    'amount',
                    'status'
                ]));
            });

            return redirect()->route('dashboard')->with('success', 'Item create Success');
            
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function delete($id){

        try{

            $item = Items::where('id',$id)->update([
                'status' => 0
            ]);

            Items::where('id',$id)->delete();

            return redirect()->route('dashboard')->with('success', 'Item delete Success');

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
