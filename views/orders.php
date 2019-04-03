<?php foreach ($params as $key => $value):?>
  
        <div class="catalog-preview" style="border: 1px #000 solid; margin: 5px; padding:5px; width: 150px">
            <div>Order ID: <?=$value->order_id?></div>
            <div>Address: <?=$value->address?></div>
        </div>
 
<?php endforeach;?>