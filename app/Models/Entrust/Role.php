<?php
/**
 * Created by PhpStorm.
 * User: NoteBook
 * Date: 13.01.2019
 * Time: 16:23
 */

namespace App\Models\Entrust;


use App\User;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $guarded = [];
    public function users()
    {
        return $this->belongsToMany(User::class,'role_user','role_id');
    }
}