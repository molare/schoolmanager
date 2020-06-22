<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded=[];
    protected $appends =['action', 'dateFormat'];
       
    function student(){
       return $this->belongsTo(student::class);
    }
    
    function paymentType(){
       return $this->belongsTo(PaymentType::class);
    }
    
    
      function schoolYear(){
       return $this->belongsTo(SchoolYear::class);
    }
    
    
    public function getActionAttribute(){
        $var = $this->attributes['id'];
        $action=  '<td>'
                      .'<a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#editPaymentModal" class="link-underlined margin-left-50 margin-right-50 btn btn-success btn-sm" onclick="editPayment('.$var.')"><i class="fa fa-edit"><!-- --></i></a> 
                      <a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#removePaymentModal" class="link-ulink-underlined btn btn-danger btn-sm" onclick="removePayment('.$var.')"><i class="fa fa-trash"><!-- --></i></a> 
                         </td>';
        
        return $action;
    }
    
    
     public function getDateFormatAttribute() {
        $date = $this->attributes['created_at']; 
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
    }
}
