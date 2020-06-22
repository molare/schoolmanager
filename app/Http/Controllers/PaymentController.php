<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Payment;
use DB;
use \App\Models\student;
use \App\Models\SchoolYear;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $sqlQuery ='SELECT p.id,t.first_name, t.last_name,t.phone, t.email, t.photo,t.adresse,'
                . ' t.created_at, t.photo, c.name AS classe, g.name AS genre, t.active AS active, t.birth_date, t.register_number,'
                . ' p.amount, p.date_payment, c.scolarite '
                . ' FROM payments AS p, students AS t, class_rooms c, genres g '
                . ' WHERE p.student_id = t.id '
                . ' AND t.classe_id = c.id '
                . ' AND t.genre_id = g.id';

        $res = DB::select($sqlQuery);
      
        $rows =array();
           foreach ($res as $value){
                $payment = new Payment;
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
                
                /*$student->phone = $value->phone;
                $student->birth_date = $value->birth_date;
                $student->email = $value->email;
                $student->adresse = $value->adresse;
               $student->photo = $value->photo;
                $activeStatus = $value->active;
                
               if($activeStatus==1){
               $active_status=  '<td><span class="badge badge-success">Oui</span></td>';
               }else{
               $active_status=  '<td><span class="badge badge-danger">Non</span></td>';    
               }
                $student->active =$active_status;*/
                 array_push($rows,$payment);
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
            DB::beginTransaction();
            try {
               
              $payment = new Payment;
              $payment->date_payment = $request->get('datePayment');
              $payment->description = $request->get('description');
              $payment->paymentType()->associate($request->get('paymentType'));
              $payment->student()->associate($request->get('student'));
              $payment->schoolYear()->associate($request->get('schoolYear'));
              $payment->amount = floatval($request->get('amount'));
              $student = student::find(intval($request->get('student')));
              $student->rest = $student->rest - floatval($request->get('amount'));
              $student->update();
              $payment->save();
              
               DB::commit();
                $json = response()->json(array('success' => true, 'last_insert_id' => $payment->id), 200);
                
                } catch (\Exception $e) {
                    DB::rollback();
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
        $payment = Payment::findOrfail($id);
        $payment->payment_type = \App\Models\PaymentType::find($payment->payment_type_id);
        $student = student::find($payment->student_id);
        $student->schoolYear = SchoolYear::find($student->school_year_id);
        $json = response()->json(array('data' => $payment, 'student' => $student), 200);
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
            DB::beginTransaction();
            try {
               
              $payment = Payment::find($id);
              $payment->date_payment = $request->get('datePayment');
              $payment->description = $request->get('description');
              $payment->paymentType()->associate($request->get('paymentType'));
              $payment->student()->associate($request->get('student'));
              $payment->schoolYear()->associate($request->get('schoolYear'));
              $payment->amount = floatval($request->get('amount'));
              $payment->update();
               DB::commit();
                $json = response()->json(array('status' => true, 'last_insert_id' => $payment->id), 200);
                
                } catch (\Exception $e) {
                    DB::rollback();
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
            DB::beginTransaction();
            try {
               
              $payment = Payment::find($id);
              $student = student::find($payment->student_id);
              $totalRest = ($student->rest+$payment->amount);
              $student->rest = $totalRest;
              $student->update();
              $payment::destroy($id);
              
               DB::commit();
                $json = response()->json(array('status' => true, 'last_insert_id' => $totalRest), 200);
                
                } catch (\Exception $e) {
                    DB::rollback();
                $json = response()->json(array('success' => false, 'error message' => $e->getMessage()), 500);  

            }
            
            return $json;
    }
}
