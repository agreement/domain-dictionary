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

        $statuses = \Illuminate\Support\Facades\DB::table('domains')->groupBy('status')->pluck('status');

        foreach($statuses as $status)
        {
            \Illuminate\Support\Facades\DB::table('domains')
                ->where('status', '=', $status)
                ->update(['available' => \Privateer\Domainr\Status::available($status)]);
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
