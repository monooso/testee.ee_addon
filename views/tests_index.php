<?php if ($tests): ?>
	
<?=form_open($form_action); ?>
<ul class="addons_index">	

<?php foreach ($tests AS $addon): ?>
	<li class="expanded">
		<div class="addon_title">
			<a href="#addon_<?=strtolower($addon->name); ?>" title="Jump to the <?=ucfirst($addon->name); ?> tests">Jump to the <?=ucfirst($addon->name); ?> tests</a>
			<label><input type="checkbox" /> <?=ucfirst($addon->name); ?>
				<span>(<?=count($addon->tests) .' ' .(count($addon->tests) === 1 ? 'test' : 'tests'); ?>)</span>
			</label>
		</div>

		<ul class="addon_tests" id="addon_testee">
			<?php foreach ($addon->tests AS $test): ?>
			<li><label><?=form_checkbox('tests[]', $test->file_path, FALSE); ?> <?=$test->file_name; ?></label></li>
			<?php endforeach; ?>
		</ul>
	</li>
<?php endforeach; ?>
</ul><!-- /.addons_index -->

<div class="submit_wrapper"><?=form_submit(array('name' => 'submit', 'value' => 'Run Selected Tests', 'class' => 'submit')); ?></div>
<?=form_close(); ?>

<?php else: ?>

<p>No tests!</p>

<?php endif; ?>