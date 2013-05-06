<?php $this->load->view('common/header'); ?>

<div class="span9 offset3">

<?php if (isset($archive)) { ?>

<ol class="unstyled">
<?php foreach ($archive as $year => $month) { ?>
	<li class="year"><h2><?php echo $year; ?></h2>
	<ol class="unstyled inline">
	<?php foreach ($month as $key => $value) { ?>
	<?php $monthtime = mktime(0,0,0,$key+1,1,$year); ?>
	<li class="month">
		<span title="<?php echo date('F', mktime(0,0,0,$key+1,1,$year)); ?>"><?php echo date('M', $monthtime); ?></span> 
		<?php echo ($value > 0) ? anchor('topics/archive/'.$tag.'/'.$year.'-'.($key+1), $value) : '<span class="no_posts">0</span>'; ?>
	</li>
	<?php } ?>
	</ol>
	</li>
<?php } ?>
</ol>

<?php } else { ?>
<p>No posts made yet.</p>
<?php } ?>

</div>

<?php $this->load->view('common/footer'); ?>
