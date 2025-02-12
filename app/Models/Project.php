<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    
    protected $primaryKey = 'id_project';
    protected $fillable = [
        'project_name',
        'description',
        'location',
        'year',
        'category',
        'size',
        'status',
        'client',
        'gambar'
    ];

    public function gambar()
    {
        return $this->hasMany(Gambar::class, 'id_project', 'id_project');
    }

}
