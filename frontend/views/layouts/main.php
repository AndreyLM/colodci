<?php

/* @var $this \yii\web\View */
/* @var $content string */


use domain\helpers\CategoryHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;


AppAsset::register($this);

dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <header>

        <div class="container-fluid">

            <div class="row" id="top-header">

<!--                SITE LOGO               -->
                <div class="col-md-2 logo">
                    <a href="#">
                            <img src="<?= Yii::getAlias("@web/images/logo-page.png") ?>"
                                 title="Интернет-магазин для кондитеров — Max Uni" alt="Интернет-магазин для кондитеров — Lavar" />
                    </a>
                </div>

<!--                SEARCH / MENU-->
                <div class="col-md-8">
                    <div class="row">

                        <div class="col-md-4">
                            <?php foreach ($this->params['social'] as $socialContact): ?>
                                <a href="<?= $socialContact['url']?>" class="top-icons" target="_blank">
                                    <?= $socialContact['text'] ?>
                                </a>
                            <?php endforeach; ?>



                        </div>

                        <div class="col-md-4" id="search">

                                    <i class="fa fa-search fa-lg"></i>
                                    <input type="text" name="filter_name" value="Поиск" onclick="this.value = '';" onkeydown="this.style.color = '#000000';">

                        </div>

                        <div class="col-md-4">


                            <div class="dropdown">

                                <?php if (isset($this->params['phones'])):?>
                                    <a href="#" class="dropbtn">
                                        <?= $this->params['phones'][0]['text']?> <span class="icon-arrow-down"></span>
                                        <?php array_shift($this->params['phones']); ?>
                                    </a>
                                <?php endif; ?>

                                <div class="dropdown-content">

                                    <?php foreach ($this->params['phones'] as $key => $phones): ?>
                                        <a href="<?= $phones['url']?>">
                                            <?= $phones['text'] ?>
                                        </a>
                                    <?php endforeach; ?>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <nav class="navbar">
                                <div class="container-fluid">
                                    <ul class="nav navbar-nav main-menu">
                                        <?= \common\widgets\HeadMenu::widget([
                                                'items' => $this->params['headMenu']
                                        ])?>
                                    </ul>
                                </div>
                            </nav>

                        </div>
                    </div>
                </div>

<!--                CART-->
                <div class="col-md-2" id="cart">
                        <a class="modalAnchor" href="<?= \yii\helpers\Url::to(['cart/list'])?>"><span id="cart-total">Товаров: <?= \Yii::$app->cart->getCount().' <br>('.\Yii::$app->cart->getCost().' грн)' ?> </span></a>
                </div>
            </div>

            <div class="row" id="second-header">


                <div class="col-md-4">
                    <i class="fa fa-truck fa-3x"></i>
                    Бесплатная доставка<br>
                    <span>(при заказе от 1 000 грн)</span>
                </div>

                <div class="col-md-4">
                    <i class="fa fa-certificate fa-3x"></i>
                    Гарантия качества
                </div>

                <div class="col-md-4">
                    <i class="fa fa-home fa-3x"></i>
                    Гарантия качества
                </div>

            </div>

        </div>

    </header>





    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">

                <ul class="category-list">
                    <?= \common\widgets\SideMenu::widget([
                        'items' => $this->params['sideMenu']
                    ])?>
                </ul>

            </div>

            <div class="col-md-9">
                <?= $content ?>
            </div>

        </div>

    </div>

<a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>


<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4"><img src="<?= Yii::getAlias("@web/images/logo-page.png") ?>"
                                       title="Интернет-магазин для кондитеров — Lavar" alt="Интернет-магазин для кондитеров — Lavar" /></div>
            <div class="col-md-8"><p class="pull-left">CAKE-SHOP. Все права защищены &copy; <?= date('Y') ?></p></div>
        </div>



    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
