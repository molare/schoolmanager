<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Teacher;
use DB;
use \App\Models\Category;
use Illuminate\Support\Facades\File;
use \App\Models\Genre;
use \App\Models\SchoolYear;
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
                . ' FROM teachers AS t, categories cat, genres g'
                . ' WHERE t.category_id = cat.id '
                . ' AND t.genre_id = g.id';

     $res = DB::select($sqlQuery);
      
       $rows =array();
           foreach ($res as $value){
                $teacher = new Teacher;
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
    public function store(Request $request)
    {
        $json;
            try {
               
              $teacher = new Teacher;
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
                 $teacher->photo = null;  
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
        $teacher = Teacher::find($id);
        $teacher->category_id = Category::find($teacher->category_id);
        $teacher->genre_id = Genre::find($teacher->genre_id);
        $teacher->schoolYear = SchoolYear::find($teacher->school_year_id);
        return $teacher; 
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
                
                
              $teacher = Teacher::find($id);
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
          $teacher = Teacher::find($id);
            $image_path = public_path('/images/'.$teacher->photo); // get previous image from folder
            if(File::exists($image_path)) {
                   File::delete($image_path);
              }
              Teacher::destroy($id);
            $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
            } catch (\Exception $e) {

             $json = response()->json(array('status' => false, 'messages' => "erreur de suppression"), 500);  

        }

         return $json;
    }
}
