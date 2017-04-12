<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

//use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        

        <div class="wrap">
            
            <?php
            NavBar::begin([
                'brandLabel' => 'FABREC EP',
                
                
                 // 'brandLabel' => '<img src="ruta-hacia-la-imagen" '
                
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (!Yii::$app->user->isGuest) {
                $menu = [
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'FUNCIONARIO',
                            'items' => [
                                ['label' => 'Ingresar Funcionario', 'url' => ['/funcionario/index']],
                                ['label' => 'Reporte', 'url' => ['/funcionario/reporte']]
                            ]
                        ],
                        ['label' => 'CALCULO DE VACACIONES',
                            'items' => [
                                ['label' => 'Vacaciones Periódicas', 'url' => ['/calculo/index']],
                                ['label' => 'Vacaciones Proporcionales', 'url' => ['/calculo/calcular']],
                                ['label' => 'Estado Actual de Vacaciones', 'url' => ['/calvac/index']],
                                ['label' => 'Reporte Vacaciones Periódicas', 'url' => ['/calculo/reporte']],
                                ['label' => 'Reporte Estado Actual de Vacaciones', 'url' => ['/calvac/reporte']],
                            ]
                        ],
                        ['label' => 'PERMISOS',
                            'items' => [
                               ['label' => 'Registrar Permisos', 'url' => ['/permisos/index']],
                               ['label' => 'Reporte', 'url' => ['/permisos/reporte']],
                            ]
                        ],
                        ['label' => 'TIPO PERMISOS',
                            'items' => [
                               ['label' => 'Ingresar Tipos de Permisos', 'url' => ['/tipopermiso/index']]
                            ]
                        ],
                      //  ['label' => 'Vacaciones',
                         //   'items' => [
                           //     ['label' => 'Registrar Vacaciones', 'url' => ['/vacacion/index']],
                            //    ['label' => 'Reporte', 'url' => ['/vacacion/reporte']],
                            //    ['label' => 'Reporte Resumen', 'url' => ['/vacacion/resumen']]
                          //  ]
                      //  ],
                        Yii::$app->user->isGuest ?
                                ['label' => 'Logout', 'url' => ['/site/login']] :
                                [
                            'label' => 'USUARIO (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']
                                ],
                    ],
                ];
            } else {
                $menu = [
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [

                        Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                [
                            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']
                                ],
                    ],
                ];
            }



            echo Nav::widget($menu);
            NavBar::end();
            ?>
               <!--logo-->
            <div class="container">
                <?= Html::img('@web/images/logo.jpg',['style'=>"padding-bottom:10px",'width'=>230, 'height'=>80]); ?>
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">FABREC <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

<?php $this->endBody() ?>
        
    </body>
    
</html>
        <?php $this->endPage() ?>
