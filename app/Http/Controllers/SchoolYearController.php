<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use  App\Models\SchoolYear;
use DB;
use \App\Http\Requests\SchoolYearRequest;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getSchoolYearActive()
    {        
       $json;
       try {
         $active = SchoolYear::where('status','=',1)->get();
        $json = response()->json(array('status' => true, 'data' => $active), 200);
        }catch (\Exception $e){

         $json = response()->json(array('status' => false, 'data' => null), 500);  

    }
      
     return $json;
    
   }

    
    public function index()
    {
        return SchoolYear::all();
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
    public function store(SchoolYearRequest $request)
    {
          $json;
                try {
        
                $cat = new SchoolYear;
                $cat->name = $request->get('name');
                $cat->start_year = $request->get('start_year');
                $cat->end_year = $request->get('end_year');
                $cat->status = 2;
                $cat->description = $request->get('description');
                $cat->save();
                $json = response()->json(array('success' => true, 'last_insert_id' => $cat->id), 200);
                
                } catch (\Exception $e) {

                  $json = response()->json(array('success' => false, 'last_insert_id' => $e->getMessage()), 500);  

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
        return SchoolYear::find($id);
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
    public function update(SchoolYearRequest $request, $id)
    {
        $json;
            try {
              
                //$cat = SchoolYear::where('id', '=', $id)->first();
                $cat = SchoolYear::find($id);
                $var = intval($request->get('status'));
                if($var===1){
                $sqlQuery ='UPDATE school_years set status=2 WHERE id !='.$id;
                $res = DB::select($sqlQuery);
                }
                $cat->status =$request->get('status');
                $cat->name = $request->get('name');
                $cat->start_year = $request->get('start_year');
                $cat->end_year = $request->get('end_year');
                $cat->description = $request->get('description');
                $cat->update();

               //$cat->update($request->all());
               
                    
                
                $json = response()->json(array('status' => true, 'last_insert_id' => $request->get('status')), 200);
                } catch (\Exception $e) {

                $json = response()->json(array('status' => false, 'last_insert_id' => $e->getMessage()), 500);  

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
           SchoolYear::destroy($id);
        $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
        } catch (\Exception $e) {

         $json = response()->json(array('status' => false, 'last_insert_id' => null), 500);  

    }
      
     return $json;
    }
    
}
