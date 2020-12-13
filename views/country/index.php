<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h3>Countries and capitals</h3>
<ul>
<?php foreach ($countries as $country): ?>
    <li>
        <?= Html::encode("The capital of {$country->name} is") ?>
        <?= $country->capital ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>