<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_title',255)->nullable();
            $table->string('permalink',255)->nullable();
            $table->string('meta_title',255)->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('page_description')->nullable();
            $table->string('feature_image',255)->nullable();
            $table->integer('show_in_footer')->default(0);
            $table->integer('show_in_header')->default(0);
            $table->integer('order_no')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
