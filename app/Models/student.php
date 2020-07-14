<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $guarded=[];
    protected $appends =['action', 'image', 'editImage', 'dateFormat', 'infoImage'];
       
    function genre(){
       return $this->belongsTo(Genre::class);
    }
    
    function parente(){
       return $this->belongsTo(Parente::class);
    }
    
    function classe(){
       return $this->belongsTo(ClassRoom::class);
    }
    
      function schoolYear(){
       return $this->belongsTo(SchoolYear::class);
    }
    
    
    public function getActionAttribute(){
        $var = $this->attributes['id'];
        $action=  '<td>'
                      .'<a style="margin-right: 6px;" href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#infoModal" class="link-underlined margin-right-50 btn btn-primary btn-sm" onclick="infoStudent('.$var.')"><i class="fa fa-eye"><!-- --></i></a>' 
                      . '<a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#editStudentModal" class="link-underlined margin-left-50 margin-right-50 btn btn-success btn-sm" onclick="editStudent('.$var.')"><i class="fa fa-edit"><!-- --></i></a> 
                      <a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#removeStudentModal" class="link-ulink-underlined btn btn-danger btn-sm" onclick="removeStudent('.$var.')"><i class="fa fa-trash"><!-- --></i></a> 
                         </td>';
        
        return $action;
    }
    
    
     public function getDateFormatAttribute() {
        $date = $this->attributes['created_at']; 
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
    }
    
    public function getImageAttribute(){
        
        $filename = $this->attributes['photo'];   
        $image= '<a href="javascript: void(0);"><img src="/images/'.$filename.'" border="0" width="40" class="img-hover-zoom img-hover-zoom--slowmo" alt="" width="40" height="40"  title=""></a>' ;      
        return $image;
        
    }
    
      public function getEditImageAttribute(){
        $image="";
        $filename = $this->attributes['photo'];  
        if($filename !=""){
        $image= '<a href="javascript: void(0);"><img src="/images/'.$filename.'" border="0" width="200" class="hvr-shrink img-rounded" alt=""  title=""></a>' ;      
        }else{
        $image= '<a href="javascript: void(0);"><img src="/images/avatar.png" border="0" width="200" class="hvr-shrink img-rounded" alt=""  title=""></a>' ;      
        }
        return $image;
        
    }
    
    public function getInfoImageAttribute(){
        
        $filename = $this->attributes['photo'];   
        $image= '<a href="javascript: void(0);"><img src="/images/'.$filename.'" class="profile-user-img img-fluid img-circle zoom" alt="User profile picture"  title=""></a>' ;      
        return $image;
        
    }
}
