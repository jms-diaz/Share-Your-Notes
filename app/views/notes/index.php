<?php require APPROOT . '/views/includes/header.php'; ?>
<?php flash('note_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Notes</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/notes/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i>
            Add Notes
        </a>
    </div>
</div>

<?php foreach ($data['notes'] as $note) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title">
            <?php echo $note->title ?>
        </h4>
        <div class="bg-light p-2 mb-3">
            Added by <?php echo $note->name; ?> on <?php $date = date_create($note->created_at);
                                                    echo date_format($date, "F d, Y") . ' at '  . date_format($date, "g:i"); ?>
        </div>
        <p class="card-text"><?php echo $note->body; ?></p>
        <a href="<?php echo URLROOT; ?>/notes/show/<?php echo $note->noteId; ?>" class="btn btn-dark">More</a>
    </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>