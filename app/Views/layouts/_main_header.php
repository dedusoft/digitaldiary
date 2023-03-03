<!-- ======= Header ======= -->
<header id="header" class="<?php if (url_is('/')) : ?>fixed-top <?php endif ?>">
    <div class="container d-flex">

        <div class="logo mr-auto">
            <h1 class="text-light"><a href="index.html"><span>d</span>Diary</a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <?php if (url_is('/')) : ?>
                    <li class="active"><a href="#header">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#blog">Blog</a></li>
                    <li class="mx-2"><a class="btn-sm btn-primary" href="auth/login">Sign In</a></li>
                    <li class="mx-2"><a class="btn-sm btn-secondary" href="auth/register">Sign Up</a></li>
                <?php endif ?>

                <?php if (url_is('dashboard')) : ?>
                    <li class="mx-2"><a class="btn-sm btn-primary" href="auth/login">Sign Out</a></li>
                <?php endif ?>


            </ul>
        </nav>

    </div>
</header>
<!-- End Header -->