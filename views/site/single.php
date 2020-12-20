<?php
use yii\helpers\Url;
?>
<article class="post">
    <div class="post-content">

        <header class="entry-header text-center text-uppercase">


            <h1 class="entry-title"><a href=""> <?= $article->title; ?> </a></h1>

        </header>
        <div class="post-thumb">

            <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]);?>"><img src="<?= $article->getImage();?>" alt=""></a>

        </div>
        <div class="entry-content">
            <p></p>
            <p> <?= mb_strimwidth($article->description,0, 360, "..."); ?> </p>


            <div class="social-share">

                <span class="social-share-title pull-left text-capitalize">By <?= $article->user->name; ?> On <?= $article->getDate(); ?></span>

            </div>

        </div>


            <?php foreach (preg_split("/[\s,]+/", $article->tag) as $tag): ?>

                <a href="/search?SearchForm[text]=<?= str_replace('#', '', $tag) ?>">#<?= $tag ?></a><p></p>

            <?php endforeach; ?>

    </article>


    <?php if (!Yii::$app->user->isGuest): ?>

        <?php $form = \yii\widgets\ActiveForm::begin([

            'action' => ['site/comment', 'id' => $article->id],

            'options' => ['class' => '', 'role' => 'form']]) ?>

        <div class="leave-comment"><!--leave comment-->

            <h4>Leave a reply</h4>

            <form class="form-horizontal contact-form" role="form" method="post" action="#">

                <div class="form-group">

                    <div class="col-md-12">

                        <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control',
                            'placeholder' => 'Write Message'])->label(false) ?>

                    </div>

                </div>

                <button type="submit" class="btn send-btn">Post Comment</button>

                <?php \yii\widgets\ActiveForm::end() ?>

            </form>

        </div><!--end leave comment-->

    <?php endif; ?>

    <?php if (!empty($commentsParent)): ?>

        <div class="comments-block">

            <?php foreach ($commentsParent as $comment): ?>

                <div class="comment-block">

                    <?php if (!$comment->delete): ?>

                        <div class="comment">

                            <a href="#" class="comment-img">

                                <img class="img-round" src="<?= $comment->user->getImage(); ?>" alt="">

                            </a>

                            <div class="comment-body">

                                <div class="comment-top">

                                    <h5><?= $comment->user->name; ?></h5>

                                    <p class="comment-date">

                                        <?= $comment->getDate(); ?>

                                    </p>

                                </div>

                                <div class="comment-text">

                                    <?= $comment->text; ?>

                                </div>

                                <?php if ($comment->user_id == Yii::$app->user->id): ?>

                                    <?php $form = \yii\widgets\ActiveForm::begin([

                                        'action' => ['site/comment-delete', 'id' => $article->id, 'id_comment' => $comment->id],

                                        'options' => ['class' => '', 'role' => 'form']]) ?>

                                    <div class="comment-delete">

                                        <button type="submit">

                                            <i class="fa fa-trash"></i>

                                        </button>
                                        <?php if (!Yii::$app->user->isGuest): ?>

                                            <button class="replay btn pull-right" onclick="ShowReplay(this)"> Replay

                                            </button>

                                        <?php endif; ?>
                                    </div>

                                    <?php \yii\widgets\ActiveForm::end() ?>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php else: ?>

                        <?php if (is_int(array_search($comment->id, array_column($commentsChild, 'comment_id')))): ?>

                            <div class="comment">

                                <a href="#" class="comment-img">

                                    <img class="img-round" src="<?= $comment->user->getImage(); ?>" alt="">

                                </a>

                                <div class="comment-body">

                                    <div class="comment-top">

                                        <h5><?= $comment->user->name; ?></h5>

                                        <p class="comment-date">

                                            <?= $comment->getDate(); ?>

                                        </p>

                                    </div>

                                    <div class="comment-text">

                                        Comment delete

                                    </div>

                                </div>

                            </div>

                        <?php endif; ?>

                    <?php endif; ?>

                    <div class="replay-comment" hidden>

                        <?php if (!Yii::$app->user->isGuest): ?>

                            <?php $form = \yii\widgets\ActiveForm::begin([

                                'action' => ['site/comment', 'id' => $article->id, 'id_comment' => $comment->id],

                                'options' => ['class' => '', 'role' => 'form']]) ?>

                            <div class="leave-comment-child"><!--leave comment-->

                                <h4>Leave a reply for <?= $comment->user->name; ?></h4>

                                <div class="form-group">

                                    <div class="col-md-12">

                                        <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control',
                                            'placeholder' => 'Write Message'])->label(false) ?>

                                    </div>

                                </div>

                                <button type="submit" class="btn send-btn">Post Comment</button>

                                <?php \yii\widgets\ActiveForm::end() ?>

                            </div><!--end leave comment-->

                        <?php endif; ?>

                    </div>

                    <div class="comment-childs-container">

                        <div class="comment-childs">

                            <?php foreach ($commentsChild as $commentChild): ?>

                                <?php if ($commentChild->comment_id == $comment->id): ?>

                                    <div class="comment-block">

                                        <div class="comment">

                                            <a href="#" class="comment-img">

                                                <img class="img-round" src="<?= $commentChild->user->getImage(); ?>"

                                                     alt="">

                                            </a>

                                            <div class="comment-body">

                                                <div class="comment-top">

                                                    <h5><?= $commentChild->user->name; ?></h5>

                                                    <p class="comment-date">

                                                        <?= $commentChild->getDate(); ?>

                                                    </p>

                                                </div>

                                                <div class="comment-text">

                                                    <?= $commentChild->text; ?>

                                                </div>

                                                <?php if ($commentChild->user_id == Yii::$app->user->id): ?>

                                                    <?php $form = \yii\widgets\ActiveForm::begin([

                                                        'action' => ['site/comment-delete', 'id' => $article->id,
                                                            'id_comment' => $commentChild->id],

                                                        'options' => ['class' => '', 'role' => 'form']]) ?>

                                                    <div class="comment-delete">

                                                        <button type="submit">

                                                            <i class="fa fa-trash"></i>

                                                        </button>

                                                    </div>

                                                    <?php \yii\widgets\ActiveForm::end() ?>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                    </div>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>


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

</div>

</div>

<script>

    function ShowReplay(button) {

        var comment = button.parentElement.parentElement.parentElement.parentElement;

        var repl = comment.getElementsByClassName('replay-comment')[0];

        repl.hidden = !repl.hidden;

        console.log(repl);

    }

</script>
