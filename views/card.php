<div style="border: 1px #000 solid; margin: 5px; padding:5px; width: 250px">
    <h1><?=$product->name?></h1>
    <p><?=$product->price?></p>
    <input class="number" type="number" name="number" min="1" value="1">
    <button data-id="<?=$product->id?>" class="buy">Buy</button>
</div>


<script>
    $(function(){
        $('button.buy').on('click', function() {
            let $id = $(this).data('id');
            let $number = parseInt($(this).parent().find('input.number').val());
            $.ajax({
                url: "../../basket/addToBasket",
                type: "POST",
                data: {
                    id: $id,
                    number: $number
                },
//                success: function(response){
//                    response = JSON.parse(response);
//                    if(response.success == "ok"){
//                        alert(response.message);
//                    }
//                }
            })
        });
    });
</script>
