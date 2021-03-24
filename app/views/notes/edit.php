<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/notes" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Note</h2>
    <p>Edit your note</p>
    <form action="<?php echo URLROOT; ?>/notes/edit/<?php echo $data['id'] ?>" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea cols=30 rows=10 name="body" id="add-note" class="form-control <?php echo (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Update">
    </form>
</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>