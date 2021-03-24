<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/ofzy44rnbpn9xf8b4phiai5snj4kci7973tm6362tkjdv9yi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="<?php echo URLROOT . '/css/style.css' ?>">
    <script>
        tinymce.init({
            selector: '#add-note',
            plugins: "save",
            menubar: false,
            toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify'
        });
    </script>
    <title><?php echo SITENAME; ?></title>
</head>

<body>
    <?php require APPROOT  . '/views/includes/navbar.php'; ?>
    <div class="container">