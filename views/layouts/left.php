<aside class="main-sidebar">
    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        [
                            'label' => 'File',
                            'icon' => 'fa fa-tachometer',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                            'items' => [
                                ['label' => 'Loan Type', 'icon' => 'fa fa-circle-o', 'url' => ['/loantype'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Businesses', 'icon' => 'fa fa-circle-o', 'url' => ['/business'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Business Type', 'icon' => 'fa fa-circle-o', 'url' => ['/businesstype'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Branches', 'icon' => 'fa fa-circle-o', 'url' => ['/branch'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Jumpdate', 'icon' => 'fa fa-circle-o', 'url' => ['/jumpdate'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Canvasser', 'icon' => 'fa fa-circle-o', 'url' => ['/canvasser'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Credit Invistigator', 'icon' => 'fa fa-circle-o', 'url' => ['/ci'], 'visible' => Yii::$app->user->can('IT')],
                                [
                                    'label' => 'Loanscheme',
                                    'icon' => 'fa fa-circle-o',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('IT'),
                                    'items' => [
                                        ['label' => 'Upload Loanscheme', 'icon' => 'fa fa-circle-o', 'url' => ['/loanscheme/uploadexcel'],],
                                        ['label' => 'Manage Loanscheme', 'icon' => 'fa fa-circle-o', 'url' => ['/loanscheme'],],
                                        ['label' => 'Loanscheme Data', 'icon' => 'fa fa-circle-o', 'url' => ['/loanschemevalues'],],
                                    ],
                                ],
                                ['label' => 'User', 'icon' => 'fa fa-circle-o', 'url' => ['/user'], 'visible' => Yii::$app->user->can('IT')],
                                [
                                    'label' => 'Addresses',
                                    'icon' => 'fa fa-circle-o',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('IT'),
                                    'items' => [
                                        ['label' => 'Provinces', 'icon' => 'fa fa-circle-o', 'url' => ['/province'],],
                                        ['label' => 'City/Municipality', 'icon' => 'fa fa-circle-o', 'url' => ['/municipalitycity'],],
                                        ['label' => 'Barangay', 'icon' => 'fa fa-circle-o', 'url' => ['/barangay'],],
                                    ],
                                ],
                                [
                                    'label' => 'User Permission',
                                    'icon' => 'fa fa-circle-o',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('IT'),
                                    'items' => [
                                        ['label' => 'User Assignment', 'icon' => 'fa fa-circle-o', 'url' => ['/authassignment'],],
                                    ],
                                ],
                                ['label' => 'Borrowers Info.', 'icon' => 'fa fa-circle-o', 'url' => ['/borrower'], 'visible' => Yii::$app->user->can('ORGANIZER')],
                            ],
                        ],
                        [
                            'label' => 'Transaction',
                            'icon' => 'fa fa-briefcase',
                            'url' => '#',
                            'items' => [
                                ['label' => 'C.I. Canvass Approval', 'icon' => 'fa fa-circle-o', 'url' => ['/site/cicanvassapproval'], "visible" => Yii::$app->user->can('ORGANIZER')],
                                ['label' => 'Hold for SFR', 'icon' => 'fa fa-circle-o', 'url' => ['/site/holdforsfr'], "visible" => Yii::$app->user->can('ORGANIZER')],
                                ['label' => 'Schedule for Releasing', 'icon' => 'fa fa-circle-o', 'url' => ['/site/sfr'], "visible" => Yii::$app->user->can('ORGANIZER')],
                                ['label' => 'Approval for Realesing', 'icon' => 'fa fa-circle-o', 'url' => ['/site/canvassapproval'], "visible" => Yii::$app->user->can('IT')],
                            ],
                        ],
                        [
                            'label' => 'Reports',
                            'icon' => 'fa fa-print',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => ['/report'],
                        ],
                    ],
                ]
        )
        ?>

    </section>
</aside>
