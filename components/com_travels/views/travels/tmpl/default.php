<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');

$app = JFactory::getApplication();
$menuitem = $app->getMenu()->getActive(); // get the active item
$params = $menuitem->params; // get the params

$page = JUri::getInstance();
if (!empty(strpos(JUri::getInstance(), 'page'))) {
    $page = substr(JUri::getInstance(), 0, strpos(JUri::getInstance(), 'page') - 1);
}

if (empty($this->travels)) {
    $app = JFactory::getApplication();
    $app->redirect($page);
}

$thispage = JRequest::getVar('page');
if(empty($thispage)){
    $thispage = 1;
}

$count = 1;
$count1 = 1;
?>
<div class="title-travel">
    <?php if ($params->get('show_page_heading') == 1): ?>
        <h1><?= $params->get('page_heading') ?></h1>
    <?php endif; ?>
</div>
<?php foreach ($this->travels as $travels):
    if (!empty($travels->period) && $travels->period == 1) {
        $period = ' - ' . $travels->period . ' Noite';
    } elseif ($travels->period > 1) {
        $period = ' - ' . $travels->period . ' Noites';
    } else {
        $period = '';
    }

    if ($travels->people == 1) {
        $people = $travels->people . ' Adulto';
    } else {
        $people = $travels->people . ' Adultos';
    }

    if ($travels->childrens == 1) {
        $childrens = $travels->childrens . ' Criança';
    } else {
        $childrens = $travels->childrens . ' Crianças';
    }

    $date_out = explode('-', $travels->date_out);
    $date_out = $date_out[2] . '/' . $date_out[1] . '/' . $date_out[0];

    if (!empty($travels->date_in)) {
        $date_in = explode('-', $travels->date_in);
        $date_in = $date_in[2] . '/' . $date_in[1] . '/' . $date_in[0];
    }

    if ($travels->conditions == 1) {
        $conditions = 'À vista';
    } else {
        $conditions = '/Em até ' . $travels->conditions . 'X';
    }

    $preco = number_format($travels->price, 2, ',', '.');
    $preco = substr($preco, 0, -3);

    ?>
    <?php if ($count == 1): ?>
    <div id="first-travel">
        <div class="images-package">
            <div id="slider" class="flexslider">
                <ul class="slides">
                    <?php
                    $files = JFolder::files('images/pacotes/' . $travels->photos, '.');
                    foreach ($files as $file):
                        ?>
                        <li>
                            <img src="<?= 'images/pacotes/' . $travels->photos . '/' . $file ?>"/>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="box-package">
            <div class="desc-travel">
                <div class="details-travel">
                    <div class="destiny-detail">
                        <h2>
                            <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>">
                                <?= $travels->name ?>
                            </a>
                        </h2>
                    </div>
                    <div class="price-detail">
                        <h4>
                            <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>">
                                <span>R$ </span><?= $preco ?>
                                <small><?= $conditions ?></small>
                            </a>
                        </h4>
                    </div>

                    <div class="time-detail">
                        <div class="in-out-detail">
                            <div class="in-out-box">
                                <div class="in-detail">
                                    <h3>
                                <span>
                                    <i class="fas fa-plane"></i>
                                </span>
                                        <?= $date_out ?>
                                    </h3>
                                </div>
                                <?php if (!empty($travels->date_in)): ?>
                                    <div class="out-detail">
                                        <h3>
                                    <span>
                                        <i class="fas fa-plane"></i>
                                    </span>
                                            <?= $date_in ?>
                                        </h3>
                                    </div>
                                <?php endif; ?>
                                <p>
                                    <?= (!empty($travels->accommodations)) ? $travels->accommodations . ' + ' : '' ?>
                                    <?= $people ?>
                                    <?= ($travels->children == 1) ? ' + ' . $childrens : '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="desc-detail">
                        <h1>
                            <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>">
                                <?= ((!empty(trim($travels->hotel))) ? $travels->hotel . ' / ' : '') .
                                trim($travels->destiny) . $period
                                ?>
                            </a>
                        </h1>
                        <?php if (!empty($travels->included_in_package)): ?>
                            <div class="advantage-detail">
                                <p><?= $travels->included_in_package ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($travels->descriptions)): ?>
                            <div><?= $travels->descriptions ?></div>
                        <?php endif; ?>
                    </div>

                    <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>" class="btn btn-more">
                        Saiba mais!
                    </a>

                </div>
            </div>
        </div>
        <div class="thumb-package">
            <div id="carousel" class="flexslider">
                <ul class="slides">
                    <?php
                    foreach ($files as $filethumb):
                        ?>
                        <li>
                            <img src="<?= 'images/pacotes/' . $travels->photos . '/' . $filethumb ?>"/>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
    <?php
    $count++;
endforeach; ?>
<div id="travels">
    <?php foreach ($this->travels as $travels):
        if (!empty($travels->period) && $travels->period == 1) {
            $period = ' - ' . $travels->period . ' Noite';
        } elseif ($travels->period > 1) {
            $period = ' - ' . $travels->period . ' Noites';
        } else {
            $period = '';
        }

        if ($travels->people == 1) {
            $people = $travels->people . ' Adulto';
        } else {
            $people = $travels->people . ' Adultos';
        }

        if ($travels->childrens == 1) {
            $childrens = $travels->childrens . ' Criança';
        } else {
            $childrens = $travels->childrens . ' Crianças';
        }

        $date_out = explode('-', $travels->date_out);
        $date_out = $date_out[2] . '/' . $date_out[1] . '/' . $date_out[0];

        if (!empty($travels->date_in)) {
            $date_in = explode('-', $travels->date_in);
            $date_in = $date_in[2] . '/' . $date_in[1] . '/' . $date_in[0];
        }

        if ($travels->conditions == 1) {
            $conditions = 'À vista';
        } else {
            $conditions = '/Em até ' . $travels->conditions . 'X';
        }

        $preco = number_format($travels->price, 2, ',', '.');
        $preco = substr($preco, 0, -3);

        ?>
        <?php if ($count1 > 1): ?>
        <div class="travel">
            <div class="img-travel">
                <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>">
                    <span style="background-image: url(<?= $travels->photo_featured ?>)"></span>
                </a>
            </div>
            <div class="desc-travel">
                <div class="details-travel">
                    <div class="desc-detail">
                        <h1>
                            <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>">
                            <?= ((!empty(trim($travels->hotel))) ? $travels->hotel . ' / ' : '') .
                            trim($travels->destiny) . $period
                            ?>
                            </a>
                        </h1>
                        <?php if (!empty($travels->descriptions)): ?>
                            <div><?= $travels->descriptions ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="destiny-detail">
                        <h2>
                            <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>">
                                <?= $travels->name ?>
                            </a>
                        </h2>
                    </div>
                    <div class="time-detail">
                        <div class="in-out-detail">
                            <div class="in-out-box">
                                <div class="in-detail">
                                    <h3>
                                <span>
                                    <i class="fas fa-plane"></i>
                                </span>
                                        <?= $date_out ?>
                                    </h3>
                                </div>
                                <?php if (!empty($travels->date_in)): ?>
                                    <div class="out-detail">
                                        <h3>
                                    <span>
                                        <i class="fas fa-plane"></i>
                                    </span>
                                            <?= $date_in ?>
                                        </h3>
                                    </div>
                                <?php endif; ?>
                                <p>
                                    <?= (!empty($travels->accommodations)) ? $travels->accommodations . ' + ' : '' ?>
                                    <?= $people ?>
                                    <?= ($travels->children == 1) ? ' + ' . $childrens : '' ?>
                                </p>
                            </div>
                        </div>
                        <?php if (!empty($travels->included_in_package)): ?>
                            <div class="advantage-detail">
                                <p><?= $travels->included_in_package ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="price-detail">
                    <h4>
                        <a href="<?= TravelsModelTravels::getTravelUrl($travels->catid, $travels->id) ?>">
                            <span>R$ </span><?= $preco ?>
                            <small><?= $conditions ?></small>
                        </a>
                    </h4>
                    <p>Por pessoa</p>
                    <a href="<?= $travels->external_link ?>" class="btn btn-reserve">
                        Reservar
                    </a>
                    <?php if ($travels->rates == 1): ?>
                        <small>
                            Taxas a incluir
                        </small>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <?php
        $count1++;
    endforeach; ?>
    <?php if ($this->pagination > 1) : ?>
        <div class="pagination">
            <ul>
                <li class="start">
                    <?php if ($thispage == 1 || empty($thispage)) : ?>
                        <span> < </span>
                    <?php else: ?>
                        <a href="<?= $page . '?page=' . ($thispage - 1) ?>"> < </a>
                    <?php endif; ?>
                </li>
                <li>
                    <?= (empty($thispage) ? 1 : $thispage) . '<small> de </small>' . $this->pagination ?>
                </li>
                <li class="end">
                    <?php if ($thispage == $this->pagination) : ?>
                        <span> > </span>
                    <?php else: ?>
                        <a href="<?= $page . '?page=' . ($thispage + 1) ?>"> > </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</div>
<script src="components/com_travels/js/jquery.flexslider.js"></script>
<script src="components/com_travels/js/script_all.js"></script>