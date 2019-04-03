
<a href='order' style='margin:10px'>Go to orders</a>
<a href='basket' style='margin:10px'>Go to basket</a>
<a href='user' style='margin:10px'>Go to account</a>

   <?php foreach ($params as $key => $value):?>
    <a href="./product/card/?id=<?=$value->id?>">
        <div class="catalog-preview" style="border: 1px #000 solid; margin: 5px; padding:5px; width: 150px">
            <div><?=$value->name?></div>
            <div><?=$value->price?></div>
        </div>
    </a>
<?php endforeach;?>