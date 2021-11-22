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
class Lucky extends Model
{
    use SoftDeletes;
    protected $table = 'lucky';
    protected $fillable = ['kelas', 'detail','jenis','jml_kel'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    protected $casts = [

        'detail' => 'array',
    ];

    
}
