<?php

namespace App;

use App\Request;
use Illuminate\Database\Eloquent\Model;

class RequestStatus extends Model
{
	protected $primaryKey = 'id_status';

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'requeststatus';

    /**
     * @var array
     */
    protected $fillable = ['id_status','nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(Request::class, 'id_status', 'id_status');
    }
}
