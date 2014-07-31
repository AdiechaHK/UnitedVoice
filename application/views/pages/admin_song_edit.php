<div>
  <h1>Songs</h1>
<?php
echo form_open_multipart('song/do_upload', 'class="form-horizontal"');
?>
<fieldset>
  <label>Upload File</label>
  <input type="file" name="userfile" />
  <button type="submit" class="btn btn-success">Save</button>
</fieldset>
</form>
</div>