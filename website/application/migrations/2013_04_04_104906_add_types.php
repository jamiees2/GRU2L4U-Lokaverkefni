<?php

class Add_Types {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//Set up the types table
		//Types are 1 - Óskilgreint
		//2 - Venjuleg stofa
		//3 - Tölvustofa - almenn
		//4 - Tölvustofa - sérsniðin
		$table = DB::table('types');
		$table->insert(array('id' => 1, 'description' => 'Óskilgreint'));
		$table->insert(array('id' => 2, 'description' => 'Venjuleg stofa'));
		$table->insert(array('id' => 3, 'description' => 'Tölvustofa - almenn'));
		$table->insert(array('id' => 4, 'description' => 'Tölvustofa - sérsniðin'));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$table = DB::table('types');
		$table->delete(1);
		$table->delete(2);
		$table->delete(3);
		$table->delete(4);
	}

}