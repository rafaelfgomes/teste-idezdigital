<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'account', 'agency', 'number', 'digit', 'balance', 'user_id', 'account_type_id'
    ];

    /**
     * Get the account type of this account
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }

    /**
     * Get the transactions for the account
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get users that belongs to account
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Associate comany data with an account
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function companyData(): HasOne
    {
        return $this->hasOne(CompanyAccountData::class);
    }
}
