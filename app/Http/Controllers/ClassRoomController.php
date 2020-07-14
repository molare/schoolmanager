<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use DB;
use App\Models\ClassRoom;
use \App\Http\Requests\ClassRequest;
class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClassRoom::all();
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
    public function store(ClassRequest $request)
    {
         $json;
                try {
        
                $cla = new ClassRoom;
                $cla->name = $request->get('name');
                $cla->description = $request->get('description');
                $cla->scolarite = floatval($request->get('scolarite'));
                $cla->save();
                //session()->flash('message', 'Une nouvelle année enregistrée avec succes');
                // Flashy::message('Enregistrement avec succès');
                $json = response()->json(array('success' => true, 'last_insert_id' => $cla->id), 200);
                
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
        return ClassRoom::find($id);
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
    public function update(ClassRequest $request, $id)
    {
         $json;
            try {
              
                $cla = ClassRoom::where('id', '=', $id)->first();
                $cla->scolarite = floatval($request->get('scolarite'));
               $cla->update($request->all());
               
                    
                
                $json = response()->json(array('status' => true, 'last_insert_id' => $cla->id), 200);
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
           ClassRoom::destroy($id);
        $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
        } catch (\Exception $e) {

         $json = response()->json(array('status' => false, 'last_insert_id' => null), 500);  

    }
      
     return $json;
    }
    
    
      public function countClasse()
    {
      $json;
      $sqlQuery ='SELECT COUNT(*) AS counter FROM class_rooms';

     $res = DB::select($sqlQuery);
     $json = response()->json(array('data' => $res), 200);
     return $json;
    }
}
