<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory; //SoftDeletes;

    protected $fillable = ['type_id', 'title', 'content'];

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }


    public function getAbstract($n_chars = 30)
    {
        return (strlen($this->content) > $n_chars) ? substr($this->content, 0, $n_chars) . '...' : $this->content;
    }
    public function getTechnologiesToText()
    {
        return implode(', ', $this->technologies->pluck('label')->toArray());
    }
}
