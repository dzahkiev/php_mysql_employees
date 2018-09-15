<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTable extends Migration
{

    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned();
            $table->integer('salary');
            /* для полноты необходимо раскрыть сущность
             * быть может добавить связь с таблицей отделов (если один отдел --
             * одна должность -- одна зарплата?) либо завести
             * таблицу со значениями должностей?
             * сделаю просто связь с работником, хотя это странно 
             */
            $table->foreign('employee_id')
                ->references('id')
                ->on('employee')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
