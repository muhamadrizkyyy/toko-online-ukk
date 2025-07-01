<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId("transaction_id")->constrained("transactions")->onDelete("cascade");
            $table->foreignId("payment_method_id")->constrained("payment_methods")->onDelete("cascade");
            $table->date("payment_date");
            $table->enum("payment_status", ["paid", "unpaid", "refund", "cancelled", "expire"])->default("unpaid");
            $table->text("payment_logs")->nullable();
            // $table->integer("total");
            // $table->string("proof")->nullable();
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
};
