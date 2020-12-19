<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\Article;

use yii\data\Pagination;
?>
<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<aside class="border pos-padding widget-search">

    <?php $form = \yii\widgets\ActiveForm::begin([

        'method' => 'get',

        'action' => Url::to(['/search']),

        'options' => ['class' => 'search-form', 'role' => 'form']]) ?>

    <?php $searchForm = new \app\models\SearchForm() ?>

    <?= $form->field($searchForm, 'text')->textInput(['class' => 'form-control serch', 'placeholder' => 'Search'])->label(false) ?>

    <button class="btn-serch" type="submit"><i class="fa fa-search"></i></button>

    <?php \yii\widgets\ActiveForm::end() ?>

</aside>

<div class="site-index">

    <div class="body-content">

        <div class="row">

                <?php foreach($articles as $article):?>
                <article class="post">
                    <div class="post-content">

                        <header class="entry-header text-center text-uppercase">


                            <h1 class="entry-title"><a href=""> <?= $article->title; ?> </a></h1>

                        </header>
                        <div class="post-thumb">

                            <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><img src="<?= $article->getImage();?>" alt=""></a>

                        </div>
                        <div class="entry-content">


                        </div>

                        <div class="social-share">

                            <span class="social-share-title pull-left text-capitalize">By <?= $article->user->name;?> On <?= $article->getDate();?></span>

                            <ul class="text-center pull-right">

                                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li>

                                <?= (int)$article->viewed; ?>

                            </ul>

                        </div>
                        <div class="btn-continue-reading text-center text-uppercase">

                            <a href="<?= Url::toRoute(['/view', 'id'=>$article->id]) ?>" class="more-link">Continue Reading</a>

                        </div>

                    </div>

                </article>
                <?php endforeach; ?>
                <?php
                echo LinkPager::widget([
                    'pagination' => $pagination,
                ]);
                ?>

        </div>

    </div>
</div>
<div class="primary-sidebar">
    <aside class="widget">
        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
        <div class="row">
            <div class="popular-post">
                <?php  foreach($popular as $article):?>

                    <div class="column">
                        <div class="p-content">
                            <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="text-uppercase"><?= $article->title?></a>

                        </div>
                        <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="popular-img">
                            <img class="img-sideBar" src="<?= $article->getImage();?>" alt="">

                        </a>

                        <div class="p-content">
                            <span class="p-date"><?= $article->getDate();?></span>

                        </div>
                    </div>
                <?php endforeach;?>
            </div>

    </aside>

    <aside class="widget pos-padding">
        <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
        <div class="row">
        <?php foreach($recent as $article):?>
            <div class="column">
                <div class="p-content">
                    <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="text-uppercase"><?= $article->title?></a>

                </div>
                <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="popular-img">
                    <img class="img-sideBar" src="<?= $article->getImage();?>" alt="">

                </a>

                <div class="p-content">
                    <span class="p-date"><?= $article->getDate();?></span>

                </div>
            </div>
        <?php endforeach;?>
        </div>
    </aside>
</div>

