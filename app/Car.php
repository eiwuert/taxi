<?php

namespace App;

use Morilog\Jalali\jDateTime;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['number', 'color', 'user_id', 'type_id', 'hull_insurance_expire', 
                'third_party_insurance_expire',  'technical_diagnosis_expire', 
                'technical_diagnosis_number', 'card', 'type_of',  'system', 'brigade', 
                'year', 'fuel', 'capacity', 'cylinder', 'axis', 'wheel', 'motor', 'chassis', 'vin'];

    public static $info = ['number', 'color', 'type_id'];

    /**
     * A car can have one user(driver).
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function driver()
    {
        return $this->hasOne('App\User');
    }

    /**
     * A car can have one car type.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function type()
    {
        return $this->hasOne('App\CarType', 'id', 'type_id');
    }

    /**
     * Get plate segment by segment.
     * @param  integer|null $segment
     * @return string|array|null
     */
    public function segments($segment = null)
    {
        $plate = [];
        if (in_array(substr($this->number, 0, 2), ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'])) {
            $plate[] = substr($this->number, 0, 4);
            $plate[] = substr($this->number, 4, 2);
            $plate[] = substr($this->number, 6, 6);
            $plate[] = substr($this->number, -4);
        } else {
            $plate[] = substr($this->number, 0, 2);
            $plate[] = substr($this->number, 2, 1);
            $plate[] = substr($this->number, 3, 3);
            $plate[] = substr($this->number, -2);
        }
        if (is_null($segment)) {
            return $plate;
        } else {
            return $plate[$segment] ?? null;
        }
    }

    /**
     * Set the hull insurance expire value.
     *
     * @param  string  $date
     * @return void
     */
    public function setHullInsuranceExpireAttribute($date)
    {
        $this->attributes['hull_insurance_expire'] = jDatetime::createDatetimeFromFormat('Y/m/d', $date);
    }

    /**
     * Get the hull insurance expire value.
     *
     * @param  string  $date
     * @return string
     */
    public function getHullInsuranceExpireAttribute($date)
    {
        return jDateTime::strftime('Y/m/d', strtotime($date));
    }

    /**
     * Set the third party insurance expire value.
     *
     * @param  string  $date
     * @return void
     */
    public function setThirdPartyInsuranceExpireAttribute($date)
    {
        $this->attributes['third_party_insurance_expire'] = jDatetime::createDatetimeFromFormat('Y/m/d', $date);
    }

    /**
     * Get the third party insurance value.
     *
     * @param  string  $date
     * @return string
     */
    public function getThirdPartyInsuranceExpireAttribute($date)
    {
        return jDateTime::strftime('Y/m/d', strtotime($date));
    }

    /**
     * Set the technical diagnosis expire value.
     *
     * @param  string  $date
     * @return void
     */
    public function setTechnicalDiagnosisExpireAttribute($date)
    {
        $this->attributes['technical_diagnosis_expire'] = jDatetime::createDatetimeFromFormat('Y/m/d', $date);
    }

    /**
     * Get the technical diagnosis expire value.
     *
     * @param  string  $date
     * @return string
     */
    public function getTechnicalDiagnosisExpireAttribute($date)
    {
        return jDateTime::strftime('Y/m/d', strtotime($date));
    }

    /**
     * Format the number value.
     *
     * @param  string  $value
     * @return void
     */
    public static function formatNumber($request)
    {
        return convert($request->platePart1) . 
                $request->platePart2 . 
                convert($request->platePart3) . ' - ایران ' . 
                convert($request->platePart4);
    }
}
