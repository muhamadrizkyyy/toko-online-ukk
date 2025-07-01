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
        CREATE TRIGGER return_stock
        AFTER UPDATE ON transactions
        FOR EACH ROW
        BEGIN
            IF OLD.status != NEW.status THEN
                IF NEW.status = 'cancelled' THEN
                    UPDATE products p
                    JOIN (
                        SELECT product_id, qty
                        FROM transaction_details
                        WHERE transaction_id = NEW.id
                    ) td ON p.id = td.product_id
                     SET p.stock = p.stock + td.qty;
                END IF;
            END IF;
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
