<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Dataview;
class Customer extends Model
{
    use DataView;
    public static $columns = [
        'id', 'name', 'email', 'phone', 'created_at', 'updated_at'
    ];
}
