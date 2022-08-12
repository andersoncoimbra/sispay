<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    protected $fillable = [
        'user_id',
        'account_id',
        'description',
        'value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //created_at fomat d/m/Y
    public function dataBr()
    {
        return $this->created_at?$this->created_at->format('d/m/Y'):'';
    }


}
