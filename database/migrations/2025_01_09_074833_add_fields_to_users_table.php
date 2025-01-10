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
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->after('password');
            $table->json('field_of_work_interests')->after('gender');
            $table->string('linkedin_username')->after('field_of_work_interests');
            $table->string('mobile_number')->after('linkedin_username');
            $table->string('profession')->after('mobile_number');
            $table->integer('wallet')->default(0)->after('profession');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('field_of_work_interests');
            $table->dropColumn('linkedin_username');
            $table->dropColumn('mobile_number');
            $table->dropColumn('profession');
            $table->dropColumn('wallet');
        });
    }
};
