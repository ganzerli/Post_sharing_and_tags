<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Tag;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->timestamps();
        });

        $tags = ['Php','Javascript','SQL','Laravel','Coding','App','Internet'];

        foreach ($tags as $tag) {
            $t = new Tag();
            $t->name = $tag;
            $t->save(); 
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
