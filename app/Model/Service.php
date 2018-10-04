<?php

namespace Lava\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table    = 'services';

    protected $fillable = [
      'name',
    ];

    /**
     * [orders description]
     *
     * @return [type] [description]
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'service_id', 'id')->withTrashed();
    }
}
