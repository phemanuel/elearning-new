<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instructor_id');
            $table->string('currency');
            $table->decimal('amount',10,2);
            $table->string('method');
            $table->string('txnid');
            $table->integer('plan_id');
            $table->integer('no_of_months');
            $table->decimal('total_amount',10,2);
            $table->integer('status')->default(0)->comment('0 pending, 1 successfull, 2 fail');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_payments');
    }
};
