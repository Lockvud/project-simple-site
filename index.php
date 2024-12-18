<?php 
require_once 'public/contact.php';
require_once './functions/func.php';

$res = getHeader();

?>


<div class="intro-section" style="background-image: url('admin/img/<?php echo $res['filename']?>');">
  <div class="container">
    <div class="row align-items-center">
      <?php if (!empty($res)):?>
      <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
      <h1><?php echo $res['name'] ?></h1>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require_once 'public/services.php'; ?>
<?php require_once 'public/about.php'; ?>
<?php require_once 'public/footer.php'; ?>