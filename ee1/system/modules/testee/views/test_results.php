<h1><?=lang('test_results_title')?></h1>
<?=$test_results; ?>

<?=$FNS->form_declaration(array('action' => $form_action, 'secure' => FALSE)); ?>
	<?php foreach ($tests AS $test): ?>
	<input name="tests[]" type="hidden" value="<?=$test; ?>" />
	<?php endforeach; ?>
	
	<div class="submit_wrapper">
		<input class="submit" id="repeat_tests" name="repeat_tests" type="submit" value="<?=lang('retest'); ?>" />
		&nbsp;&nbsp;<?=lang('or'); ?> <a href="<?=$tests_index_url; ?>" title="<?=lang('start_over'); ?>"><?=lang('start_over'); ?></a>.
	</div>
</form>
