<?php echo validation_errors();  ?>
<?php echo $this->upload->display_errors('<div class="alert alert-error">','</div>'); ?>
<?php echo form_open_multipart(); ?>
<div>
    <?php echo form_label('Publication Name','publication_id'); ?>
    <?php echo form_dropdown('publication_id', $publication_form_options, set_value('publication_id')); ?>
</div>
<div>
    <?php echo form_label('Issue number','issue_number');?>
    <?php echo form_input('issue_number', set_value('issue_number')); ?>
</div>
<div>
    <?php echo form_label('Date published','issue_date_publication'); ?>
    <?php echo form_input('issue_date_publication',set_value('issue_date_publication'));?>
</div>
<div>
    <?php echo form_label('Cover Image','issue_cover'); ?>
    <?php echo form_upload('issue_cover'); ?>
</div>
<div>
    <?php echo form_submit('Submit', 'Save'); ?>
</div>
<?php echo form_close(); ?>
<!-- <form method="POST">
    <div>
        <label for=publication_id">Publication Name</label>
        <select id="publication_id" name="publication_id">
           <?php
           foreach($publication_form_options as $publication){
               echo "<option value='{$publication->publication_id}' ".  
             set_select('publication_id', $publication->publication_id, FALSE)
                       .">{$publication->publication_name}</option>";
           }
           ?>
        </select>
    </div>
     <div>
        <label for="issue_number">Issue Number</label>
        <input type="text" name="issue_number" value="<?php echo set_value('issue_number')?>">
    </div>
    <div>
        <label for="issue_date_publication">Date Published</label>
        <input type="text" name="issue_date_publication" value="<?php echo set_value('issue_date_publication')?>">
    </div>
    <div>
        <input type="submit" value="Save" />
    </div>
</form> -->

