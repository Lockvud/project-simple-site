<?php
require_once './functions/func.php';

$res = getAbout();
?>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="admin/img/<?php echo $res['filename'] ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3 style="color: black"><?php echo $res['title'] ?></h3>
                <p><?php echo $res['description'] ?></p>
            </div>
        </div>
    </div>
</div>