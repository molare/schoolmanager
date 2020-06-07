<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $guarded=[];
    protected $appends =['action', 'dateFormat','statusVal'];
   
   
    public function getActionAttribute(){
        $var = $this->attributes['id'];
        $action=  '<td><a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#editSchoolYearModal" class="link-underlined margin-right-50 btn btn-success btn-sm" onclick="editSchoolYear('.$var.')"><i class="fa fa-edit"><!-- --></i></a> 
                        <a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#removeSchoolYearModal" class="link-ulink-underlined btn btn-danger btn-sm" onclick="removeSchoolYear('.$var.')"><i class="fa fa-trash"><!-- --></i></a> 
                         </td>';
        
        return $action;
    }
    
    public function getStatusValAttribute(){
        $var = $this->attributes['status'];
        if($var==1){
        $val=  '<td><span class="badge badge-success">Actif</span></td>';
        }else{
        $val=  '<td><span class="badge badge-danger">Inactif</span></td>';    
        }
        return $val;
        
    }
     public function getDateFormatAttribute() {
        $date = $this->attributes['created_at']; 
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
    }
}
