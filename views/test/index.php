<?php include ROOT . '/views/layouts/header.php'; ?>


<div class="wrapper">

    <header class="header">
        Страничка тестовых кодов
        <ul class="nav navbar-nav collapse navbar-collapse">
            <li><a href="/test/oop/">ООП</a></li>
            <li><a href="/#/">#</a></li>
            <li><a href="/#/">#</a></li>
            <li><a href="/#/">#</a></li>
            <li><a href="/#/">#</a></li>
        </ul>
    </header><!-- .header-->

    <main class="content">
        <?php
        if ($this->param == 'oop') {
            include ROOT . '/testcode/oop.php';
        }
        ?>

    </main><!-- .content -->

    <footer class="footer">
        <strong>Footer:</strong>
    </footer><!-- .footer -->

</div><!-- .wrapper -->
