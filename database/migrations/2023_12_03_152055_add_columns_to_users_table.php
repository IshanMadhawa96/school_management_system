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
            $table->string('last_name')->nullable()->after('name');
            $table->string('admission_number',50)->nullable()->after('last_name');
            $table->string('roll_number',50)->nullable()->after('admission_number');
            $table->integer('class_id')->nullable()->after('roll_number');
            $table->string('gender',50)->nullable()->after('class_id');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->string('caste',50)->nullable()->after('date_of_birth');
            $table->string('religion',50)->nullable()->after('caste');
            $table->string('mobile_number',15)->nullable()->after('religion');
            $table->date('admission_date')->nullable()->after('mobile_number');
            $table->string('profile_pic')->nullable()->after('admission_date');
            $table->string('blood_group',10)->nullable()->after('profile_pic');
            $table->string('height',10)->nullable()->after('blood_group');
            $table->string('weight',10)->nullable()->after('height');
            $table->tinyInteger('status')->default(0)->comment('0:active,1:inactive')->after('weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
