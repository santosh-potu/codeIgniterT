<div class="magazine">
    <div class="name_issue">
        <?php echo html_escape($publication->publication_name); ?>
        #<?php echo html_escape($issue->issue_number); ?>
    </div>
    <div class="date">
        <?php echo html_escape($issue->issue_date_publication); ?>
    </div>
<?php if($issue->issue_cover) { ?>
    <div class="">
        <?php echo img('/uploads/'.$issue->issue_cover);?>
    </div>
<?php } ?>    
</div>