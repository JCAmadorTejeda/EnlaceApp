<?php

namespace App;

use App\User;
use App\RequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallRequest extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_request';
    protected $dates = ['deleted_at'];
    protected $table = 'installrequests';
    /**
     * @var array
     */
    protected $fillable = ['id_employee', 'numero_os', 'estado', 'ciudad', 'colonia', 'calle', 'numero', 'latitud', 'longitud', 'img_ruta', 'id_status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'id_employee', 'id_employee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requeststaut()
    {
        return $this->belongsTo(RequestStatus::class, 'id_status', 'id_status');
    }
}
