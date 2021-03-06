<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sermon extends Model
{
    protected $guarded = [];
    protected $appends = ['fullTitle'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get all preachers for this sermon
     * @return array Preachers (by service id)
     */
    public function getPreachersAttribute()
    {
        $preachers = [];
        foreach ($this->services as $service) {
            $preachers[$service->id] = $service->preachers;
        }
        return $preachers;
    }

    /**
     * Get accessible sermons, i.e. those preached in the same city, or by the currently logged-in user
     * @param City $city
     * @return Sermon[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getList(City $city) {
        $sermons = self::all()->filter(function ($value, $key) use ($city) {
            foreach ($value->services as $service) {
                $user = Auth::user();
                if ($service->city->id == $city->id) return true;
                if (collect($service->preachers)->contains(Auth::user())) return true;
            }
        });
        $list = [];
        foreach ($sermons as $sermon) {
            foreach ($sermon->services as $service) {
                $sermon->name = $service->oneLiner().' "'.$sermon->title
                        .($sermon->subtitle ? ': '.$sermon->subtitle : '')
                    .'" ('.$sermon->reference.')';
                $list[$service->dateTime()->format('YmdHi')] = $sermon;
            }

        }
        ksort($list);
        return $list;
    }

    public function getFullTitleAttribute()
    {
        return $this->title.($this->subtitle ? ': '.$this->subtitle : '');
    }

}
