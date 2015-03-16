<?php
$qualis=unserialize($qualificacao['TITULO']) ;
//print_r($qualis);
$votantes =  array_sum($qualis);
$quantTotal=0;
if($votantes==0){
    echo "Nenhuma qualificação até o momento";
}else{
for ($index = count($qualis); $index >0; $index--) {
    $quantTotal+=$index*$qualis[$index];
    $percent = $qualis[$index]*100/$votantes;
//echo $qualis[$index]."<br>";
    ?>
<div class="col-md-2"><?= $index ?> estrela</div>
    <div class="progress">
        <div class="progress-bar  progress-bar-striped" role="progressbar" aria-valuenow="<?=$percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percent; ?>%;">
            
               <?php echo  round($percent)>=25? round($percent). "% - ". $qualis[$index] . " votos":round($percent)."%"; ?> 
           
        </div>
        <?= round($percent) < 25? $qualis[$index]." - voto(s)":"" ?>
</div>
<?php }
}
?>
<h3><span class="label label-primary">Total de votos <strong><?= $votantes?></strong></span></h3>
<div class="alert alert-info">
Entenda por que voce obteve <strong><?php echo round($quantTotal*100/($votantes*5), 1)?>%</strong> mostrado na barra lateral.<br>
Você obteve <?=$votantes?> votos, podendo alcançar uma pontuação máxima de <strong><?= $votantes*5 ?> estrelas</strong><br>
porém sua pontuação foi de <strong><?= $quantTotal?></strong>, significa que <?= $quantTotal?> é <strong><?php echo round($quantTotal*100/($votantes*5), 1)?>%</strong> de<?= $votantes*5 ?> 
</div>





