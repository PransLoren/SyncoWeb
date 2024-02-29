<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubjectModel extends Model
{
    use HasFactory;

    protected $table = 'subject';

    public function getSingle($id) {
        return self::find($id);
    }

    public static function getRecord() {
        $query = self::select('subject.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'subject.created_by');

        if (!empty(Request::get(''))) {
            $query->where('subject.name', 'like', '%' . Request::get('') . '%');
        }

        if (!empty(Request::get('type'))) {
            $query->where('subject.type', '=', Request::get('type'));
        }

        if (!empty(Request::get('date'))) {
            $query->whereDate('subject.created_at', '=', Request::get('date'));
        }

        return $query->where('subject.is_delete', 0)->orderBy('subject.id', 'desc')->paginate(10);
    }

    public static function getSubject() {
        return self::select('subject.*')
            ->join('users', 'users.id', 'subject.created_by')
            ->where('subject.is_delete', 0)
            ->where('subject.status', 0)
            ->orderBy('subject.id', 'desc')
            ->get();
    }
}