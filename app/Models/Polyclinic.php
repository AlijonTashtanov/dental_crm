<?php

namespace App\Models;


use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{
    use Status;
    public $active = 2;
    public $inactive = 0;
    public $waiting = 1;

    /**
     * @var array
     */
    protected $fillable = ['name', 'phone', 'address', 'region_id', 'status'];

    /**
     * @param $search
     * @return Builder
     */
    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getStatus()
    {
        if ($this->status == $this->active){
            return 'Faol';
        }elseif ($this->status == $this->inactive){
            return 'Nofaol';
        }else{
            return 'Kutish holatida';
        }
    }




}
