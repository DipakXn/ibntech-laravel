<?php

use App\Services\CookieConsent\CookieConsentDefaults;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cookie_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description');
            $table->text('details')->nullable();
            $table->boolean('is_mandatory')->default(false);
            $table->boolean('is_enabled')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('cookie_registry_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cookie_category_id')->constrained('cookie_categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('provider');
            $table->text('purpose');
            $table->string('duration')->nullable();
            $table->string('domain')->nullable();
            $table->string('privacy_policy_url')->nullable();
            $table->string('integration_key')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('cookie_integrations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category_key');
            $table->json('consent_categories');
            $table->boolean('is_enabled')->default(false);
            $table->json('environments');
            $table->string('measurement_id')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('cookie_consent_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('banner_enabled')->default(true);
            $table->string('banner_position')->default('bottom');
            $table->unsignedSmallInteger('consent_lifetime_days')->default(365);
            $table->string('policy_version')->default('1');
            $table->unsignedInteger('config_version')->default(1);
            $table->string('privacy_policy_url');
            $table->string('cookie_policy_url');
            $table->string('banner_title');
            $table->text('banner_text');
            $table->string('accept_label');
            $table->string('reject_label');
            $table->string('settings_label');
            $table->string('save_label');
            $table->string('modal_title');
            $table->text('modal_text');
            $table->string('jurisdiction_mode')->default('opt_in');
            $table->json('jurisdiction_rules')->nullable();
            $table->timestamps();
        });

        Schema::create('cookie_consent_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accept_all_count')->default(0);
            $table->unsignedBigInteger('reject_all_count')->default(0);
            $table->unsignedBigInteger('custom_count')->default(0);
            $table->unsignedBigInteger('withdrawal_count')->default(0);
            $table->timestamps();
        });

        CookieConsentDefaults::install();
    }

    public function down(): void
    {
        Schema::dropIfExists('cookie_consent_metrics');
        Schema::dropIfExists('cookie_consent_settings');
        Schema::dropIfExists('cookie_integrations');
        Schema::dropIfExists('cookie_registry_entries');
        Schema::dropIfExists('cookie_categories');
    }
};
