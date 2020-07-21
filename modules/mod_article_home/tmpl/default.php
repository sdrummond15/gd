<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_article_single
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$sufixo = '';
if ($params->get('moduleclass_sfx')) {
    $sufixo = '-' . $params->get('moduleclass_sfx');
}
?>
<div id="article-home" class="article-home<?php echo $sufixo; ?>">
    <div class="bagage">
        <img src="images/gd_turismo_bagagens.png"/>
    </div>
    <div class="linha-horiz"></div>
    <div class="ship">
        <img src="images/cruzeiro_gd_turismo.png"/>
    </div>
    <?php foreach ($article as $article): ?>
        <div class="article-home">
            <div class="box-destination">
                <div class="all-destination">
                    <div class="destination top">
                        <div class="img-destination" style="background-image: url(<?= $image1 ?>)"></div>
                        <div class="effect-destination">
                            <div class="effect" style="background-image: url(<?= $image1 ?>)"></div>
                            <div class="effect-overlay"></div>
                        </div>
                    </div>
                    <div class="destination top">
                        <div class="img-destination" style="background-image: url(<?= $image2 ?>)"></div>
                        <span class="detail-risk">
                                <img src="images/detail_risk.png">
                            </span>
                    </div>
                    <span class="airplane">
                            <img src="images/airplane.png" alt="viaje com a GD Turismo">
                        </span>
                    <div class="destination bottom">
                        <div class="img-destination" style="background-image: url(<?= $image3 ?>)"></div>
                        <div class="effect-destination">
                            <div class="effect" style="background-image: url(<?= $image3 ?>)"></div>
                            <div class="effect-overlay"></div>
                        </div>
                    </div>
                    <div class="destination bottom">
                        <div class="img-destination" style="background-image: url(<?= $image4 ?>)"></div>
                    </div>
                </div>
            </div>
            <div class="description">
                <div class="linha"></div>
                <div class="text-description">
                    <div class="the-text">
                    <?= $article->introtext ?>
                    </div>
                    <a class="btn btn-destiny" href="<?php echo JRoute::_("index.php?Itemid={$link}"); ?>">
                        <?= $button_link ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script>
    jQuery('document').ready(function ($) {
        $(window).on('resize', function () {
            $('#article-home .destination').height(parseInt($('#article-home .destination').width() * 0.6));
            $('#article-home .description').height($('#article-home .all-destination').height());
        }).trigger('resize');
    });
</script>