<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->cascadeOnDelete();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->unsignedTinyInteger('rating');
                $table->string('title')->nullable();
                $table->text('comment')->nullable();
                $table->text('pros')->nullable();
                $table->text('cons')->nullable();
                $table->string('status')->default('approved');
                $table->boolean('is_verified_purchase')->default(false);
                $table->unsignedInteger('helpful_count')->default(0);
                $table->timestamps();

                $table->index(['product_id', 'status']);
                $table->unique(['product_id', 'user_id']);
            });
        } else {
            Schema::table('reviews', function (Blueprint $table) {
                if (!Schema::hasColumn('reviews', 'title')) {
                    $table->string('title')->nullable()->after('rating');
                }
                if (!Schema::hasColumn('reviews', 'pros')) {
                    $table->text('pros')->nullable()->after('comment');
                }
                if (!Schema::hasColumn('reviews', 'cons')) {
                    $table->text('cons')->nullable()->after('pros');
                }
                if (!Schema::hasColumn('reviews', 'status')) {
                    $table->string('status')->default('approved')->after('cons');
                }
                if (!Schema::hasColumn('reviews', 'is_verified_purchase')) {
                    $table->boolean('is_verified_purchase')->default(false)->after('status');
                }
                if (!Schema::hasColumn('reviews', 'helpful_count')) {
                    $table->unsignedInteger('helpful_count')->default(0)->after('is_verified_purchase');
                }
            });
        }

        if (!Schema::hasTable('review_helpful_votes')) {
            Schema::create('review_helpful_votes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('review_id')->constrained()->cascadeOnDelete();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->timestamps();

                $table->unique(['review_id', 'user_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('review_helpful_votes');

        if (Schema::hasTable('reviews')) {
            Schema::table('reviews', function (Blueprint $table) {
                foreach (['title', 'pros', 'cons', 'status', 'is_verified_purchase', 'helpful_count'] as $column) {
                    if (Schema::hasColumn('reviews', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
