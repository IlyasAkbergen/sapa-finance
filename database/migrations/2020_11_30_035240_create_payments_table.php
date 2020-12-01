<?php

use App\Services\Gates\PaymentGateContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('eid')
                ->nullable();
            $table->string('status')
                ->default(PaymentGateContract::PAYMENT_STATUS_CREATED);

            $table->unsignedBigInteger('payable_id');
            $table->string('payable_type');

            $table->index(['payable_id', 'payable_type']);

            $table->string('redirect_url')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
