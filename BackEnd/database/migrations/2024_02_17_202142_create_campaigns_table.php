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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('campaign_type', ['image', 'video']);
            $table->string('upload')->nullable();
            $table->enum('display_type', ['banner', 'side_bar', 'in_content']);
            $table->string('redirect_link')->nullable();
            $table->json('display_on')->nullable();
            $table->json('tags')->nullable();
            $table->string('from_start')->nullable();
            $table->string('from_end')->nullable();
            $table->string('status')->default('active');
            $table->decimal('billing_limit',12)->nullable()->default(0);
            $table->decimal('billing_spent',12)->nullable()->default(0);
            $table->string('billing_limit_action')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
