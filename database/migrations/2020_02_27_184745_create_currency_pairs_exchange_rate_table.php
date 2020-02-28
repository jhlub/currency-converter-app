<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyPairsExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_pairs_exchange_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('base_currency_id');
            $table->unsignedBigInteger('quote_currency_id');
            $table->decimal('exchange_rate', 10, 4);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('base_currency_id')
                ->references('id')->on('currencies')
                ->onDelete('cascade');
            
            $table->foreign('quote_currency_id')
                ->references('id')->on('currencies')
                ->onDelete('cascade');

            $table->unique(['base_currency_id', 'quote_currency_id'], 'currency_pairs_index_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasTable('currency_pairs_exchange_rate')) {
            Schema::table('currency_pairs_exchange_rate', function (Blueprint $table) {
                // TODO Temporary hackish for testing. .env.testing DB_FOREIGN_KEYS=true doesnt work
                if (DB::getDriverName() !== 'sqlite') {
                    $table->dropForeign(['base_currency_id']);
                    $table->dropForeign(['quote_currency_id']);
                }
                $table->drop('currency_pairs_exchange_rate');
            });
        }
    }
}
