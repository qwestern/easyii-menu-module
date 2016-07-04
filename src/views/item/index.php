<?php

use qwestern\easyii\menu\assets\MenuAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Items';
$this->params['breadcrumbs'][] = $this->title;

MenuAsset::register($this);
?>
<div class="menu-item-index">

    <p>
        <?= Html::a('Create Menu Item', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div class="row">

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php Pjax::begin() ?>
                    <div class="sortable-container menu-itemes">
                        <?=
                        $this->render('links', [
                            'dataProvider' => $dataProvider,
                        ]);
                        ?>
                    </div>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>

    </div>
    
</div>

<?php
$orderUrl = Url::to(['update']);
$this->registerJs(<<<JS
$('.sortable').sortable({
        connectWith: '.sortable',
        tolerance: 'intersect',
        delay: 250,
        stop: function(event, ui) {
        
            var itemId = ui.item.find('.sortable-item-content').data('linkid');
            var parentId = {$id};
            if(!ui.item.parent().parent().hasClass('sortable-container')){
                parentId = ui.item.parent().parent().find('.sortable-item-content').data('linkid');
            }
            var prevItemId = null;
            if(ui.item.prev()) {
                prevItemId = ui.item.prev().find('.sortable-item-content').data('linkid');
            }

            $.ajax({
                type: "PATCH",
                url: '{$orderUrl}/' + itemId,
                data: {parent_id: parentId, previous_id: prevItemId},
                success: function(data){
                    $('.menu-link-alert').hide().filter('.alert-info').show();
                    setTimeout(function(){
                        $('.menu-link-alert').hide();
                    }, 1500);
                },
                error: function(data){
                    $('.menu-link-alert').hide().filter('.alert-danger').show();
                    setTimeout(function(){
                        $('.menu-link-alert').hide();
                    }, 1500);
                },
            });
        },
    });
JS
);