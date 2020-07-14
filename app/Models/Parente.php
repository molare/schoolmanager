<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Parente extends Model
{
    protected $guarded=[];
    protected $appends =['action', 'image', 'editImage', 'dateFormat'];
   
 
   
    function genre(){
       return $this->belongsTo(App\Genre::class);
    }
    
    function schoolYear(){
       return $this->belongsTo(SchoolYear::class);
    }
    
    public function getActionAttribute(){
        $var = $this->attributes['id'];
        $action=  '<td><a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#editParentModal" class="link-underlined margin-right-50 btn btn-success btn-sm" onclick="editParent('.$var.')"><i class="fa fa-edit"><!-- --></i></a> 
                        <a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#removeParentModal" class="link-ulink-underlined btn btn-danger btn-sm" onclick="removeParent('.$var.')"><i class="fa fa-trash"><!-- --></i></a> 
                         </td>';
        
      
        return $action;
        
    }
       
     public function getDateFormatAttribute() {
        $date = $this->attributes['created_at']; 
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
    }
    
    public function getImageAttribute(){
        
        $filename = $this->attributes['photo'];   
        $image= '<a href="javascript: void(0);"><img src="/images/'.$filename.'" border="0" width="40" class="img-hover-zoom img-hover-zoom--slowmo" alt="" width="40" height="30"  title=""></a>' ;      
        return $image;
        
    }
    
      public function getEditImageAttribute(){
        
        $filename = $this->attributes['photo'];   
        $image= '<a href="javascript: void(0);"><img src="/images/'.$filename.'" border="0" width="200" class="hvr-shrink img-rounded" alt=""  title=""></a>' ;      
        return $image;
        
    }
}
