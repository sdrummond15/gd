<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->travel as $travel):

    if (!empty($travel->period) && $travel->period == 1) {
        $period = ' - ' . $travel->period . ' Noite';
    } elseif ($travel->period > 1) {
        $period = ' - ' . $travel->period . ' Noites';
    } else {
        $period = '';
    }

    if ($travel->people == 1) {
        $people = $travel->people . ' Adulto';
    } else {
        $people = $travel->people . ' Adultos';
    }

    if ($travel->childrens == 1) {
        $childrens = $travel->childrens . ' Criança';
    } else {
        $childrens = $travel->childrens . ' Crianças';
    }

    $date_out = explode('-', $travel->date_out);
    $date_out = $date_out[2] . '/' . $date_out[1] . '/' . $date_out[0];

    if (!empty($travel->date_in)) {
        $date_in = explode('-', $travel->date_in);
        $date_in = $date_in[2] . '/' . $date_in[1] . '/' . $date_in[0];
    }

    if ($travel->conditions == 1) {
        $conditions = 'À vista';
    } else {
        $conditions = '/Em até ' . $travel->conditions . 'X';
    }

    $preco = number_format($travel->price, 2, ',', '.');

    ?>

    <div id="travel">
        <div class="images-travel">
            <ul id="lightgallery" class="list-unstyled row">
                <?php
                $files = JFolder::files('images/pacotes/' . $travel->photos, '.');
                foreach ($files as $file):
                    ?>
                    <li data-src="<?= '../images/pacotes/' . $travel->photos . '/' . $file ?>">
                        <a href="">
                            <span class="img-responsive"
                                  style="background-image: url(<?= 'images/pacotes/' . $travel->photos . '/' . $file ?>)"/>
                            <img src="<?= 'images/pacotes/' . $travel->photos . '/' . $file ?>">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="desc-travel">
            <div class="details-travel">
                <div class="all-details">
                    <div class="destiny-detail">
                        <h2>
                            <?= $travel->name ?>
                        </h2>
                    </div>
                    <div class="price-detail">
                        <h4>
                            <span>R$ </span><?= $preco ?>
                            <small><?= $conditions ?></small>
                        </h4>
                        <p>Por pessoa</p>
                    </div>
                </div>

                <div class="time-detail">
                    <div class="in-out-detail">
                        <div class="in-out-box">
                            <h3>
                                <span class="in-detail">
                                    <i class="fas fa-plane"></i>
                                </span>
                                <?= $date_out ?>
                                <?php if (!empty($travel->date_in)): ?>
                                    <span class="out-detail">
                                        <i class="fas fa-plane"></i>
                                    </span>
                                    <?= $date_in ?>
                                <?php endif; ?>
                            </h3>

                            <p>
                                <?= (!empty($travel->accommodations)) ? $travel->accommodations . ' + ' : '' ?>
                                <?= $people ?>
                                <?= ($travel->children == 1) ? ' + ' . $childrens : '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="desc-detail">
                    <h1>
                        <?= ((!empty(trim($travel->hotel))) ? $travel->hotel . ' / ' : '') .
                        trim($travel->destiny) . $period
                        ?>
                        <span></span>
                    </h1>
                    <?php if (!empty($travel->included_in_package)): ?>
                        <div class="advantage-detail">
                            <p><?= $travel->included_in_package ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($travel->descriptions)): ?>
                        <div><?= $travel->descriptions ?></div>
                    <?php endif; ?>
                </div>
                <a href="<?= $travel->external_link ?>" class="btn btn-reserve">
                    Reservar
                </a>
                <?php if ($travel->rates == 1): ?>
                    <small>
                        Taxas a incluir
                    </small>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="components/com_travels/js/lightgallery-all.js"></script>
<script src="components/com_travels/js/script_one.js"></script>