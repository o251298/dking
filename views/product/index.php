<?php foreach ($productList as $item): ?>
<h3><?= $item['name'];?></h3> <br>
<i><?= $item['coast'];?></i> <br>
<p><?= $item['description'];?></p> <br>
<hr>
<?php endforeach; ?>