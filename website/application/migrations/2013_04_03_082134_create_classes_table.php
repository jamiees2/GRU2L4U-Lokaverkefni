<?php

class Create_Classes_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes', function($table){
			$table->increments('id');
			$table->string('name');
			$table->text('description');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classes');
	}

}