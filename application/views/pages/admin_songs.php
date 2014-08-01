<div>
  <h1>Songs</h1>
  <?php echo anchor('song/edit', 'Add', 'class="btn btn-success"'); ?>
  <table class="table table-striped" id="list">
    <thead>
      <tr>
        <th>Songs</th>
  		</tr>
  	</thead>
  	<tbody>
  		<?php foreach ($rows as $r): ?>
  		<tr>
  			<td><?php echo $r['actual_name'] ?></td>
  		</tr>
  		<?php endforeach ?>
  	</tbody>
  </table>
</div>