<div id="modtravel_packages">
    <div class="travel_packages">
        <div class="slider-wrap">
            <div class="slider">
                <ul>
                    <?php
                    $count = 1;
                    foreach ($travel_packages as $feature):
                        $image = $feature->photo_featured;
                        if ($count > 4) {
                            $count = 1;
                        }

                        if($feature->conditions == 1){
                            $conditions = 'À vista';
                        }else{
                            $conditions = '/Em até ' . $feature->conditions . 'X';
                        }

                        $preco = number_format($feature->price, 2, ',', '.');
                        $preco = substr($preco, 0, -3);

                        ?>
                        <li>
                            <div>
                                <div class="travel_feature square<?= $count ?>">
                                    <a href="<?= modTravel_PackagesHelper::getTravelItem($feature->catid, $feature->id) ?>"
                                       class="travel_img">
                                        <span style="background-image: url(<?= $image ?>)"></span>
                                    </a>
                                    <div class="travel_desc">
                                        <h3>
                                            <a href="<?= modTravel_PackagesHelper::getTravelItem($feature->catid, $feature->id) ?>">
                                                <?= $feature->name ?>
                                            </a>
                                        </h3>
                                        <h4>
                                            <a href="<?= modTravel_PackagesHelper::getTravelItem($feature->catid, $feature->id) ?>">
                                                <span>R$ </span><?= $preco ?>
                                                <small><?= $conditions ?></small>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                        $count++;
                    endforeach;
                    ?>
                </ul>
            </div>
            <a href="#" class="slider-arrow sa-left">
                <
            </a>
            <a href="#" class="slider-arrow sa-right">
                >
            </a>
        </div>
    </div>
</div>

<script src="./modules/mod_travel_packages/assets/js/jquery.lbslider.js"></script>
<script>
    jQuery('.slider').lbSlider({
        leftBtn: '.sa-left',
        rightBtn: '.sa-right',
        visible: 4,
//        autoPlay: true,
        autoPlayDelay: 5
    });

    jQuery(function () {
        jQuery(window).on('resize', function () {
            var largura = jQuery(window).width();
            if (largura > 1000) {
                jQuery('.slider').mouseover(function () {
                    jQuery('.slider-arrow').css('opacity', '1');
                });
                jQuery('.slider').mouseout(function () {
                    jQuery('.slider-arrow').css('opacity', '0');
                });
                jQuery('.slider-arrow').mouseover(function () {
                    jQuery('.slider-arrow').css('opacity', '1');
                });
                jQuery('.slider-arrow').mouseout(function () {
                    jQuery('.slider-arrow').css('opacity', '0');
                });
            }
        }).trigger('resize');
    });

    jQuery(function () {
        jQuery(window).on('resize', function () {
            var largura = jQuery(window).width();
            if (largura > 1200) {
                jQuery('#modtravel_packages .slider').css('width', 1170);
            }
            if (largura <= 1200 && largura > 936) {
                jQuery('#modtravel_packages .slider').css('width', 936);
            }
            if (largura <= 936 && largura > 702) {
                jQuery('#modtravel_packages .slider').css('width', 702);
            }
            if (largura <= 702 && largura > 468) {
                jQuery('#modtravel_packages .slider').css('width', 468);
            }
            if (largura <= 468) {
                jQuery('#modtravel_packages .slider').css('width', 234);
            }
            var tamFoto = jQuery('#modtravel_packages .slider .travel_feature').width();
            jQuery('#modtravel_packages .slider .travel_feature .travel_img').height(tamFoto);
            jQuery("#modtravel_packages ul li > div").height(jQuery('#modtravel_packages .slider .travel_feature').height());
        }).trigger('resize');
    });


</script>