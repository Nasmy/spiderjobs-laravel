<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('job_apply_url');
            $table->unsignedBigInteger('job_category_id');
            $table->string('country');
            $table->string('work_place_type');
            $table->unsignedBigInteger('emp_type_id');
            $table->unsignedBigInteger('experience_level_id');
            $table->unsignedBigInteger('department_id');
            $table->dateTime('expiration_at');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('job_category_id')->references('id')->on('job_category')->onDelete('cascade');
            $table->foreign('emp_type_id')->references('id')->on('employment_types')->onDelete('cascade');
            $table->foreign('experience_level_id')->references('id')->on('experience_levels')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            /**
             * You can also create foreign key constrains
             * for the blameable attributes.
             */
            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('updated_by')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('deleted_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job');
    }
}
