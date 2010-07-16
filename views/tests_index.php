<?php

if ($tests)
{
	$this->table->set_template($cp_table_template);
	$this->table->set_heading(
		'Add-on',
		'Test',
		'Action'
	);
	
	foreach ($tests AS $test)
	{
		$this->table->add_row(
			$test['addon_name'],
			$test['test_name'],
			'<a href="' .$base_test_url .urlencode($test['test_path']) .'" title="Run tests">Run tests</a>'
		);
	}
	
	echo $this->table->generate();
}
else
{
	echo '<p>No tests!</p>';
}

?>