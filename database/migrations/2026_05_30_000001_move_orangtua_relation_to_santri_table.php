<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MoveOrangtuaRelationToSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('santri', 'orangtua_id')) {
            Schema::table('santri', function (Blueprint $table) {
                $table->unsignedBigInteger('orangtua_id')->nullable();
                $table->foreign('orangtua_id')->references('id')->on('users')->onDelete('set null');
            });
        }

        if (Schema::hasColumn('userdetail', 'santri_id')) {
            DB::table('userdetail')
                ->whereNotNull('santri_id')
                ->orderBy('id')
                ->get(['user_id', 'santri_id'])
                ->each(function ($detail) {
                    DB::table('santri')
                        ->where('id', $detail->santri_id)
                        ->whereNull('orangtua_id')
                        ->update(['orangtua_id' => $detail->user_id]);
                });

            Schema::table('userdetail', function (Blueprint $table) {
                $table->dropForeign('userdetail_santri_id_foreign');
                $table->dropColumn('santri_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('userdetail', 'santri_id')) {
            Schema::table('userdetail', function (Blueprint $table) {
                $table->unsignedBigInteger('santri_id')->nullable();
                $table->foreign('santri_id')->references('id')->on('santri')->onDelete('set null');
            });
        }

        if (Schema::hasColumn('santri', 'orangtua_id') && Schema::hasColumn('userdetail', 'santri_id')) {
            DB::table('santri')
                ->whereNotNull('orangtua_id')
                ->orderBy('id')
                ->get(['id', 'orangtua_id'])
                ->each(function ($santri) {
                    DB::table('userdetail')
                        ->where('user_id', $santri->orangtua_id)
                        ->whereNull('santri_id')
                        ->limit(1)
                        ->update(['santri_id' => $santri->id]);
                });
        }

        if (Schema::hasColumn('santri', 'orangtua_id')) {
            Schema::table('santri', function (Blueprint $table) {
                $table->dropForeign('santri_orangtua_id_foreign');
                $table->dropColumn('orangtua_id');
            });
        }
    }
}
