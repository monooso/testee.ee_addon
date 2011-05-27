<?=$test_results; ?>

<?=form_open($form_action); ?>
	<?php foreach ($tests AS $test): ?>
	<?=form_hidden('tests[]', $test); ?>
	<?php endforeach; ?>
	
	<div class="submit_wrapper">
		<?=form_submit(array('class' => 'submit', 'id' => 'retest_submit', 'name' => 'retest_submit', 'value' => lang('retest'))); ?>
		&nbsp;&nbsp;<?=lang('or'); ?> <a href="<?=$tests_index_url; ?>" title="<?=lang('start_over'); ?>"><?=lang('start_over'); ?></a>.
	</div>
<?=form_close(); ?>