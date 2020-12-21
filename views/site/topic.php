<?php

use yii\helpers\Url;

use yii\widgets\LinkPager;

?>

    <div>

        <?php foreach ($articles as $article): ?>

            <article class="post post-list">

                <div class="row">

                    <div class="col-md-6">

                        <div class="post-thumb">

                            <a href="<?= Url::toRoute(['/view', 'id'=>$article->id]) ?>">
                                <img class="img-topic" src="<?= $article->getImage() ?>" alt="" class="pull-left"></a>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="post-content">

                            <header class="entry-header text-uppercase">

                                <h6><a><?= $article->topic->name; ?></a></h6>

                                <h1 class="entry-title"><a href="<?= Url::toRoute(['/view', 'id'=>$article->id]) ?>">
                                        <?= $article->title; ?></a></h1>

                            </header>

                            <div class="entry-content">

                                <p><?= substr($article->description,0, 360) . '...'; ?>

                                </p>

                            </div>

                            <div class="social-share">

                            <span class="social-share-title pull-left text-capitalize">By <?= $article->user->name; ?> On
<?= $article->getDate(); ?></span>

                            </div>

                        </div>

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
    <aside class="widget border pos-padding">
        <h3 class="widget-title text-uppercase text-center">Topics</h3>
        <ul>
            <?php foreach ($topics as $topic):?>
                <li>
                    <a href="<?= Url::toRoute(['site/topic','id'=>$topic->id]);?>"><?= $topic->name?></a>
                    <span class="post-count pull-right">  (<?= $topic->getArticles()->count(); ?>)</span>
                </li>
            <?php endforeach;?>

        </ul>
    </aside>
</div>