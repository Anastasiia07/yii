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


<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-md-8">
                <?php foreach($articles as $article):?>
                <article class="post">

                    <div class="post-thumb">

                        <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><img src="<?= $article->getImage();?>" alt=""></a>

                    </div>

                    <div class="post-content">

                        <header class="entry-header text-center text-uppercase">

                            <h6><a href=""> <?= Url::toRoute(['/topic', 'id' => $article->topic->id]) ?> <?= $article->topic->name; ?></a></h6>

                            <h1 class="entry-title"><a href=""> <?= $article->title; ?> </a></h1>

                        </header>

                        <div class="entry-content">

                            <p> <?= mb_strimwidth($article->description,0, 360, "..."); ?> </p>

                            <div class="btn-continue-reading text-center text-uppercase">

                                <a href="<?= Url::toRoute(['/view', 'id'=>$article->id]) ?>" class="more-link">Continue Reading</a>

                            </div>

                        </div>

                        <div class="social-share">

                            <span class="social-share-title pull-left text-capitalize">By <?= $article->user->name;?> On <?= $article->getDate();?></span>

                            <ul class="text-center pull-right">

                                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li>

                                <?= (int)$article->viewed; ?>

                            </ul>

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
</div>
<?php echo \Yii::$app->view->renderFile('@app/views/site/right.php', compact('popular','recent','topics'));?>
