<?php

namespace App;

use App\InstallRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestStatus extends Model
{
    use SoftDeletes;
	protected $primaryKey = 'id_status';
    protected $dates = ['deleted_at'];

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
        return $this->hasMany(InstallRequest::class, 'id_status', 'id_status');
    }
}
