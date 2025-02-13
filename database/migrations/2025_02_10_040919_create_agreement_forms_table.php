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
        Schema::create('agreement_forms', function (Blueprint $table) {
            $table->id();
            // Party A (Applicant) Information
            $table->string('full_name');
            $table->string('passport_number')->nullable();
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('spouse_name')->nullable();
            $table->string('spouse_passport_number')->nullable();
            $table->text('children_names')->nullable();
            $table->text('children_passport_numbers')->nullable();

            // Destination and Services
            $table->string('study_destination');
            $table->json('services_required');
            $table->integer('consultancy_service_fee')->default(1200);

            // Payment Details
            $table->integer('file_opening_fee')->default(100);
            $table->integer('application_fees')->default(100);
            $table->integer('admission_service_charge')->default(100);
            $table->integer('first_year_tuition_fees')->default(5000);
            $table->integer('health_insurance')->default(200);
            $table->integer('residence_permit_fees')->default(350);
            $table->integer('vfs_fees')->default(70);
            $table->integer('travel_food_accommodation')->default(500);
            $table->integer('air_ticket')->default(850);
            $table->integer('final_service_fee')->default(1000);
            $table->integer('house_rent_deposit')->default(600);
            $table->integer('total_estimated_expenses')->nullable();
            // Bank Statement Requirement
            $table->boolean('bank_statement_confirmation');
            $table->integer('amount_required')->default(9600);

            // Refund Policy
            $table->boolean('refund_acknowledgment')->default(false);
            $table->boolean('exchange_rate_policy_agreement')->default(false);


            // Agreement Terms & Conditions
            $table->boolean('applicant_obligations_agreement')->default(false);
            $table->boolean('consultant_obligations_agreement')->default(false);
            $table->boolean('liability_for_breach_agreement')->default(false);
            $table->boolean('force_majeure_clause_agreement')->default(false);

            // Signature & Date
            $table->string('applicant_signature')->nullable();
            $table->string('consultant_signature')->nullable();
            $table->date('agreement_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement_forms');
    }
};
