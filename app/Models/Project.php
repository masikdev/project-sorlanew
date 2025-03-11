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
        'project_name_en',
        'project_name_it',
        'project_name_id',
        'description_en',
        'description_it',
        'description_id',
        'location_en',
        'location_it',
        'location_id',
        'year',
        'category_en',
        'category_it',
        'category_id',
        'size_en',
        'size_it',
        'size_id',
        'status_en',
        'status_it',
        'status_id',
        'collaborator',
        'client',
        'gambar'
    ];

    public $timestamps = false;

    public function gambar()
    {
        return $this->hasMany(Gambar::class, 'id_project', 'id_project');
    }
}
