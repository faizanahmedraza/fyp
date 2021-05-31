<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('research_projects')) {
            Schema::create('research_projects', function (Blueprint $table) {
                $table->id();
                $table->string('title', 100);
                $table->string('principal_detail', 150)->nullable();
                $table->string('abstract', 200)->nullable();
                $table->string('agency_for_project', 100)->nullable();
                $table->string('account_requested', 100)->nullable();
                $table->date('date_of_submission')->nullable();
                $table->string('research_document')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_projects');
    }
}
