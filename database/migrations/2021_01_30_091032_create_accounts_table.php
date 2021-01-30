<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->bigInteger('store_id')->nullable();
            $table->string('account_name',255);
            $table->string('account_no',100)->default(null);
            $table->string('branch',50)->default(null);
            $table->tinyInteger('account_type')->default(null)->comment('1=saving,2=current,3=joint account');
            $table->string('swift_code',100)->default(null);
            $table->string('route_no')->default(null);
            $table->softDeletes('deleted_at')->default(null);
            $table->timestamps();

            //foreign key
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
