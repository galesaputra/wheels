<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAction
 *
 * @package App
 * @property string $user
 * @property string $action
 * @property string $action_model
 * @property integer $action_id
*/
class Box extends Model
{
    use SoftDeletes;
    protected $table = 'box';
    protected $fillable = ['materi', 'detail'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    protected $casts = [

        'detail' => 'array',
    ];

    
}
