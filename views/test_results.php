<?=$test_results; ?>

<?=form_open($form_action); ?>
	<?=form_hidden('test', $test); ?>
	
	<div class="submit_wrapper">
		<?=form_submit(array('name' => 'submit', 'value' => lang('retest'), 'class' => 'submit')); ?>
		&nbsp;&nbsp;<?=lang('or'); ?> <a href="<?=$tests_index_url; ?>" title="<?=lang('start_over'); ?>"><?=lang('start_over'); ?></a>.
	</div>
<?=form_close(); ?>