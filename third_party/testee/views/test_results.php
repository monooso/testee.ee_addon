<!-- Test results -->
<?php echo $results; ?>

<!-- Hidden form, so we can re-run the tests. -->
<?php

  echo form_open($form_action);

  foreach ($tests AS $test)
  {
    echo form_hidden('tests[]', $test);
  }

  echo '<div class="submit_wrapper">';
	
  echo form_submit(array(
    'class' => 'submit',
    'id'    => 'retest_submit',
    'name'  => 'retest_submit',
    'value' => lang('retest')
  ));

  echo '&nbsp;&nbsp;' .lang('or') .'&nbsp;&nbsp;';
  echo '<a href="' .$tests_index_url .'" title="' .lang('start_over') .'">';
  echo lang('start_over');
  echo '</a>';
  echo '</div>';
  echo form_close();

?>
