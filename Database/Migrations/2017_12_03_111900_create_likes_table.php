<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateLikesTable extends XotBaseMigration {
    public function up() {
        //-- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                    $table->increments('id');
                    $table->unsignedInteger('user_id');

                    //$table->unsignedInteger('likeable_id');
                    //$table->string('likeable_type');
                    $table->nullableMorphs('likeable');
                    $table->timestamps();
                }
            );


        //-- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                //if (! $this->hasColumn('post_id')) {
                //    $table->integer('post_id')->nullable();
                //}
            }
        );
    }
}
