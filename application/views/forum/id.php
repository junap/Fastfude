<?php $this->load->view('common/header'); ?>

<div class="controls">
	<?php echo anchor('topic/create', "Create a topic", ' class="button icon-plus"'); ?>
</div>

<?php if (count($topics) > 0) { ?>

<ol class="topics">
<?php foreach ($topics as $topic) { ?>
	<li>
		<p class="topic_title"><?php echo anchor('topic/id/'.$topic->id, html_escape($topic->title)); ?></p>
		<p class="meta">
			<?php echo ($topic->replies == 1) ? '1 reply' : $topic->replies.' replies'; ?> |
			last post by <?php echo anchor('user/id/'.$topic->user_id_last, html_escape($topic->username_last)); ?>, 
			<?php echo timespan($topic->post_time_last); ?> ago
		</p>
	</li>
<?php } ?>
</ol>

<?php } ?>

<?php $this->load->view('common/footer'); ?>
