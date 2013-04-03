<?php

class Create_Time_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timetable', function($table){
			$table->increments('id');
			$table->integer('room_id')->unsigned();
			$table->integer('class_id')->unsigned();
			$table->timestamp('starts_at');
			$table->timestamp('ends_at');
			$table->timestamps();
			$table->foreign('room_id')->references('id')->on('rooms');
			$table->foreign('class_id')->references('id')->on('classes');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('timetable');
	}

}