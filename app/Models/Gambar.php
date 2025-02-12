<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $table = 'gambars';
    
    protected $primaryKey = 'id_image';
    protected $fillable = [
        'id_project',
        'image_name',
        'image_desc'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project', 'id_project');
    }

    // Mutator: Pastikan selalu disimpan sebagai string
    public function setImageDescAttribute($value)
    {
        // Jika data berupa array, ubah menjadi string (dipisahkan koma)
        if (is_array($value)) {
            $this->attributes['image_desc'] = implode(',', $value);
        } else {
            $this->attributes['image_desc'] = $value;
        }
    }

    // Accessor: Pastikan selalu diambil sebagai array
    public function getImageDescAttribute($value)
    {
        return explode(',', $value);
    }
}
