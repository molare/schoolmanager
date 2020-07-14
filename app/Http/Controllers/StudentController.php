<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\student;
use DB;
use \App\Models\ClassRoom;
use App\models\Parente;
use Illuminate\Support\Facades\File;
use \App\Models\Genre;
use \App\Models\SchoolYear;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sqlQuery ='SELECT t.id,t.first_name, t.last_name,t.phone, t.email, t.photo,t.adresse,'
                . ' t.created_at, t.photo, c.name AS classe, g.name AS genre, t.active AS active, t.birth_date, t.register_number, t.rest '
                . ' FROM students AS t, class_rooms c, genres g, school_years s'
                . ' WHERE t.classe_id = c.id '
                . ' AND t.genre_id = g.id'
                .'  AND t.school_year_id = s.id '
                .' AND s.status = 1';

     $res = DB::select($sqlQuery);
      
       $rows =array();
           foreach ($res as $value){
            
                $student = new student;
                $student->id=$value->id;
                $student->first_name = $value->first_name;
                $student->last_name =$value->last_name;
                $student->genre_id = $value->genre;
                $student->classe = $value->classe;
                $student->phone = $value->phone;
                $student->birth_date = $value->birth_date;
                $student->email = $value->email;
                $student->adresse = $value->adresse;
                $student->created_at = $value->created_at;
                $student->photo = $value->photo;
                $student->register_number =$value->register_number; 
                $student->total = $value->rest;
                $activeStatus = $value->active;
               if($activeStatus==1){
               $active_status=  '<td><span class="badge badge-success">Oui</span></td>';
               }else{
               $active_status=  '<td><span class="badge badge-danger">Non</span></td>';    
               }
               $student->active =$active_status;
                
               $statusPay = $value->rest;
               if(intval($statusPay)<=0){
               $statusPayTransient=  '<td><span class="badge badge-success">Soldé</span></td>';
               }else{
               $statusPayTransient=  '<td><span class="badge badge-danger">Non Soldé</span></td>';    
               }
               $student->rest =$statusPayTransient;
                
                array_push($rows,$student);
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
               
              $student = new student;
              $student->first_name = $request->get('firstName');
              $student->last_name = $request->get('lastName');
              $student->genre()->associate($request->get('genre'));
              $student->classe()->associate($request->get('classe'));
              $student->parente()->associate($request->get('parent'));
              $student->schoolYear()->associate($request->get('schoolYear')); 
              $student->phone = $request->get('phone');
              $student->cel = $request->get('cel');
              $student->email = $request->get('email');
              $student->birth_date = $request->get('birthDate');
              $student->active = 1;
              $student->pay_status =1;
              $student->adresse = $request->get('adresse');
              $student->register_number =$request->get('registerNumber');
              $classe = ClassRoom::find($request->get('classe'));
              $student->rest = $classe->scolarite;
               
              if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $student->photo = $name;
              }else{
                $student->photo = "";
              }
              
              $student->save();
                   
                $json = response()->json(array('success' => true, 'last_insert_id' => $student->id), 200);
                } catch (\Exception $e) {

                $json = response()->json(array('success' => false, 'error message' => $e->getMessage()), 500);  

            }
            
            return $json;
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
       $json;
       $student = student::find($id);
        $student->classe = ClassRoom::find($student->classe_id);
        $student->genre_id = Genre::find($student->genre_id);
        $student->schoolYear = SchoolYear::find($student->school_year_id);
        $student->parente = Parente::find($student->parente_id);
        $student->parenteGenre = Genre::find($student->parente->genre_id);
        $sql ='SELECT t.id,t.first_name, t.last_name,t.phone, t.email, t.photo,t.adresse,'
                . ' t.created_at,c.name AS classe, g.name AS genre, t.active AS active, t.birth_date, t.register_number,'
                . ' p.amount, p.date_payment, c.scolarite AS scolarite, pt.name AS type, '
                .' (SELECT COALESCE(SUM(py.amount),0) FROM payments AS py, students st WHERE py.student_id = st.id
                    AND st.id = t.id) AS total '
                . ' FROM payments AS p, students AS t, class_rooms c, genres g, payment_types AS pt '
                . ' WHERE p.student_id = t.id '
                . ' AND t.classe_id = c.id '
                . ' AND t.genre_id = g.id '
                . ' AND p.payment_type_id = pt.id ' 
                . ' AND t.id = '.$student->id;

            $result = DB::select($sql);
        
            $rows =array();
           foreach ($result as $value){
                $payment = new \App\Models\Payment;
                $payment->id=$value->id;
                $payment->first_name = $value->first_name;
                $payment->last_name =$value->last_name;
                $payment->genre_id = $value->genre;
                $payment->classe = $value->classe;
                $payment->amount = $value->amount;
                $payment->rest = $value->scolarite-$value->amount;
                $payment->created_at = $value->created_at;
                $payment->register_number =$value->register_number; 
                $payment->date_payment = $value->date_payment;
                $payment->type = $value->type;
                $payment->total =$value->scolarite-$value->total;
                $payment->totalPay = $value->total;
                 array_push($rows,$payment);
            }
            if($rows !==[]){
              
            $json = response()->json(array('data' => $student, 'payment' => $rows), 200);
            }else{
              $json = response()->json(array('data' => $student, 'scolarite' => $student->classe->scolarite, 'payment' => 0), 200);  
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
               
              $student = student::find($id);
              $student->first_name = $request->get('firstName');
              $student->last_name = $request->get('lastName');
              $student->genre()->associate($request->get('genre'));
              $student->parente()->associate($request->get('parent'));
              $student->classe()->associate($request->get('classe'));
              $student->schoolYear()->associate($request->get('schoolYear')); 
              $student->phone = $request->get('phone');
              $student->cel = $request->get('cel');
              $student->email = $request->get('email');
              $student->birth_date = $request->get('birthDate');
              $student->active = $request->get('statut');
              $student->pay_status =1;
              $student->adresse = $request->get('adresse');
              $student->register_number =$request->get('registerNumber');
               
            if ($request->hasFile('file')){
              
                $image_path = public_path('/images/'.$student->photo); // get previous image from folder
                if(File::exists($image_path)) {
                        File::delete($image_path);
                  }
                  
                $image = $request->file('file');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $student->photo = $name;
              }
              
              $student->update();
                   
                $json = response()->json(array('status' => true, 'last_insert_id' => $student->id), 200);
                } catch (\Exception $e) {

                $json = response()->json(array('success' => false, 'error message' => $e->getMessage()), 500);  

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
          $student = student::find($id);
            $image_path = public_path('/images/'.$student->photo); // get previous image from folder
            if(File::exists($image_path)) {
                   File::delete($image_path);
              }
              student::destroy($id);
            $json = response()->json(array('status' => true, 'last_insert_id' => null), 200);
            } catch (\Exception $e) {

             $json = response()->json(array('status' => false, 'messages' => "erreur de suppression"), 500);  

        }

         return $json;
    }
    
     public function countStudent()
    {
      $json;
      $sqlQuery ='SELECT COALESCE(COUNT(*),0) AS counter '
    . ' FROM students AS t, school_years s '
    . ' WHERE t.school_year_id = s.id '
    . ' AND s.status = 1';

     $res = DB::select($sqlQuery);
     $json = response()->json(array('data' => $res), 200);
     return $json;
    }
    
      public function dashbordStudent()
    {
      $json;
      
      $sqlQuery ='SELECT COALESCE(COUNT(*),0) AS counter '
    . ' FROM students AS t, school_years s , genres g'
    . ' WHERE t.school_year_id = s.id '
    .'  AND t.genre_id = g.id '           
    .' AND s.status = 1'
    .' AND g.id = 1';

     $res = DB::select($sqlQuery);
     
     $sqlQueries ='SELECT COALESCE(COUNT(*),0) AS counter '
    .' FROM students AS t, school_years s , genres g'
    .' WHERE t.school_year_id = s.id '
    .'  AND t.genre_id = g.id '           
    .' AND s.status = 1'
    .' AND g.id = 2';

     $rest = DB::select($sqlQueries);
     
     $json = response()->json(array('data' => $res, 'datas' => $rest), 200);
     return $json;
    }
    
    public function getStudentByClasse($id){
         $sqlQuery ='SELECT t.id,t.first_name, t.last_name, t.photo '
                .' FROM students AS t, class_rooms c, school_years s'
                .' WHERE t.classe_id = c.id '
                .' AND t.school_year_id = s.id '
                .' AND s.status = 1'
                .' AND t.rest>0'
                .' AND c.id='.$id ;

     $res = DB::select($sqlQuery);
      $json = response()->json(array('data' => $res), 200);
     return $json;
    }
    
    
      public function getStudentByYear(){
         
         $date = date('Y');
         $previousDate1 = date('Y')-1;
         $previousDate2 = date('Y')-2;
         $sqlQuery1 ="SELECT COALESCE(COUNT(*),0) AS counter "
                ." FROM students AS t, class_rooms c, school_years s"
                ." WHERE t.classe_id = c.id "
                ." AND t.school_year_id = s.id "
                //." AND s.status = 1 "
                //.' AND t.rest>0 '
                ." AND s.name like '%".$date."'";
         
         $sqlQuery2 ="SELECT COALESCE(COUNT(*),0) AS counter "
                ." FROM students AS t, class_rooms c, school_years s"
                ." WHERE t.classe_id = c.id "
                ." AND t.school_year_id = s.id "
                //." AND s.status = 1 "
                //.' AND t.rest>0 '
                ." AND s.name like '%".$previousDate1."'";
         
         $sqlQuery3 ="SELECT COALESCE(COUNT(*),0) AS counter "
                ." FROM students AS t, class_rooms c, school_years s"
                ." WHERE t.classe_id = c.id "
                ." AND t.school_year_id = s.id "
                //." AND s.status = 1 "
                //.' AND t.rest>0 '
                ." AND s.name like '%".$previousDate2."'";

     $res1 = DB::select($sqlQuery1);
     $res2 = DB::select($sqlQuery2);
     $res3 = DB::select($sqlQuery3);
      $json = response()->json(array('data1' => $res1,'data2' => $res2,'data3' => $res3), 200);
     return $json;
    }
}
