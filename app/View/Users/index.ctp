<table>
	<thead>
		<tr>
			<th>
				Name
			</th>
			<th>
				Email
			</th>
			<th>
				Action
			</th>
			<th>
				Created
			</th>
		</tr>
	</thead>
	
	<tbody>
	<?php 
		if(count($users)!==0): 
			foreach($users as $user):
	?>
		<tr>
			<td><?php echo $this->Html->link($user['User']['name'],array('controller'=>'users','action'=>'view',$user['User']['id'])); ?></td>
			<td><?php echo $user['User']['email']; ?></td>
			<td>
				<?php 
					echo $this->Html->link('Edit',array('controller'=>'users','action'=>'edit',$user['User']['id']), array('class'=>'btn-primary'));
					echo "&nbsp;";
					echo $this->Html->link('Remove',array('controller'=>'users','action'=>'remove',$user['User']['id']), array('confirm'=>'Do you really want to remove this user?'));
				?>
			</td>
			<td>
				<?php
					echo date('F j,Y H:i:s',strtotime($user['User']['created']));
				?>
			</td>
		</tr>
	<?php
			endforeach;	
		else:
	?>
		<tr>
			<td colspan='4'>
				0 users
			</td>
		</tr>
	<?php
		endif; 
	?>
	</tbody>
	
</table>