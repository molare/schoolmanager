<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sitting extends Model
{
    protected $guarded=[];
    protected $appends =['action', 'dateFormat'];
       
    function teacher(){
       return $this->belongsTo(teacher::class);
    }
    
    function classe(){
       return $this->belongsTo(ClassRoom::class);
    }
    
     function course(){
       return $this->belongsTo(Course::class);
    }
    
     function schoolYear(){
       return $this->belongsTo(SchoolYear::class);
    }
    
    
    public function getActionAttribute(){
        $var = $this->attributes['id'];
        $action=  '<td>'
                      .'<a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#editSittingModal" class="link-underlined margin-left-50 margin-right-50 btn btn-success btn-sm" onclick="editSitting('.$var.')"><i class="fa fa-edit"><!-- --></i></a> 
                      <a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#removeSittingModal" class="link-ulink-underlined btn btn-danger btn-sm" onclick="removeSitting('.$var.')"><i class="fa fa-trash"><!-- --></i></a> 
                         </td>';
        
        return $action;
    }
    
    
     public function getDateFormatAttribute() {
        $date = $this->attributes['created_at']; 
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
    }
}
