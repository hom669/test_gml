<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property integer $id_user
 * @property integer $id_category
 * @property string $name_user
 * @property string $surname_user
 * @property string $identification_user
 * @property string $email_user
 * @property int $country_user
 * @property int $movil_user
 * @property int $address_user
 * @property string $created_at
 * @property string $updated_at
 * @property CategoriesGml $categoriesGml
 */
class UserGml extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'users_gml';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_category', 'name_user', 'surname_user', 'identification_user', 'email_user', 'country_user', 'movil_user', 'address_user', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriesGml()
    {
        return $this->belongsTo('App\Models\CategoryGml', 'id_category', 'id_category');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name_user', 'like', '%' . $search . '%')
                    ->orWhere('surname_user', 'like', '%' . $search . '%')
                    ->orWhere('identification_user', 'like', '%' . $search . '%')
                    ->orWhere('email_user', 'like', '%' . $search . '%')
                    ->orWhere('movil_user', 'like', '%' . $search . '%')
                    ->orWhere('address_user', 'like', '%' . $search . '%')
                    ->orWhere('category_name', 'like', '%' . $search . '%')
                    ->orWhere('country_name', 'like', '%' . $search . '%');
            });
        });
    }
}
