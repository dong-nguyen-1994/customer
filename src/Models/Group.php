<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Customer\Models\Group
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Customer\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Customer\Models\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    protected $table = 'customer__groups';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
