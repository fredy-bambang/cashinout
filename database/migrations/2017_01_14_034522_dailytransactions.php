<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Dailytransactions.
 *
 * @author  The scaffold-interface created at 2017-01-14 03:45:22pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Dailytransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('dailytransactions',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('Description');
        
        $table->float('Cost');
        
        $table->String('InOut');
        
        /**
         * Foreignkeys section
         */
        
        
        $table->timestamps();
        
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('dailytransactions');
    }
}
