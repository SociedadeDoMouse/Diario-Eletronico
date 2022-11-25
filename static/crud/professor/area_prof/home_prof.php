<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>

        <h1 class="btnPag row" > <span id="btnC" class="col-md-7" onclick="btnCL('cards')"> Cards </span>  <span id="btnLis" class="col-md-5" onclick="btnCL('lista')"> Lista </span> </h1>

        <hr>

        <div class="row" id="cards">

            <?php include "card_turmas_prof.php"; ?>

        </div>

        <div class="row" id="lista" style="display:none">

            <?php include "lista_turmas_prof.php"; ?>

        </div>

  </body>
</html>


<script>
function btnCL(tipo){
    var cards   = document.getElementById('cards')
    var btnC    = document.getElementById('btnC')
    var btnLis  = document.getElementById('btnLis')

    if(tipo == 'cards' && cards.style.display != 'flex' ){
        cards.style.display = "flex";
        lista.style.display = "none";
        btnC.style.height = "50px";
        btnLis.style.height = "38px";
    }else if(tipo == 'lista' && lista.style.display != 'flex' ){
        cards.style.display = "none";
        lista.style.display = "flex";
        btnLis.style.height = "50px";
        btnC.style.height = "38px";
    }
}
</script>