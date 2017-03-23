<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Operator\Model;

use App\Core\Model\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Operator
 * @package App\Models
 */
class Operator extends AbstractModel
{
    /**
     * @var string
     */
    protected $collection = 'operator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'operator_level_id',
        'phonenumber',
        'password_reset_token',
    ];

    /**
     * @return BelongsTo
     */
    public function level() : BelongsTo
    {
        return $this->belongsTo(
            'App\OperatorLevel\Model\OperatorLevel',
            'operator_level_id'
        );
    }

    /**
     * @param $password
     */
    public function saveNewPassword($password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->update(['password' => $password]);
        $this->unset('password_reset_token');
    }
}