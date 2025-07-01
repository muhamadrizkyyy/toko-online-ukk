<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("
        CREATE TRIGGER reduce_stock
        AFTER INSERT ON transaction_details
        FOR EACH ROW
        BEGIN
            UPDATE products
            SET products.stock = products.stock - NEW.qty
            WHERE id = NEW.product_id;
        END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP IF EXIST reduce_stock");
    }
};
