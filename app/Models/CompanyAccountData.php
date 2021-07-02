<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAccountData extends Model
{
    /**
     * @var string
     */
    protected $table = 'company_accounts_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'fantasy_name', 'account_id'
    ];
}
