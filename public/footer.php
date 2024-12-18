<?php 
require_once './functions/func.php';
$res = getFooter();

?>
</div>
 <?php if (!empty($res)): ?>
  <div style="height:150px;background-color:black">
    <h1 style="text-align:center;padding-top:20px;color:white;font-size:20px"><?php echo $res['address'] ?></h1>
    <h1 style="text-align:center;padding-top:20px;color:white;font-size:20px"><?php echo $res['phone'] ?></h1>
    <h1 style="text-align:center;padding-top:20px;color:white;font-size:20px"><?php echo $res['email'] ?></h1>
  </div>
   <?php else: ?>
    <h1>Пусто</h1>
  <?php endif?>

  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>

</body>

</html>