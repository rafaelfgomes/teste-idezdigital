<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'uuid', 'company_name', 'fantasy_name', 'company_document', 'account_id'
    ];

    /**
     * Get the account of this account data
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
