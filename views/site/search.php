<?php

use yii\helpers\Url;

use yii\widgets\LinkPager;

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

        <div style="text-align: center" >

            <h2>Search by tag (<?= $search ?>)</h2>

        </div>

        <?php foreach ($articles as $article): ?>



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

                            <a href="<?= Url::toRoute(['/view', 'id'=>$article->id]) ?>" class="more-link">Continue Reading</a><p></p>

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
