<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterBoardsTable extends Migration{

      public function up(){

          Schema::create('master_boards', function(Blueprint $table){
              $table->increments('id');
              $table->string('name');
              $table->tinyInteger('status')->default(1)->comment('Only active entries will be listed on the public end');
              $table->string('description')->nullable();
              $table->timestamps();
          });
      }


      public function down(){

          Schema::dropIfExists('master_boards');
      }
  }
