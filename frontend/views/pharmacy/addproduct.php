<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Units;
use app\models\Category;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>

<?php if(Yii::$app->session->hasFlash('message')): ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::$app->session->getFlash('message');?>
    </div>
<?php endif;?>

<div class="pharmacy-create">

    <div class="body-create">
        <?php
            $form = ActiveForm::begin(); 
        ?>
         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                     <?= $form ->field($record1, 'categID')->dropDownList(
                        ArrayHelper::map(Category::find()->all(),'categID','Name'),
                        ['prompt'=> 'Select Category']
                    );?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($record, 'Name');?>
                </div>
            </div>
        </div>


         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($record, 'Manufacturer');?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <p style="color: #4d4d4d;">If the unit you want to use is not in the list of options, please click Unit button to add new unit. After saving the new unit, click on Medicines tab.</p>
                    <?= Html::a('Unit', ['/pharmacy/addunit'], ['class' => 'btn btn-primary', 'style' => 'float: right; display: inline-block; margin-bottom: 5px;'])?>
                    <?= $form ->field($record2, 'unitID')->dropDownList(
                        ArrayHelper::map(Units::find()->all(),'unitID','Unit_name'),
                        ['prompt'=> 'Select Unit']
                    );?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($record, 'Unit_price');?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($record, 'Quantity');?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="col-lg-3">
                        <span><?= Html::submitbutton('Add Product', ['class'=>'btn btn-primary'])?></span>
                    </div>
                    <div class="col-lg-2">
                        <span><?= Html::a('Back', ['/pharmacy/home'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
