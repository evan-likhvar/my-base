<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('note_id')->index();
            $table->string('locale',2);
            $table->string('title',250);
            $table->text('note');
            $table->text('content')->nullable();
            $table->text('owner_note_comment')->nullable()->comment('for site owner note text');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('note_id')->references('id')->on('notes');
            $table->unique(['note_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_notes');
    }
}
