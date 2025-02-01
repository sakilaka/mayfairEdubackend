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
        Schema::create('university_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_code')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('chinese_name')->nullable();
            $table->text('contact_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_exipre_date')->nullable();
            $table->unsignedBigInteger('nationality')->default(0);
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->string('maritial_status')->nullable();
            $table->boolean('in_chaina')->nullable();
            $table->tinyInteger('in_alcoholic')->nullable();
            $table->text('hobby')->nullable();
            $table->string('native_language')->nullable();
            $table->tinyInteger('english_level')->nullable();
            $table->string('english_proficiency_certificate')->nullable();
            $table->string('english_score')->nullable();
            $table->date('certificate_issue_date')->nullable();
            $table->tinyInteger('chinese_level')->nullable();
            $table->string('HSK_level', 50)->nullable();
            $table->string('HSK_score', 50)->nullable();
            $table->string('HSK_report_no', 100)->nullable();
            $table->string('HSKK_level', 50)->nullable();
            $table->string('HSKK_score', 50)->nullable();
            $table->string('home_country')->nullable();
            $table->string('home_city')->nullable();
            $table->string('home_district')->nullable();
            $table->string('home_street')->nullable();
            $table->string('home_zipcode')->nullable();
            $table->string('home_contact_name')->nullable();
            $table->string('home_contact_phone')->nullable();
            $table->string('current_country')->nullable();
            $table->string('current_city')->nullable();
            $table->string('current_district')->nullable();
            $table->string('current_street')->nullable();
            $table->string('current_zipcode')->nullable();
            $table->string('current_contact_name')->nullable();
            $table->string('current_contact_phone')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_nationlity')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_workplace')->nullable();
            $table->string('father_position')->nullable();
            $table->string('father_relationship')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_nationlity')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_workplace')->nullable();
            $table->string('mother_position')->nullable();
            $table->string('guarantor_inter_relation', 200)->nullable();
            $table->string('guarantor_relationship')->nullable();
            $table->string('guarantor_name')->nullable();
            $table->string('guarantor_address')->nullable();
            $table->string('guarantor_phone')->nullable();
            $table->string('guarantor_email')->nullable();
            $table->string('guarantor_workplace')->nullable();
            $table->string('guarantor_work_address')->nullable();
            $table->string('study_fund')->nullable();
            $table->text('scholarship')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_email')->nullable();
            $table->string('emergency_contact_address')->nullable();
            $table->string('service_id', 200)->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->double('total_fee', 8, 2)->default(0.00);
            $table->double('optional_fee', 8, 2)->default(0.00);
            $table->double('service_charge', 8, 2)->default(0.00);
            $table->double('application_fee', 8, 2)->default(0.00);
            $table->double('discount_fee', 8, 2)->default(0.00);
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();
            $table->unsignedTinyInteger('payment_status')->default(0);
            $table->integer('payment_status_application')->default(0);
            $table->string('partner_ref_id')->nullable();
            $table->integer('is_applied_partner')->nullable();
            $table->text('applied_by')->nullable();
            $table->string('is_anonymous')->nullable();
            $table->text('programs')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->integer('paid_application_fees')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_applications');
    }
};