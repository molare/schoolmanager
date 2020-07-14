<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sitting;
use DB;
use \App\Models\ClassRoom;
use App\Models\Course;
use \App\Models\SchoolYear;
use \App\Models\teacher;
class SittingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Sitting::all();
         $sqlQuery ='SELECT t.id, t.start_hour, t.end_hour, t.day, '
                . ' t.created_at, c.name AS classe, co.name AS course, tea.first_name, tea.last_name '
                . ' FROM sittings AS t, class_rooms c, courses co, teachers tea '
                . ' WHERE t.classe_id = c.id '
                . ' AND t.course_id = co.id '
                 .' AND t.teacher_id = tea.id ';

     $res = DB::select($sqlQuery);
      
       $rows =array();
           foreach ($res as $value){
            
                $sitting = new Sitting;
                $sitting->id=$value->id;
                $sitting->created_at = $value->created_at;
                $sitting->teacher = $value->first_name.' '.$value->last_name;
                $sitting->course = $value->course;
                $sitting->classe = $value->classe;
                $sitting->start_hour = $value->start_hour;
                $sitting->end_hour = $value->end_hour;
                if($value->day==1){
                $sitting->day = "Lundi";
                }elseif($value->day==2){
                  $sitting->day = "Mardi";  
                }else if($value->day==3){
                  $sitting->day = "Mercredi";  
                }else if($value->day==4){
                  $sitting->day = "Jeudi";  
                }else if($value->day==5){
                  $sitting->day = "Vendredi";  
                }else if($value->day==6){
                  $sitting->day = "Samedi";  
                }else if($value->day==7){
                  $sitting->day = "Dimanche";  
                }
                
                array_push($rows,$sitting);
            } 
         
           return $rows; 
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
    public function store(Request $request)
    {
          $json;
            try {
               
              $sitting = new Sitting;
              $sitting->start_hour = $request->get('start');
              $sitting->end_hour = $request->get('end');
              $sitting->day = intval($request->get('day'));
              $sitting->classe()->associate($request->get('classe'));
              $sitting->teacher()->associate($request->get('teacher'));
              $sitting->schoolYear()->associate($request->get('schoolYear')); 
              $sitting->course()->associate($request->get('course'));
              $sitting->description = $request->get('description');
              $sitting->save();
                   
                $json = response()->json(array('success' => true, 'last_insert_id' => $sitting->id), 200);
                } catch (\Exception $e) {

                $json = response()->json(array('success' => false, 'error message' => $e->getMessage()), 500);  

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
        $json;
        $sitting = Sitting::find($id);
        $sitting->classe = ClassRoom::find($sitting->classe_id);
        $sitting->course = Course::find($sitting->course_id);
        $sitting->teacher = teacher::find($sitting->teacher_id);
        $sitting->schoolYear = SchoolYear::find($sitting->school_year_id);
        $json = response()->json(array('data' => $sitting), 200);
          
        return $json;
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
    public function update(Request $request, $id)
    {
          $json;
            try {
               
              $sitting = Sitting::find($id);
              $sitting->start_hour = $request->get('start');
              $sitting->end_hour = $request->get('end');
              $sitting->day = intval($request->get('day'));
              $sitting->classe()->associate($request->get('classe'));
              $sitting->teacher()->associate($request->get('teacher'));
              $sitting->schoolYear()->associate($request->get('schoolYear')); 
              $sitting->course()->associate($request->get('course'));
              $sitting->description = $request->get('description');
              $sitting->update();
                   
                $json = response()->json(array('status' => true, 'last_insert_id' => $sitting->id), 200);
                } catch (\Exception $e) {

                $json = response()->json(array('status' => false, 'error message' => $e->getMessage()), 500);  

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
         
             Sitting::destroy($id);
            $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
            } catch (\Exception $e) {

             $json = response()->json(array('status' => false, 'messages' => "erreur de suppression"), 500);  

        }

         return $json;
    }
}
