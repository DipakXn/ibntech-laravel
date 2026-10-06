<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('old_submissions', function (Blueprint $table): void {
            $table->id();
            $table->string('external_submission_id', 64)->unique();
            $table->string('form_name')->index();
            $table->string('source_file');
            $table->dateTime('submitted_at')->index();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone', 100)->nullable();
            $table->string('company')->nullable();
            $table->string('service')->nullable()->index();
            $table->string('job_title')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->longText('message')->nullable();
            $table->string('page_name')->nullable();
            $table->string('page_id', 64)->nullable();
            $table->text('page_url')->nullable();
            $table->string('lead_source')->nullable()->index();
            $table->string('utm_source')->nullable();
            $table->string('ip_address', 64)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('external_user_id', 64)->nullable();
            $table->json('fields');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('old_submissions');
    }
};
