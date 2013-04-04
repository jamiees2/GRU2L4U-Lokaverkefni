<?php

class Create_Rooms_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rooms', function($table){
			$table->increments('id');
			$table->string('number');
			$table->integer('type')->unsigned();
			$table->foreign('type')->references('id')->on('types');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rooms');
	}

}