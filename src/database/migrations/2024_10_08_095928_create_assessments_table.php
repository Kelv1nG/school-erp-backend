<?php

use App\Enums\AssessmentStatus;
use App\Enums\AssessmentType;
use App\Models\SubjectYear;
use App\Models\Teacher;
use App\Models\User;
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
        Schema::create('assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(SubjectYear::class, 'subject_year_id');
            $table->foreignIdFor(Teacher::class, 'prepared_by');
            $table->foreignIdFor(User::class, 'approved_by')->nullable();

            $table->enum('assessment_type', array_column(AssessmentType::cases(), 'value'));
            $table->string('title');
            $table->text('instructions')->nullable();
            $table->tinyInteger('total_questions');
            $table->boolean('is_approved')->default(false);
            $table->tinyInteger('duration_mins')->nullable();
            $table->boolean('randomize_sequence')->default(false);
            $table->enum('status', array_column(AssessmentStatus::cases(), 'value'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
