
<div id='uploader'>
<?php echo $error;?>

<?php echo form_open_multipart('admin/upload/do_upload/'.$id);?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</div>