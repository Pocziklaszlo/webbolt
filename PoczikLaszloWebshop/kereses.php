<?php   require "header.php";   ?>

    <div id="top">
        <?php   require "menu.php";     ?>
    </div>

    <div id="left">
        <?php   require "kategoria.php";    ?>
    </div>
    
    <div id="right">
        <h1 class="mb-5">🧹 Keresés 🧹</h1>

        <form action="" method="post" class="mb-5">

            <input type="text" name="keres" id="keres" placeholder="Írd be a termék nevét...">
            
        </form>

        <div class="result">

        </div>
    </div>
    


    <script>

        $(function(){

            $("#keres").keyup(function(){

                var text = $("#keres").val();

                if(text != ""){

                    $.ajax({

                        url: "fetch.php",
                        type: "post",
                        dataType: "text",
                        data: {keres:text},
                        success: function(data){

                            $(".result").html(data);
                        }
                    });
                }
                else{

                    $(".result").html("");
                }
            });


        });


    </script>
</body>
</html>