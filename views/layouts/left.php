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
                            'label' => 'Maintenance',
                            'icon' => 'fa fa-tachometer',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                            'items' => [
                                ['label' => 'Loan Type', 'icon' => 'fa fa-circle-o', 'url' => ['/loantype'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Business Type', 'icon' => 'fa fa-circle-o', 'url' => ['/businesstype'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Branches', 'icon' => 'fa fa-circle-o', 'url' => ['/branch'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Jumpdate', 'icon' => 'fa fa-circle-o', 'url' => ['/jumpdate'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Loan Scheme', 'icon' => 'fa fa-circle-o', 'url' => ['/loanscheme'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Employee', 'icon' => 'fa fa-circle-o', 'url' => ['/employee'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'User', 'icon' => 'fa fa-circle-o', 'url' => ['/user'], 'visible' => Yii::$app->user->can('IT')],
                                [
                                    'label' => 'User Permission',
                                    'icon' => 'fa fa-circle-o',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('IT'),
                                    'items' => [
                                        ['label' => 'Auth-Item', 'icon' => 'fa fa-circle-o', 'url' => ['/authitem'],],
                                        ['label' => 'Auth-Item-Child', 'icon' => 'fa fa-circle-o', 'url' => ['/authitemchild'],],
                                        ['label' => 'Auth-Assignment', 'icon' => 'fa fa-circle-o', 'url' => ['/authassignment'],],
                                    ],
                                ],
                                ['label' => 'Borrowers Info.', 'icon' => 'fa fa-circle-o', 'url' => ['/borrower'], 'visible' => Yii::$app->user->can('organizer')],
                            ],
                        ],
                        [
                            'label' => 'Transaction',
                            'icon' => 'fa fa-suitcase',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                            'items' => [
                            ],
                        ],
                        [
                            'label' => 'Inquiries',
                            'icon' => 'fa fa-line-chart',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                            'items' => [

                            ],
                        ],
                        [
                            'label' => 'Reports',
                            'icon' => 'fa fa-print',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => ['/report'],
                        ],
                        [
                            'label' => 'Help',
                            'icon' => 'fa fa-support',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                            'items' => [
                           
                            ],
                        ],
                    ],
                ]
        )
        ?>

    </section>
</aside>
