<?php

namespace Module\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Module\ZoneModule\Models\ZoneDistrict;
use Module\ZoneModule\Models\ZoneProvince;
use Module\ZoneModule\Models\ZoneTownship;

/**
 * Module\Customer\Models\Address
 *
 * @property int $id
 * @property int $customer_id
 * @property string|null $name Full Name
 * @property string|null $firstname
 * @property string|null $middlename
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $country_id Country ID
 * @property int|null $zone_level_1 Province/Municipality ID
 * @property int|null $zone_level_2 County/District ID
 * @property int|null $zone_level_3 Ward/Commune ID
 * @property string|null $street Street Address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Module\Customer\Models\Customer $customer
 * @property-read \Module\ZoneModule\Models\ZoneDistrict|null $district
 * @property-read \Module\ZoneModule\Models\ZoneProvince|null $province
 * @property-read \Module\ZoneModule\Models\ZoneTownship|null $township
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereMiddlename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereZoneLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereZoneLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Module\Customer\Models\Address whereZoneLevel3($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
    protected $table = 'customer__addresses';

    protected $fillable = [
        'customer_id',
        'name',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'phone',
        'country_id',
        'zone_level_1',
        'zone_level_2',
        'zone_level_3',
        'street',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function province()
    {
        return $this->belongsTo(ZoneProvince::class, 'zone_level_1', 'id');
    }

    public function district()
    {
        return $this->belongsTo(ZoneDistrict::class, 'zone_level_2', 'id');
    }

    public function township()
    {
        return $this->belongsTo(ZoneTownship::class, 'zone_level_3', 'id');
    }

    public function getFullAddressAttribute()
    {
        return $this->firstname . ' ' . $this->lastname . ' - '. $this->street . ' - ' . $this->township->name. ' - ' . $this->district->name . ' - ' . $this->province->name;
    }
}
