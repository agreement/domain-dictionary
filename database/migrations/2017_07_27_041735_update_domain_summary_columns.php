<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDomainSummaryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->boolean('available')->default(false)->after('domain');
            $table->renameColumn('availability', 'status');
        });

        foreach(config('domainr.statuses') as $key => $value)
        {
            \Illuminate\Support\Facades\DB::table('domains')
                ->where('status', '=', $key)
                ->update(['available' => $value['available']]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->dropColumn('available');
            $table->renameColumn('status', 'availability');
        });
    }
}
