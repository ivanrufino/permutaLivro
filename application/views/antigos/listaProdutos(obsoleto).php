
<?php 
echo "<ol class='breadcrumb' id='marc'> $titulo</ol>";
foreach ($produtos as $pd) {?>
    <div class="col-lg-4 col-xs-6 hero-feature">
        <div class="thumbnail" style="height: 300px !important">
            <img src="<?= base_url("assets/imagens/exemplo.jpg")?>" alt="">
            <div class="caption">
                <h6><?=character_limiter($pd['nome'], 50); ?></h6>
                <p><?=$pd['descricao']?>asdasd</p>
                <p><a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a></p>
            </div>
        </div>
    </div>
<?php }
for ($x = 0; $x < 0; $x++) { ?>
    <div class="col-lg-4 col-xs-6 hero-feature">
        <div class="thumbnail">
            <img src="<?= base_url("assets/imagens/exemplo.jpg")?>" alt="">
            <div class="caption">
                <h4>Feature Label</h4>
                <p>This would be a great spot to feature some brand new products!</p>
                <p><a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a></p>
            </div>
        </div>
    </div>
<?php
}

