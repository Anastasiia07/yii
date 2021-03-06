<?php use yii\helpers\Url;
use app\models\SearchForm;
?>
<div class="col-md-4" >

        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
            <?php foreach($recent as $article):?>
                <div class="thumb-latest-posts">
                    <div class="media">
                            <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="popular-img">
                                <img class="img-sideBar" src="<?= $article->getImage();?>" alt="">
                                <div class="p-overlay"></div>
                            </a>

                        <div class="p-content">
                            <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="text-uppercase"><?= $article->title?></a>
                            <span class="p-date"><?= $article->getDate();?></span>
                        </div>
                </div>
            <?php endforeach;?>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
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

</div>