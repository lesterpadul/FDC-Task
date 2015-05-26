<h1>Blogs</h1>

<table>
	<thead>
		<tr>
			<td>ID</td>
			<td>Title</td>
			<td>Action</td>
			<td>Created</td>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($posts as $post):
		?>
		<tr>
			<td><?php echo $post['Post']['id']; ?></td>
			<td>
				<?php echo $this->Html->link($post['Post']['title'],array('controller'=>'posts','action'=>'view',$post['Post']['id'])); ?>
			</td>
			<td>
				<?php 
					echo $this->Html->link('Edit',array('controller'=>'posts','action'=>'edit',$post['Post']['id']));
					echo $this->html->link('Remove',array('controller'=>'posts','action'=>'remove', $post['Post']['id']));
				?>
			</td>
			<td>
				<?php echo date("Y-m-d h:i:s",strtotime($post['Post']['created'])); ?>
			</td>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>
</table>