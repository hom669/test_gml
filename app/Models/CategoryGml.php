<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id_category
 * @property string $name_category
 * @property string $created_at
 * @property string $updated_at
 * @property UsersGml[] $usersGmls
 */
class CategoryGml extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categories_gml';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_category';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name_category', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersGmls()
    {
        return $this->hasMany('App\UsersGml', 'id_category', 'id_category');
    }
}
