<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('core_clients', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->unsignedInteger('unique_id')->nullable();
            $table->integer('contact_id');
            $table->string('name', 255);
            $table->string('nickname', 255)->nullable();
            $table->unsignedInteger('tel_country_code')->nullable();
            $table->string('telephone', 100)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('email_deprecated', 255)->nullable();
            $table->string('cleaned_email_id_deprecated', 255)->nullable();
            $table->tinyInteger('is_crypto_client')->default(0);
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('internal_country_id')->nullable();
            $table->date('dob')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('mobile_country_code', 10)->nullable();
            $table->string('position', 255)->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('client_color', 10)->nullable();
            $table->string('official_salutation', 50)->nullable();
            $table->string('friendly_salutation', 50)->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->unsignedInteger('affiliate_id')->nullable();
            $table->unsignedInteger('referred_affiliate_id');
            $table->unsignedInteger('referral_link_id')->nullable();
            $table->string('registration_promo', 255)->nullable();
            $table->string('registration_source', 255)->nullable();
            $table->unsignedInteger('timezone_id')->nullable();
            $table->unsignedInteger('reports_timezone_id')->nullable();
            $table->enum('email_notifications', ['Yes', 'NA'])->default('NA');
            $table->enum('sms_notifications', ['Yes', 'NA'])->default('NA');
            $table->enum('push_notifications', ['Yes', 'NA'])->default('NA');
            $table->unsignedInteger('client_status')->nullable();
            $table->unsignedInteger('client_profile')->nullable();
            $table->string('promo_code', 255)->nullable();
            $table->dateTime('client_since')->nullable();
            $table->dateTime('created_on')->default('CURRENT_TIMESTAMP');
            $table->unsignedInteger('created_by')->nullable();
            $table->dateTime('modified_on')->nullable();
            $table->unsignedInteger('modified_by')->nullable();
            $table->dateTime('deleted_on')->nullable();
            $table->unsignedInteger('deleted_by')->nullable()->default(0);
            $table->text('test_language')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->text('test_dropwdon')->nullable();
            $table->string('clients_documents', 255)->nullable();
            $table->string('client_radio_button', 255)->nullable();
            $table->text('check_dropdown_field')->nullable();
            $table->text('custom_dropitems')->nullable();
            $table->text('town')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('password_verification_code', 255)->nullable();
            $table->dateTime('password_verification_expiration_time')->nullable();
            $table->tinyInteger('expired_password')->nullable();
            $table->dateTime('password_modified_date')->nullable();
            $table->string('code_2FA', 255)->nullable();
            $table->dateTime('code_2FA_expiration_time')->nullable();
            $table->string('code_2FA_google', 255)->nullable();
            $table->string('code_2FA_google_withdrawal', 255)->nullable();
            $table->tinyInteger('login_failed_count')->nullable()->default(0);
            $table->string('check', 255)->nullable();
            $table->string('last_session', 255)->nullable();
            $table->string('registration_ip', 255)->nullable();
            $table->string('is_difficult_client', 255)->nullable();
            $table->decimal('volume_usd', 48, 20)->nullable();
            $table->decimal('volume_eur', 48, 20)->nullable();
            $table->decimal('volume_jpy', 48, 20)->nullable();
            $table->tinyInteger('eligible_for_commission')->default(1);
            $table->unsignedInteger('commission_profile_type_id')->nullable();
            $table->text('not_eligible_for_commission_reason')->nullable();
            $table->string('client_is_in_conditional_kyc_approval', 255)->nullable();
            $table->string('what_is_this_client_missing', 1000)->nullable();
            $table->string('is_abuser', 255)->nullable();
            $table->unsignedInteger('open_demo_account_on_registration')->nullable();
            $table->unsignedInteger('open_live_account_on_registration')->nullable();
            $table->tinyInteger('registration_form_id')->nullable();
            $table->tinyInteger('terms_conditions_agreement')->default(1);
            $table->string('is_an_abuser', 255)->nullable();
            $table->text('client_characteristics')->nullable();
            $table->unsignedInteger('account_manager_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_clients');
    }
};
