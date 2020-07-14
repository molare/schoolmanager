<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Course;
use DB;
use \App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Course::all();
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
    public function store(CourseRequest $request)
    {
        $json;
                try {
        
                $cat = new Course;
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
        return Course::find($id);
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
    public function update(CourseRequest $request, $id)
    {
        $json;
            try {
              
                $cat = Course::where('id', '=', $id)->first();

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
           Course::destroy($id);
        $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
        } catch (\Exception $e) {

         $json = response()->json(array('status' => false, 'last_insert_id' => null), 500);  

    }
      
     return $json;
    }
    
       public function countCourse()
    {
      $json;
      $sqlQuery ='SELECT COUNT(*) AS counter FROM courses';

     $res = DB::select($sqlQuery);
     $json = response()->json(array('data' => $res), 200);
     return $json;
    }
}
