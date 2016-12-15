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
                            'label' => 'ADMIN',
                            'icon' => 'fa fa-tachometer',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                            'items' => [
                                ['label' => 'Loan Type', 'icon' => 'fa  fa-caret-right', 'url' => ['/loantype'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Businesses', 'icon' => 'fa  fa-caret-right', 'url' => ['/business'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Business Type', 'icon' => 'fa  fa-caret-right', 'url' => ['/businesstype'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Branches', 'icon' => 'fa  fa-caret-right', 'url' => ['/branch'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Jumpdate', 'icon' => 'fa  fa-caret-right', 'url' => ['/jumpdate'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Employee', 'icon' => 'fa  fa-caret-right', 'url' => ['/employee'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Employee Positions', 'icon' => 'fa  fa-caret-right', 'url' => ['/position'], 'visible' => Yii::$app->user->can('IT')],
                                ['label' => 'Collector Assignment', 'icon' => 'fa  fa-caret-right', 'url' => ['/collectorunit'], 'visible' => Yii::$app->user->can('IT')],
                                [
                                    'label' => 'Loanscheme',
                                    'icon' => 'fa  fa-caret-right',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('IT'),
                                    'items' => [
                                        ['label' => 'Upload Loanscheme', 'icon' => 'fa  fa-caret-right', 'url' => ['/loanscheme/uploadexcel'],],
                                        ['label' => 'Manage Loanscheme', 'icon' => 'fa  fa-caret-right', 'url' => ['/loanscheme'],],
                                        ['label' => 'Loanscheme Data', 'icon' => 'fa  fa-caret-right', 'url' => ['/loanschemevalues'],],
                                    ],
                                ],
                                ['label' => 'User', 'icon' => 'fa  fa-caret-right', 'url' => ['/user'], 'visible' => Yii::$app->user->can('IT')],
                                [
                                    'label' => 'Addresses',
                                    'icon' => 'fa  fa-caret-right',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('IT'),
                                    'items' => [
                                        ['label' => 'Provinces', 'icon' => 'fa  fa-caret-right', 'url' => ['/province'],],
                                        ['label' => 'City/Municipality', 'icon' => 'fa  fa-caret-right', 'url' => ['/municipalitycity'],],
                                        ['label' => 'Barangay', 'icon' => 'fa  fa-caret-right', 'url' => ['/barangay'],],
                                    ],
                                ],
                                [
                                    'label' => 'User Permission',
                                    'icon' => 'fa  fa-caret-right',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('IT'),
                                    'items' => [
                                        ['label' => 'User Assignment', 'icon' => 'fa  fa-caret-right', 'url' => ['/authassignment'],],
                                    ],
                                ],
                                ['label' => 'Borrowers Info.', 'icon' => 'fa  fa-caret-right', 'url' => ['/borrower'], 'visible' => Yii::$app->user->can('ORGANIZER')],
                            ],
                        ],
                        [
                            'label' => 'TRANSACTIONS',
                            'icon' => 'fa fa-briefcase',
                            'visible' => Yii::$app->user->can('ORGANIZER'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Borrowers Collection', 'icon' => 'fa  fa-caret-right', 'url' => ['site/borrowerscollection'], "visible" => Yii::$app->user->can('ORGANIZER')],
                                ['label' => 'C.I. Canvass Approval', 'icon' => 'fa  fa-caret-right', 'url' => ['/site/cicanvassapproval'], "visible" => Yii::$app->user->can('ORGANIZER')],
                                ['label' => 'Hold for Scheduling', 'icon' => 'fa  fa-caret-right', 'url' => ['/site/holdforsfr'], "visible" => Yii::$app->user->can('ORGANIZER')],
                                ['label' => 'Schedule for Releasing', 'icon' => 'fa  fa-caret-right', 'url' => ['/site/sfr'], "visible" => Yii::$app->user->can('ORGANIZER')],
                                ['label' => 'Approval for Releasing', 'icon' => 'fa  fa-caret-right', 'url' => ['/site/releasingapproval'], "visible" => Yii::$app->user->can('IT')],
                                ['label' => 'Approved for Release', 'icon' => 'fa  fa-caret-right', 'url' => ['/site/approvedrelease'], "visible" => Yii::$app->user->can('ORGANIZER')],
                            ],
                        ],
                        [
                            'label' => 'INQUIRIES',
                            'icon' => 'fa fa-info',
                            'visible' => Yii::$app->user->can('ORGANIZER'),
                            'url' => '#',
                            'items' => [
                                        ['label' => 'Borrowers Accounts Ledger', 'icon' => 'fa  fa-caret-right', 'url' => ['site/accountledger'],],
                                    ],
                        ],
                        [
                            'label' => 'REPORTS',
                            'icon' => 'fa fa-file-text',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => ['/report'],
                        ],
                        [
                            'label' => 'PRINTABLES',
                            'icon' => 'fa fa-print',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                        ],
                        [
                            'label' => 'HELP',
                            'icon' => 'fa fa-question-circle-o',
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => '#',
                        ],
                    ],
                ]
        )
        ?>

    </section>
</aside>
