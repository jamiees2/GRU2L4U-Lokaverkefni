<?php

class Add_Rooms {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//Add all the rooms to the table
		$table = DB::table('rooms');
		//630, 631, 634, 635, 636, 637, 638, 639 Almennar
		//632, 633 Sérhæfðar
		foreach (array(630, 631, 634, 635, 636, 637, 638, 639) as $value) {
			$table->insert(array('number' => $value, 'type' => 3));
		}
		foreach (array(632,633) as $value) {
			$table->insert(array('number' => $value, 'type' => 4));
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$table = DB::table('rooms');
		$table->where_in('id',array(630, 631, 634, 635, 636, 637, 638, 639, 632,633))->delete();
	}

}