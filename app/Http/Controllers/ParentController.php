<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Parente;
use DB;
use Illuminate\Support\Facades\File;
use \App\Models\Genre;
use \App\Models\SchoolYear;

class ParentController extends Controller
{ /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sqlQuery ='SELECT t.id,t.first_name, t.last_name,t.phone, t.email, t.photo,t.adresse, t.created_at, t.photo, g.name AS genre, t.active AS active '
                . ' FROM Parentes AS t, genres g, school_years sy'
                . ' WHERE t.genre_id = g.id '
                . ' AND t.school_year_id = sy.id'
                . ' AND sy.status = 1';

     $res = DB::select($sqlQuery);
      
       $rows =array();
           foreach ($res as $value){
                $Parent = new Parente();
                $Parent->id=$value->id;
                $Parent->first_name = $value->first_name;
                $Parent->last_name =$value->last_name;
                $Parent->genre_id = $value->genre;
                $Parent->phone = $value->phone;
                $Parent->email = $value->email;
                $Parent->adresse = $value->adresse;
                $Parent->created_at = $value->created_at;
                $Parent->photo = $value->photo;
                $activeStatus = $value->active;
               if($activeStatus==1){
               $active_status=  '<td><span class="badge badge-success">Actif</span></td>';
               }else{
               $active_status=  '<td><span class="badge badge-danger">Inactif</span></td>';    
               }
                array_push($rows,$Parent);
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
               
              $Parent = new Parente;
              $Parent->first_name = $request->get('firstName');
              $Parent->last_name = $request->get('lastName');
              $Parent->genre()->associate($request->get('genre'));
              $Parent->phone = $request->get('phone');
              $Parent->cel = $request->get('cel');
              $Parent->schoolYear()->associate($request->get('schoolYear'));
              $Parent->email = $request->get('email');
              $Parent->adresse = $request->get('adresse');
              $Parent->active = 1;
              if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $Parent->photo = $name;
              } else{
                 $Parent->photo = null;  
              }
              
              $Parent->save();
                   
                $json = response()->json(array('success' => true, 'last_insert_id' => $Parent->id), 200);
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
        $Parent = Parente::find($id);
        $Parent->genre_id = Genre::find($Parent->genre_id);
        $Parent->schoolYear= SchoolYear::find($Parent->school_year_id);
        return $Parent; 
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
                
                
              $Parent = Parente::find($id);
              $Parent->first_name =$request->get('firstName');
              $Parent->last_name =$request->get('lastName');
              $Parent->genre()->associate($request->get('genre'));
              $Parent->schoolYear()->associate($request->get('schoolYear'));
              $Parent->phone =$request->get('phone');
              $Parent->cel = $request->get('cel');
              $Parent->email =$request->get('email');
              $Parent->adresse =$request->get('adresse');
              $Parent->active = intval($request->get('statut'));
               
              if ($request->hasFile('file')){
              
                $image_path = public_path('/images/'.$Parent->photo); // get previous image from folder
                if(File::exists($image_path)) {
                        File::delete($image_path);
                  }
                  
                $image = $request->file('file');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $Parent->photo = $name;
              }
              
              $Parent->update();
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
            $Parent = Parente::find($id);
            $image_path = public_path('/images/'.$Parent->photo); // get previous image from folder
            if(File::exists($image_path)) {
                   File::delete($image_path);
              }
           Parente::destroy($id);
            $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
            } catch (\Exception $e) {

             $json = response()->json(array('status' => false, 'last_insert_id' => null), 500);  

        }

         return $json;
    }
}
