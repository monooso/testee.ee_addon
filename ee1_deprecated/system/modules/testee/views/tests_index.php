<?php if ($tests): ?>

<h1><?=lang('testee_module_name')?> <span>(v<?=$module_version; ?>)</span></h1>

<?=$FNS->form_declaration(array('action' => $form_action, 'secure' => FALSE)); ?>
<ul class="addons_index">	

<?php foreach ($tests AS $addon): ?>
	<li class="expanded">
		<div class="addon_title">
			<a href="#addon_<?=strtolower($addon->name); ?>" title="<?=str_replace('%addon_name%', ucfirst($addon->name), lang('test_link_title')); ?>">
				<?=str_replace('%addon_name%', ucfirst($addon->name), lang('test_link_title')); ?>
			</a>
			<label>
				<input type="checkbox" /> <?=ucfirst($addon->name); ?>
				<span>(<?=count($addon->tests) .' ' .(count($addon->tests) === 1 ? lang('test') : lang('tests')); ?>)</span>
			</label>
		</div>

		<ul class="addon_tests" id="addon_testee">
			<?php foreach ($addon->tests AS $test): ?>
			<li><label><input name="tests[]" type="checkbox" value="<?=$test->file_path; ?>" /> <?=$test->file_name; ?></label></li>
			<?php endforeach; ?>
		</ul>
	</li>
<?php endforeach; ?>
</ul><!-- /.addons_index -->

<div class="submit_wrapper"><input class="submit" name="submit" type="submit" value="<?=lang('run_tests'); ?>" /></div>
</form>

<?php else: ?>

<p><?=lang('no_tests'); ?></p>

<?php endif; ?>