<?php
    /**
     * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
     * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the LICENSE.txt
     * Redistributions of files must retain the above copyright notice.
     *
     * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     * @link          https://cakephp.org CakePHP(tm) Project
     * @since         0.10.0
     * @license       https://opensource.org/licenses/mit-license.php MIT License
     * @var \App\View\AppView $this
     */
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            Tribe Condo:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


        <?= $this->Html->css(['normalize.min', 'milligram.min', 'all.min', 'tribe']) ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body class="<?php echo strtolower($this->request->getParam('controller')); ?> <?php echo strtolower($this->request->getParam('action')); ?> <?php echo isset($Auth['id']) ? 'private' : 'public'; ?>">
        <nav class="sidebar">
            <div class="header">
                <div class="menu-toggle clickable fas fa-bars"></div>
            </div>

            <?php if (isset($menu[$Auth['role_code']]) && count($menu[$Auth['role_code']]) > 0): ?>
                    <!-- Private Menu -->
                    <ul class="main-menu">
                        <?php foreach ($menu[$Auth['role_code']] as $item): ?>
                            <a href="<?= $item['link']; ?>">
                                <li class="clickable <?= $item['class']; ?>">
                                    <div class="icon <?= $item['icon_class']; ?>"></div>
                                    <div class="label">
                                        <?= $item['title']; ?>
                                    </div>
                                </li>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                    <!-- Private Menu -->
                <?php endif; ?>
        </nav>
        <main class="content">
            <nav class="header">
                <div class="top-nav-links">
                    <div class="profile-info">
                        <?php echo isset($Auth['full_name']) ? $Auth['full_name'] : ''; ?>
                    </div>
                    <a href="/tribe/users/logout" class="icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </nav>
            <article class="container">
                <?= $this->fetch('content') ?>
            </article>
        </main>
        <footer>
        </footer>
        <script>
                jQuery(document).ready(function ()
                {
                    /* Adjust main menu and content height */
                    var contentHeight = parseInt(jQuery("main.content").outerHeight());
                    var sidebarHeight = parseInt(jQuery("nav.sidebar").outerHeight());

                    var maxHeight = Math.max(contentHeight, sidebarHeight);

                    jQuery("main.content").css("height", maxHeight + "px");
                    jQuery("nav.sidebar").css("height", maxHeight + "px");


                    jQuery(".menu-toggle").on("click", function ()
                    {
                        if (jQuery("body").hasClass("show-menu"))
                        {
                            jQuery("body").removeClass("show-menu");
                        }
                        else
                        {
                            jQuery("body").addClass("show-menu");
                        }
                    });
                });
        </script>
        <?= $this->Flash->render() ?>
    </body>
</html>
