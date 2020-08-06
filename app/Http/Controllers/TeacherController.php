<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teacher;
use DB;
use \App\Models\Category;
use Illuminate\Support\Facades\File;
use \App\Models\Genre;
use \App\Models\SchoolYear;
use App\Models\Sitting;
use \App\Http\Requests\TeacherRequest;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sqlQuery ='SELECT t.id,t.first_name, t.last_name,t.phone, t.email, t.photo,t.adresse, t.created_at, t.photo, cat.name AS category, g.name AS genre, t.active AS active '
                . ' FROM teachers AS t, categories cat, genres g, school_years s '
                . ' WHERE t.category_id = cat.id '
                . ' AND t.genre_id = g.id'
                .'  AND t.school_year_id = s.id '
                .' AND s.status = 1';

     $res = DB::select($sqlQuery);
      
       $rows =array();
           foreach ($res as $value){
                $teacher = new teacher;
                $teacher->id=$value->id;
                $teacher->first_name = $value->first_name;
                $teacher->last_name =$value->last_name;
                $teacher->genre_id = $value->genre;
                $teacher->category_id = $value->category;
                $teacher->phone = $value->phone;
                $teacher->email = $value->email;
                $teacher->adresse = $value->adresse;
                $teacher->created_at = $value->created_at;
                $teacher->photo = $value->photo;
                $activeStatus = $value->active;
               if($activeStatus==1){
               $active_status=  '<td><span class="badge badge-success">Actif</span></td>';
               }else{
               $active_status=  '<td><span class="badge badge-danger">Inactif</span></td>';    
               }
                $teacher->active =$active_status;
                 array_push($rows,$teacher);
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
    public function store(TeacherRequest $request)
    {
        $json;
            try {
               
              $teacher = new teacher;
              $teacher->first_name = $request->get('firstName');
              $teacher->last_name = $request->get('lastName');
              $teacher->genre()->associate($request->get('genre'));
              $teacher->category()->associate($request->get('category'));
              $teacher->schoolYear()->associate($request->get('schoolYear')); 
              $teacher->phone = $request->get('phone');
              $teacher->cel = $request->get('cel');
              $teacher->email = $request->get('email');
              $teacher->active = 1;
              $teacher->adresse = $request->get('adresse');
               
              if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $teacher->photo = $name;
              } else{
                 $teacher->photo = "";  
              }
              
              $teacher->save();
                   
                $json = response()->json(array('success' => true, 'last_insert_id' => $teacher->id), 200);
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
        
        $teacher = teacher::find($id);
        $teacher->category_id = Category::find($teacher->category_id);
        $teacher->genre_id = Genre::find($teacher->genre_id);
        $teacher->schoolYear = SchoolYear::find($teacher->school_year_id);
        
           $sqlQuery ='SELECT t.id, t.start_hour, t.end_hour, t.day, '
                . ' t.created_at, c.name AS classe, co.name AS course, tea.first_name, tea.last_name '
                . ' FROM sittings AS t, class_rooms c, courses co, teachers tea, school_years ys '
                . ' WHERE t.classe_id = c.id '
                . ' AND t.course_id = co.id '
                .'  AND t.teacher_id = tea.id '
                .'  AND t.school_year_id = ys.id '
                . ' AND tea.id ='.$teacher->id.' ORDER BY t.day DESC';

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
        
        
           if($rows !==[]){
              
            $json = response()->json(array('data' => $teacher, 'sitting' => $rows), 200);
            }else{
              $json = response()->json(array('data' => $teacher), 200);  
            }
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
    public function update(TeacherRequest $request, $id)
    {
          $json;
            try {
                
                
              $teacher = teacher::find($id);
              $teacher->first_name =$request->get('firstName');
              $teacher->last_name =$request->get('lastName');
              $teacher->genre()->associate($request->get('genre'));
              $teacher->category()->associate($request->get('category'));
              $teacher->phone =$request->get('phone');
              $teacher->cel = $request->get('cel');
              $teacher->email =$request->get('email');
              $teacher->adresse =$request->get('adresse');
              $teacher->active = intval($request->get('statut'));
              if ($request->hasFile('file')){
              
                $image_path = public_path('/images/'.$teacher->photo); // get previous image from folder
                if(File::exists($image_path)) {
                        File::delete($image_path);
                  }
                  
                $image = $request->file('file');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $teacher->photo = $name;
              }
              
              $teacher->update();
              //  DB::commit();
                $json = response()->json(array('status' => true, 'last_insert' =>null), 200);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    //DB::rollback();
                $json = response()->json(array('status' => false, $e->getMessage(),'last_insert_id' => $e->getMessage()), 500);  

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
          $teacher = teacher::find($id);
            $image_path = public_path('/images/'.$teacher->photo); // get previous image from folder
            if(File::exists($image_path)) {
                   File::delete($image_path);
              }
              teacher::destroy($id);
            $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
            } catch (\Exception $e) {

             $json = response()->json(array('status' => false, 'messages' => "erreur de suppression"), 500);  

        }

         return $json;
    }
    
    public function countTeacher()
    {
      $json;
      $sqlQuery ='SELECT COALESCE(COUNT(*),0) AS counter '
    . ' FROM teachers AS t, school_years s '
    . ' WHERE t.school_year_id = s.id '
    . ' AND s.status = 1';

     $res = DB::select($sqlQuery);
     $json = response()->json(array('data' => $res), 200);
     return $json;
    }
}
