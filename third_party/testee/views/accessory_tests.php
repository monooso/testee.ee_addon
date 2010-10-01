<?php if ($tests): ?>
	
<?=form_open('C=addons_accessories'.AMP.'M=process_request'.AMP.'accessory=testee'.AMP.'method=process_save'); ?>
<?=form_hidden('url', $url)?>

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
			<li><label><?=form_checkbox('tests[]', $test->file_path, FALSE); ?> <?=$test->file_name; ?></label></li>
			<?php endforeach; ?>
		</ul>
	</li>
<?php endforeach; ?>
</ul><!-- /.addons_index -->

<div class="submit_wrapper"><?=form_submit(array('name' => 'submit', 'value' => lang('run_tests'), 'class' => 'submit')); ?></div>
<?=form_close(); ?>

<?php else: ?>

<p><?=lang('no_tests'); ?></p>

<?php endif; ?>

<style type="text/css" media="screen">
	/**
	 * Test-driven add-on development module.
	 *
	 * @package		Testee
	 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
	 * @copyright	Experience Internet
	 */

	/* =addons_index
	 -------------------------------------------------------------*/
	.addons_index {
	line-height : 20px;
	}

	.addons_index input[type='checkbox'] {margin-right : 3px;}

	.addons_index label {
	display : block;
	line-height : 20px;
	margin : 0;
	padding : 5px 0;
	}

	.addons_index li {border-bottom : 1px solid rgba(0, 0, 0, 0.1);}


	/* =addon_title
	 -------------------------------------------------------------*/


	/* Pseudo classes are required to override EE styles, bizarrely */
	.addon_title a,
	.addon_title a:link,
	.addon_title a:hover {
	background-color : transparent;
	background-image : url('../img/arrow.png');
	background-repeat : no-repeat;
	display : inline-block;
	margin-right : 5px;
	padding : 5px 0;
	text-decoration : none;
	text-indent : -9999em;
	width : 10px;
	}

	.addons_index .addon_title label {display : inline-block;}

	.addon_title label span {
	color : rgb(153, 153, 153);
	font-size : 0.9em;
	font-weight : normal;
	}


	/* =addon_tests
	 -------------------------------------------------------------*/
	.addon_tests {
	padding-left : 40px;
	}

	.collapsed .addon_tests {display : none;}

	.addon_tests label {font-weight : normal;}

	.addon_tests li {border-bottom-style : dotted;}


	/* =submit_wrapper
	 -------------------------------------------------------------*/
	.submit_wrapper {
	padding : 1.5em 5px 1.5em 10px;
	text-align : left;
	}


	/* =test_result_summary
	 -------------------------------------------------------------*/
	.test_result_summary {
	-moz-border-radius : 3px;
	-webkit-border-radius : 3px;
	background-color : rgb(102, 102, 102);
	border-radius : 3px;
	color : rgb(255, 255, 255);
	font-weight : bold;
	line-height : 20px;
	margin : 0;
	padding : 5px 10px;
	}

	.test_result_summary p {margin : 0 !important;}

	.test_result_success {background-color : rgb(0, 153, 0);}

	.test_result_failure {background-color : rgb(220, 0, 0);}


	/* =test_result
	 -------------------------------------------------------------*/
	.test_result {
	border-bottom : 1px dotted rgba(0, 0, 0, 0.1);
	margin : 0 0 1em !important;
	padding-bottom : 5px;
	padding-left : 100px;
	}

	.badge {
	-moz-border-radius : 3px;
	-webkit-border-radius : 3px;
	background : rgba(0, 0, 0, 0.5);
	border-radius : 3px;
	border-top : 1px solid rgba(0, 0, 0, 0.25);
	color : rgb(255, 255, 255);
	float : left;
	font-size : 10px;
	font-weight : bold;
	margin-left : -100px;
	margin-right : 10px;
	padding : 4px 10px 5px;
	text-transform : uppercase;
	}

	.test_result_details {
	font-family : Menlo, Inconsolata, 'Courier New', monospace;
	font-size : 11px;
	line-height : 1.5;
	margin-bottom : 1.5em;
	}

	.test_result_details strong {display : block;}
	
</style>

<script type="text/javascript" charset="utf-8">
	/**
	 * Test-driven add-on development module.
	 *
	 * @package		Testee
	 * @author		Stephen Lewis <stephen@experienceinternet.co.uk>
	 * @copyright	Experience Internet
	 */

	$('.addons_index > li').removeClass('expanded').addClass('collapsed');

	$('.addon_title a').click(function(e) {
		$(this).closest('.addon_title').next('.addon_tests').slideToggle();
		$(this).closest('li').toggleClass('collapsed expanded');

		e.preventDefault();
	});

	$('.addon_title :checkbox').click(function() {
		$(this).attr('checked')
			? $(this).closest('.addon_title').next('.addon_tests').find(':checkbox').attr('checked', 'checked')
			: $(this).closest('.addon_title').next('.addon_tests').find(':checkbox').removeAttr('checked')
	});
</script>