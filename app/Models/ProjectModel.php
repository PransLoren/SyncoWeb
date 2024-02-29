<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;

    protected $table = 'project';



    static public function getSingle($id){
        return self::find($id);
    }



    static public function getRecord(){
        $return = ProjectModel::select('project.*')
                    ->join('users', 'users.id', '=', 'project.created_by')
                    ->orderBy('project.id', 'desc')
                    ->where('project.is_delete','=',0)
                    ->paginate(20);
        
        return $return;
    }

    public function getDocument(){
        if(!empty($this->document_file) && file_exists('upload/project/' . $this->document_file)){
            return url('upload/project/' . $this->document_file);
        }
        else{
            return "";
        }
    }
}
