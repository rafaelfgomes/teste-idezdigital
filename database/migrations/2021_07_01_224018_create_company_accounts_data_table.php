<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAccountsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_accounts_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount', 12, 2);
            $table->boolean('is_company');
            $table->string('company_name', 60);
            $table->string('fantasy_name', 40);
            $table->bigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_accounts_data');
    }
}
