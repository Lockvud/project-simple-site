<?php 
require_once './functions/func.php';

$res = getServices();

?>

<div class="site-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center">

          <h3 style="color: black">Наши услуги</h3>
        </div>
      </div>
      <div class="row">
        <?php foreach ($res as $value):?>
        <div class="col-lg-3 col-md-6 mb-lg-0">
          <div class="person">
            <figure>
              <img src="admin/img/<?php echo $value['filename']?>" alt="Image" class="img-fluid">

            </figure>
            <div class="person-contents">
              <h3><?php echo $value['title']?></h3>
              <span style="color: red;font-weight: bold"><?php echo $value['price']?></span>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>