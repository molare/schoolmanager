<?php

namespace App\Http\Controllers;

use \App\Models\Category;
use \App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
          $json;
                try {
        
                $cat = new Category;
                $cat->name = $request->get('name');
                $cat->description = $request->get('description');
                $cat->save();
                //session()->flash('message', 'Une nouvelle année enregistrée avec succes');
                // Flashy::message('Enregistrement avec succès');
                $json = response()->json(array('success' => true, 'last_insert_id' => $cat->id), 200);
                
                } catch (\Exception $e) {

                  $json = response()->json(array('success' => false, 'last_insert_id' => null), 500);  

            }
            
            return $json;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $json;
            try {
              
                $cat = Category::where('id', '=', $id)->first();

               $cat->update($request->all());
               
                    
                
                $json = response()->json(array('status' => true, 'last_insert_id' => $cat->id), 200);
                } catch (\Exception $e) {

                $json = response()->json(array('status' => false, 'last_insert_id' => null), 500);  

            }
            
            return $json;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $json;
       try {
           Category::destroy($id);
        $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
        } catch (\Exception $e) {

         $json = response()->json(array('status' => false, 'last_insert_id' => null), 500);  

    }
      
     return $json;
    }
    
}
