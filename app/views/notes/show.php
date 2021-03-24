<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/notes" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

<br>
<h3><?php echo $data['note']->title; ?></h3>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->name; ?> in <?php $date = date_create($data['note']->created_at);
                                                        echo date_format($date, "F d, Y") . ' at '  . date_format($date, "g:i"); ?>
</div>

<p><?php echo $data['note']->body; ?></p>

<?php if ($data['note']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?php echo URLROOT; ?>/notes/edit/<?php echo $data['note']->id; ?>" class="btn btn-dark">Edit</a>

    <form class="pull-right" action="<?php echo URLROOT; ?>/notes/delete/<?php echo $data['note']->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php endif ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>