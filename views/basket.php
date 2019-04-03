<?php if(empty($params)):?>
    <div>Корзина пуста!</div>
    <a href='order' style='margin:10px'>Go to orders</a>
<?php else:?>

<?php foreach ($params as $key => $value) :?>
<div style="border: 1px #000 solid; margin: 5px; padding: 5px; width: 250px">
    <p>Name: <?=$value['name']?></p>
    <p>Price: <?=$value['price']?></p>
    <p>Number: <?=$_SESSION['basket'][$value['id']]?></p>
    <p>Amount: <?=$value['price'] * $_SESSION['basket'][$value['id']]?></p>
    <button data-id="<?=$value['id']?>" class="delete">Delete</button>
</div>
<?php endforeach;?>
<input id="address" type="text" name="address" required placeholder="Address"/>
<button class="order">Order</button>
<?php endif;?>


<script>
    $(function(){
    $('button.delete').on('click', function(){
        let $id = $(this).data('id');
        $.ajax({
            url: "../../basket/deleteFromBasket",
            type: "POST",
            data: {
                id: $id,
            },
            success: function(response){
                   response = JSON.parse(response);
                   if(response.success == "ok"){
                       alert(response.message);
                   }
            }
        });
        window.location.reload();
    });
});
    
 $(function(){
        $('button.order').on('click', function(){
           $address = $('#address').val();
            if($address == '') {
                alert('Fill in an address!')
            } else {
                $.ajax({
                    url: "../../order/createOrder",
                    type: "POST",
                    data: {
                        address: $address,
                    },
//                    success: function(response){
//                   response = JSON.parse(response);
//                   if(response.success == "ok"){
//                       alert(response.message);
//                   }
//                }
            });
//                 window.location.reload();
            }
        });
    });

</script>