<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Главная';
$this->params['breadcrumbs'][] = $this->title;
?>



    <!-- ========== Loading Page ========== -->
    <div class="preloader">
        <span class="percent v-middle">0</span>
        <span class="loading-text text-uppercase">Loading ...</span>
        <div class="preloader-bar">
            <div class="preloader-progress"></div>
        </div>
        <h1 class="title v-middle">
            <span class="letter-stroke">ADSBLOGGER</span>
            <span class="text-fill">ADSBLOGGER</span>
        </h1>
    </div>
    <!-- ========== End Loading Page ========== -->

    <!-- ========== Menu ========== -->
    <div class="site-header dsn-load-animate dsn-container">
        <div class="extend-container d-flex w-100 align-items-baseline justify-content-between align-items-end">
            <div class="inner-header p-relative">
                <div class="main-logo">
                    <a href="/" data-dsn="parallax">
                        <img class="light-logo"
                            src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                            data-dsn-src="/web/main/img/logo.png" alt="" />
                        <img class="dark-logo"
                            src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                            data-dsn-src="/web/main/img/logo-dark.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== End Menu ========== -->


    <main class="main-root">

        <!-- ========== side box left ========== -->
        <div class="side-bar-full">


            <div class="side-box-left z-index-1">
                <div class="side-menu border-left border-right p-relative h-100 d-flex justify-content-center">
                    <div class="page-active">
                        <h2 class="text-uppercase">ADSBLOGGER</h2>
                    </div>
                </div>
            </div>
            <div class="side-box-right text-stroke border-right text-uppercase z-index-2">
                <div class="text-inner over-hidden">
                    <div class="text-stroke-box">
                        <div class="text-stroke-inner">ADSBLOGGER.MEDIA</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== End side box left ========== -->

        <div class="p-fixed has-parallax-header has-parallax-header v-dark-head">
            <div class="p-absolute z-index-0 before-z-index h-100 w-100 " data-overlay="7" data-dsn-ajax="img">
                <img class="cover-bg-img" src="/web/main/img/view/layout-header.png" alt="" data-dsn-position="50% 32%">
            </div>
        </div>


        <div id="dsn-scrollbar">
            <div class="inner-content">

                <!-- ========== Header ========== -->
                <header class="p-relative h-v-100 dsn-header-animation p-relative" data-dsn-title="ГЛАВНАЯ" id="home_block">

                    <div class="box-content dsn-container align-items-center">
                        <div class="hero-content dsn-hero-parallax-title">
                            <h1 class="title p-relative">ADSBLOGGER</h1>
                            <p class="description mt-20 max-w650"><font style="font-size:18px;font-weight:700;">Креативное Influencer Marketing агентство</font><br>Повышаем окупаемость рекламы у блогеров с помощью собственного IT-инструмента.</p>
                            <button onclick="swa()" type="button" class="link-custom v-light image-zoom mt-30" data-dsn="parallax">
                                Стратегия продвижения
                            </button>
							<p class="description mt-20 max-w570">БЕСПЛАТНО</p>
                        </div>

                    </div>
                </header>
                <!-- ========== End Header ========== -->
                <div class="wrapper">

                    <section  class="pages-view section-padding p-relative v-light" data-dsn-title="О НАС" id="about_block">
                        <div class="dsn-container d-flex flex-column">

                            <p class="sub-heading mb-15">
                                <span class="background-section pt-5 pb-5 pl-15 pr-15">Держи руку на пульсе!</span>

                            </p>
                            <h2 class="section-title" style="letter-spacing: 0px;">Собственная IT - разработка ADSBLOGGER<br><font style="font-size:19px;">позволяет прогнозировать эффективность публикаций еще до старта кампании</font></h2>
                            <h2 style="letter-spacing: 0px;margin-bottom:50px;">Все в одном месте - и точка.</h2>                            
                        </div>

                        <div class="dsn-container">
                            <div class="d-grid grid-lg-4 grid-md-2 grid-sm-1">
                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="demo.html" target="_blank">
                                            <img src="/web/main/img/view/demo.jpg" alt="">
                                        </a>

                                    </div>
                                    <!--<div class="box-title p-relative mt-30 d-flex align-items-center">-->
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-section text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="demo.html" target="_blank" class="storm_trooper"> <span
                                                    class="background-theme p-5 storm_jedi">01</span> Прогнозируй эффективность!</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="demo-2.html" target="_blank">
                                            <img src="/web/main/img/view/demo-2.jpg" alt="">
                                        </a>

                                    </div>
                                    <!--<div class="box-title p-relative mt-30 d-flex align-items-center">-->
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-section text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="demo-2.html" target="_blank" class="storm_trooper"> <span
                                                    class="background-theme p-5 storm_jedi">02</span> Контролируй размещения публикаций</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="demo-3.html" target="_blank">
                                            <img src="/web/main/img/view/demo-3.jpg" alt="">
                                        </a>

                                    </div>
                                    <!--<div class="box-title p-relative mt-30 d-flex align-items-center">-->
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-section text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="demo-3.html" target="_blank" class="storm_trooper"> <span
                                                    class="background-theme p-5 storm_jedi">03</span> Согласовывай креативы</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="personal.html" target="_blank">
                                            <img src="/web/main/img/view/demo-4.jpg" alt="">
                                        </a>

                                    </div>
                                    <!--<div class="box-title p-relative mt-30 d-flex align-items-center">-->
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">									
                                        <h4
                                            class="sm-title-block background-section text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="personal.html" target="_blank" class="storm_trooper"> <span
                                                    class="background-theme p-5 storm_jedi">04</span> Получай отчетность</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="slider-webgel-horizontal.html" target="_blank">
                                            <img src="/web/main/img/view/demo-5.jpg" alt="">
                                        </a>

                                    </div>
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4 class="sm-title-block background-section text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="slider-webgel-horizontal.html" target="_blank" class="storm_trooper"> <span
                                                    class="background-theme p-5 storm_jedi">05</span> Масштабируйся</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="slider-webgel-horizontal-2.html" target="_blank">
                                            <img src="/web/main/img/view/demo-6.jpg" alt="">
                                        </a>

                                    </div>
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4 class="sm-title-block background-section text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="slider-webgel-horizontal-2.html" target="_blank" class="storm_trooper"> <span
                                                    class="background-theme p-5 storm_jedi">06</span> Закрывающие документы в два клика!</a>
                                        </h4>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </section>

                    <section class="pages-view section-padding p-relative v-light background-section" id="aims_block"
                        data-dsn-title="ВОЗМОЖНОСТИ">
                        <div class="dsn-container d-flex flex-column">

                            <p class="sub-heading mb-15">
                                <span class="background-main pt-5 pb-5 pl-15 pr-15">Держи руку на пульсе!</span>

                            </p>
                            <h2 class="section-title ">Какие задачи решаем</h2>

                        </div>

                        <div class="dsn-container">
                            <div class="d-grid grid-lg-3 grid-md-2 grid-sm-1">
                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">01</span> Укрепляем имидж и увеличиваем узнаваемость</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-2.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-1.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-2.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">02</span> Привлечение трафика из Social Media
                                               </a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-3.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-2.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-3.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">03</span> Увеличение продаж </a>
                                        </h4>
                                    </div>

                                </div>


                            </div>
                        </div>		
                    </section>
					
					
					
                    <section class="pages-view section-padding p-relative v-light background-section" id="stages_block" style="padding-top: 0px;"
                        data-dsn-title="ПОДГОТОВКА">
                        <div class="dsn-container d-flex flex-column">

                            <p class="sub-heading mb-15">
                                <span class="background-main pt-5 pb-5 pl-15 pr-15">Как решаем</span>

                            </p>
                            <h2 class="section-title ">1 этап - подготовка</h2>

                        </div>

                        <div class="dsn-container">
                            <div class="d-grid grid-lg-3 grid-md-2 grid-sm-1">
                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio.jpg" alt="">
                                        </a>

                                    </div>
                                    <!--<div class="box-title p-relative mt-30 d-flex align-items-center">-->
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">01</span> Создаем портрет целевого блогера</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-2.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-1.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-2.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">02</span> Сегментируем целевую аудиторию
                                                </a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-3.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-2.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-3.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">03</span> Подбираем блогеров, анализируем аудиторию, прогнозируем результаты </a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-3.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-2.jpg" alt="">
                                        </a>

                                    </div>
                                    <!--<div class="box-title p-relative mt-30 d-flex align-items-center">-->
                                    <div class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-3.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">04</span> Разрабатываем креативную концепцию, оптимальный микс из социальных сетей, готовим техническое задание для блогеров
 </a>
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>		
                    </section>					
					
					
					
                    <section class="pages-view section-padding p-relative v-light background-section" style="padding-top: 0px;"
                        data-dsn-title="ЗАПУСК">
                        <div class="dsn-container d-flex flex-column">

                            <p class="sub-heading mb-15">
                                <span class="background-main pt-5 pb-5 pl-15 pr-15">Как решаем</span>

                            </p>
                            <h2 class="section-title ">2 этап - запуск кампании</h2>

                        </div>

                        <div class="dsn-container">
                            <div class="d-grid grid-lg-3 grid-md-2 grid-sm-1">
                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">01</span> Договариваемся с блогерами о размещении</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-2.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-1.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-2.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">02</span> Работаем над содержанием и качеством креативов
                                               </a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-3.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-2.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-3.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">03</span> Контролируем сроки публикаций</a>
                                        </h4>
                                    </div>

                                </div>



                            </div>
                        </div>		
                    </section>						
					
					
                    <section class="pages-view section-padding p-relative v-light background-section" style="padding-top: 0px;"
                        data-dsn-title="3 ЭТАП">
                        <div class="dsn-container d-flex flex-column">

                            <p class="sub-heading mb-15">
                                <span class="background-main pt-5 pb-5 pl-15 pr-15">Как решаем</span>

                            </p>
                            <h2 class="section-title ">3 этап</h2>

                        </div>

                        <div class="dsn-container">
                            <div class="d-grid grid-lg-3 grid-md-2 grid-sm-1">
                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">01</span> Работа с репутацией</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-2.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-1.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-2.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">02</span> Отвечаем на возражения и комментарии, следим за репутацией бренда в сети
                                               </a>
                                        </h4>
                                    </div>

                                </div>





                            </div>
                        </div>		
                    </section>						
					
					
         <section class="pages-view section-padding p-relative v-light background-section" style="padding-top: 0px;"
                        data-dsn-title="АНАЛИТИКА">
                        <div class="dsn-container d-flex flex-column">

                            <p class="sub-heading mb-15">
                                <span class="background-main pt-5 pb-5 pl-15 pr-15">Как решаем</span>

                            </p>
                            <h2 class="section-title" style="font-size:33px;">4 этап - postcampaign аналитика</h2>

                        </div>

                        <div class="dsn-container">
                            <div class="d-grid grid-lg-3 grid-md-2 grid-sm-1">
                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">01</span> Собираем статистику по рекламным публикациям</a>
                                        </h4>
                                    </div>

                                </div>

                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-2.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-1.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-2.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">02</span> Рассчитываем  Reach и perfomance-показатели, анализируем каждую из публикаций и изучаем связки для эффективного масштабирования
                                               </a>
                                        </h4>
                                    </div>

                                </div>


                                <div class="box-view-item">
                                    <div class="box-img">
                                        <a href="work-2.html" target="_blank">
                                            <img src="/web/main/img/view/portfolio-1.jpg" alt="">
                                        </a>

                                    </div>
                                    <div
                                        class="box-title p-relative mt-30 d-flex align-items-center">
                                        <h4
                                            class="sm-title-block background-main text-uppercase  pt-10 pb-10 pl-15 pr-15 line-bg-right">
                                            <a href="work-2.html" class="storm_trooper"> <span class="background-theme p-5 storm_jedi">03</span> На основании полученных данных, предлагаем корректировки в текущую кампанию и идеи для увеличении прибыли 
                                               </a>
                                        </h4>
                                    </div>

                                </div>


                            </div>
                        </div>		
                    </section>					
					
					
					
					

                    <section class="features section-padding p-relative" data-dsn-title="ПРЕИМУЩЕСТВА" id="advantages_block">
                        <div class="dsn-container d-flex flex-column">

                            <p class="sub-heading mb-15">
                                <span class="background-section pt-5 pb-5 pl-15 pr-15">Все в одних руках </span>

                            </p>
                            <h2 class="section-title">Встраиваем influencer marketing в вашу стратегию коммуникации</h2>
                        </div>

                        <div class="dsn-container">
                            <ul>
                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 456.559 456.559"
                                            style="enable-background:new 0 0 456.559 456.559;" xml:space="preserve">
                                            <g>
                                                <path d="M351.79,151.874c-3.434,0-6.875-1.308-9.498-3.931c-5.238-5.245-5.238-13.75,0-18.995l53.02-53.006l-53.02-53.013
		c-5.238-5.245-5.238-13.75,0-18.995c5.245-5.245,13.75-5.245,18.995,0l62.511,62.511c2.518,2.518,3.931,5.938,3.931,9.498
		c0,3.56-1.413,6.98-3.931,9.498l-62.511,62.504C358.665,150.566,355.224,151.874,351.79,151.874z" />
                                                <path d="M42.958,227.428c-7.413,0-13.428-6.015-13.428-13.428v-80.932c0-38.907,31.647-70.554,70.554-70.554h314.218
		c7.413,0,13.428,6.015,13.428,13.428c0,7.413-6.015,13.428-13.428,13.428H100.083c-24.094,0-43.697,19.604-43.697,43.697V214
		C56.386,221.414,50.371,227.428,42.958,227.428z" />
                                                <path d="M357.162,394.049H42.258c-7.413,0-13.428-6.015-13.428-13.428s6.015-13.428,13.428-13.428h314.903
		c24.101,0,43.704-19.604,43.704-43.697v-82.534c0-7.413,6.015-13.428,13.428-13.428c7.413,0,13.428,6.015,13.428,13.428v82.534
		C427.722,362.402,396.068,394.049,357.162,394.049z" />
                                                <path d="M104.769,456.559c-3.434,0-6.875-1.308-9.498-3.931l-62.511-62.511c-2.518-2.518-3.931-5.938-3.931-9.498
		s1.413-6.98,3.931-9.498l62.511-62.504c5.245-5.245,13.75-5.245,18.995,0c5.238,5.245,5.238,13.75,0,18.995l-53.02,53.006
		l53.02,53.013c5.238,5.245,5.238,13.75,0,18.995C111.644,455.252,108.203,456.559,104.769,456.559z" />
                                            </g>
                                        </svg>

                                    </div>
                                    <h5 class="sm-title-block mt-15">Креативная Концепция</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg enable-background="new 0 0 510.769 510.769" viewBox="0 0 510.769 510.769"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="m402.83 166.432 22.419-65.613c1.532-4.484.403-9.352-2.947-12.702s-8.219-4.478-12.701-2.948l-18.471 6.311c-3.92 1.34-6.012 5.603-4.673 9.522 1.341 3.921 5.603 6.012 9.522 4.673l13.313-4.549-21.067 61.656c-1.205 3.524-.765 7.357 1.207 10.515l35.469 56.813-68.319-5.344c-4.535-.367-8.86 1.791-11.316 5.599l-34.603 53.561-17.608-58.321c-1.194-3.962-4.272-7.042-8.237-8.24l-58.324-17.608 53.563-34.604c3.807-2.461 5.952-6.797 5.598-11.313l-5.345-68.321 56.817 35.471c3.155 1.967 6.987 2.407 10.508 1.204l18.034-6.162c3.92-1.339 6.012-5.603 4.672-9.521-1.339-3.92-5.606-6.016-9.521-4.672l-16.832 5.751-60.229-37.601c-3.971-2.478-8.92-2.511-12.921-.084-4.001 2.428-6.26 6.834-5.896 11.5l5.634 72.016-57.076 36.873c-4.081 2.637-6.194 7.264-5.516 12.075s3.99 8.673 8.642 10.077l33.54 10.126-177.971 177.967c-2.929 2.93-2.929 7.678 0 10.607 1.465 1.464 3.385 2.196 5.304 2.196s3.839-.732 5.304-2.196l183.657-183.656 12.649 3.819 3.819 12.65-56.077 56.077c-2.929 2.93-2.929 7.678 0 10.607 1.465 1.464 3.385 2.196 5.304 2.196s3.839-.732 5.304-2.196l50.389-50.39 10.126 33.54c1.404 4.651 5.266 7.963 10.077 8.642.596.084 1.188.126 1.775.125 4.151 0 7.989-2.065 10.3-5.641l36.874-57.075 72.016 5.634c4.665.359 9.071-1.894 11.498-5.896 2.428-4.001 2.396-8.952-.082-12.921z" />
                                                <path
                                                    d="m204.211 322.675-168.888 168.889c-4.892 4.892-12.566 5.182-17.108.639-4.541-4.54-4.254-12.215.64-17.107l41.309-41.309c2.929-2.93 2.929-7.678 0-10.607-2.93-2.928-7.678-2.928-10.607 0l-41.31 41.308c-10.741 10.742-11.028 27.932-.638 38.322 5.081 5.081 11.788 7.608 18.573 7.607 7.088 0 14.261-2.759 19.749-8.246l168.888-168.889c2.929-2.93 2.929-7.678 0-10.607-2.93-2.928-7.678-2.928-10.608 0z" />
                                                <path
                                                    d="m160.979 156.928c1.746.936 3.693 1.411 5.646 1.411 1.273 0 2.551-.202 3.774-.612l29.553-9.891c3.888-1.3 6.801-4.451 7.792-8.43.991-3.978-.103-8.128-2.926-11.1l-22.1-23.272c-4.313-4.545-11.457-4.978-16.26-.984l.001-.001c-15.975 13.276-15.003 32.051-11.375 45.463.857 3.165 3.005 5.867 5.895 7.416zm12.948-39.368 16.695 17.581-21.833 7.307c-1.675-7.654-2.119-17.287 5.138-24.888z" />
                                                <path
                                                    d="m326.04 51.242c2.246 3.23 5.876 5.12 9.786 5.12.164 0 .328-.003.493-.01 4.097-.166 7.772-2.381 9.832-5.925l16.13-27.747c3.147-5.416 1.557-12.391-3.621-15.879 0 0 0-.001-.001-.001-17.229-11.602-34.974-5.397-46.825 1.851-2.797 1.709-4.789 4.53-5.464 7.738-.673 3.204.012 6.582 1.88 9.267zm21.75-33.48-12.186 20.96-13.143-18.901c6.876-3.757 15.997-6.888 25.329-2.059z" />
                                                <path
                                                    d="m244.929 48.048c1.481 1.834 3.649 2.785 5.837 2.785 1.655 0 3.322-.546 4.71-1.668 3.222-2.604 3.722-7.326 1.117-10.547l-13.664-16.901c-2.603-3.221-7.325-3.722-10.547-1.117-3.222 2.604-3.722 7.326-1.117 10.547z" />
                                                <path
                                                    d="m382.819 306.308c-2.973-2.821-7.122-3.915-11.101-2.926-3.979.991-7.13 3.904-8.43 7.791l-9.891 29.554c-1.038 3.1-.747 6.532.798 9.417 1.548 2.891 4.25 5.039 7.416 5.897 5.79 1.566 10.983 2.24 15.64 2.24 14.88 0 24.24-6.898 29.823-13.614 3.992-4.803 3.561-11.945-.984-16.26zm-14.141 36.028 7.307-21.833 17.581 16.695c-7.603 7.259-17.236 6.815-24.888 5.138z" />
                                                <path
                                                    d="m504.325 152.466c0-.001-.001-.001 0 0-3.489-5.18-10.463-6.769-15.882-3.622l-27.746 16.131c-3.544 2.06-5.759 5.735-5.924 9.832-.166 4.096 1.745 7.938 5.11 10.277l25.583 17.79c2.01 1.398 4.405 2.134 6.827 2.134.815 0 1.634-.084 2.44-.253 3.209-.675 6.03-2.666 7.739-5.462 13.136-21.473 8.258-37.317 1.853-46.827zm-13.02 36.197-18.902-13.144 20.961-12.186c4.83 9.335 1.699 18.454-2.059 25.33z" />
                                                <path
                                                    d="m489.408 268.197-16.901-13.664c-3.223-2.606-7.944-2.105-10.547 1.117-2.604 3.221-2.104 7.943 1.117 10.547l16.901 13.664c1.388 1.122 3.055 1.668 4.71 1.668 2.188 0 4.355-.951 5.837-2.785 2.605-3.221 2.105-7.944-1.117-10.547z" />
                                                <path
                                                    d="m471.57 42.739c-2.829-3.024-7.576-3.185-10.601-.353l-18.749 17.541c-3.024 2.83-3.183 7.576-.353 10.601 1.477 1.578 3.475 2.376 5.479 2.376 1.835 0 3.676-.67 5.122-2.023l18.749-17.541c3.025-2.831 3.184-7.577.353-10.601z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <h5 class="sm-title-block mt-15">Разработка подачи</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"
                                            viewBox="0 0 512.568 512.568"
                                            style="enable-background:new 0 0 512.568 512.568;" xml:space="preserve">
                                            <path
                                                d="M254.284,325.284c-38.598,0-70-31.402-70-70s31.402-70,70-70s70,31.402,70,70S292.882,325.284,254.284,325.284z   M254.284,225.284c-16.542,0-30,13.458-30,30s13.458,30,30,30s30-13.458,30-30S270.826,225.284,254.284,225.284z M360.427,407.426  l-28.285-28.284L255.284,456l-73.857-73.858l-28.285,28.284l102.143,102.142L360.427,407.426z M360.427,105.142L255.284,0  L152.142,103.142l28.285,28.284l74.857-74.858l76.857,76.858L360.427,105.142z" />
                                        </svg>

                                    </div>
                                    <h5 class="sm-title-block mt-15">Social Media Marketing</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="m497 151h-45v-105c0-8.284-6.716-15-15-15h-422c-8.284 0-15 6.716-15 15v270c0 8.284 6.716 15 15 15h196v60h-75c-8.284 0-15 6.716-15 15s6.716 15 15 15h166v45c0 8.284 6.716 15 15 15h180c8.284 0 15-6.716 15-15v-300c0-8.284-6.716-15-15-15zm-467-90h392v90h-105c-8.284 0-15 6.716-15 15v135h-272zm210.895 330v-60h61.105v60zm241.105 60h-150v-270h150z" />
                                                <path
                                                    d="m422 211h-30c-8.284 0-15 6.716-15 15s6.716 15 15 15h30c8.284 0 15-6.716 15-15s-6.716-15-15-15z" />
                                                <path
                                                    d="m422 391h-30c-8.284 0-15 6.716-15 15s6.716 15 15 15h30c8.284 0 15-6.716 15-15s-6.716-15-15-15z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <h5 class="sm-title-block mt-15">Influencer PR </h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 950.002 950.002"
                                            style="enable-background:new 0 0 950.002 950.002;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M949.869,741.307c-0.072-2.064-0.145-4.139-0.217-6.221c-0.075-2.082-0.152-4.17-0.229-6.268l-0.06-1.57l-0.03-0.787
			l-0.008-0.197l-0.02-1.76l-0.006-0.082l-0.025-0.326l-0.201-2.607c-0.271-3.479-0.542-6.973-0.813-10.467l-0.207-2.645
			l-0.312-3.43c-0.216-2.281-0.431-4.561-0.646-6.836c-0.223-2.271-0.447-4.539-0.669-6.799c-0.115-1.129-0.229-2.256-0.343-3.381
			c-0.138-1.041-0.276-2.08-0.414-3.119c-1.139-8.242-2.156-16.342-3.608-24.129c-0.686-3.896-1.319-7.727-2.031-11.461
			c-0.777-3.725-1.537-7.367-2.277-10.914c-1.402-7.098-3.163-13.727-4.647-19.855c-0.38-1.529-0.752-3.029-1.115-4.492
			c-0.404-1.457-0.8-2.877-1.185-4.264c-0.782-2.766-1.523-5.391-2.221-7.855c-0.71-2.461-1.336-4.771-1.99-6.889
			c-0.674-2.111-1.292-4.051-1.851-5.803c-0.829-2.574-1.528-4.742-2.079-6.455c-0.815-2.529-3.487-3.951-6.043-3.223
			l-160.613,45.771c-2.447,0.697-3.964,3.135-3.498,5.637c0.174,0.934,0.373,2.004,0.595,3.201c0.229,1.205,0.483,2.541,0.759,3.994
			c0.261,1.457,0.466,3.053,0.729,4.74c0.258,1.689,0.532,3.488,0.821,5.383c0.141,0.947,0.308,1.912,0.439,2.91
			c0.114,1,0.23,2.025,0.35,3.07c0.447,4.184,1.115,8.67,1.413,13.48c0.197,2.393,0.401,4.852,0.609,7.361
			c0.156,2.518,0.234,5.098,0.368,7.709c0.348,5.213,0.282,10.641,0.382,16.115l0.023,2.039l-0.072,1.805
			c-0.041,1.203-0.083,2.408-0.124,3.617c-0.032,1.203-0.065,2.41-0.098,3.619l-0.038,1.807l-0.11,2.602
			c-0.148,3.502-0.299,7.002-0.448,10.49l-0.111,2.613l-0.015,0.326l-0.003,0.08c0.002,0.393-0.03-3.111-0.02-1.598l-0.013,0.129
			l-0.048,0.516l-0.095,1.031c-0.124,1.373-0.248,2.738-0.371,4.102c-0.119,1.359-0.238,2.715-0.355,4.062
			c-0.16,1.342-0.319,2.678-0.479,4.004c-0.341,2.65-0.551,5.275-0.973,7.832c-0.37,2.559-0.734,5.072-1.09,7.535
			c-0.426,2.445-0.842,4.838-1.246,7.166c-0.366,2.33-0.856,4.574-1.292,6.746c-0.456,2.168-0.819,4.273-1.292,6.271
			c-0.461,1.998-0.903,3.91-1.324,5.73c-0.208,0.898-0.41,1.773-0.606,2.625c-0.202,0.73-0.397,1.438-0.588,2.125
			c-0.112,0.42-0.218,0.814-0.327,1.221H944.3c2.633,0,4.826-2.066,4.926-4.697c0.001-0.016,0.001-0.031,0.002-0.047
			c0.163-3.658,0.331-7.414,0.503-11.254c0.073-3.836,0.147-7.756,0.224-11.742c0.112-3.982-0.009-8.029-0.02-12.121
			C949.912,745.432,949.891,743.375,949.869,741.307z" />
                                                    <path d="M898.791,535.129c2.635-1.061,3.837-4.113,2.622-6.68c-0.54-1.141-1.171-2.475-1.886-3.984
			c-0.675-1.418-1.421-2.988-2.231-4.697c-1.049-2.137-2.183-4.447-3.396-6.916c-1.222-2.459-2.521-5.076-3.893-7.834
			c-0.695-1.434-1.378-2.617-2.093-3.963c-0.712-1.316-1.441-2.662-2.186-4.037c-1.497-2.744-3.028-5.613-4.671-8.551
			c-1.697-2.906-3.451-5.912-5.254-9.002c-0.904-1.541-1.821-3.104-2.749-4.684c-0.971-1.556-1.954-3.131-2.947-4.723
			c-1.997-3.171-4.038-6.412-6.112-9.706c-4.377-6.45-8.734-13.196-13.597-19.761c-1.194-1.653-2.395-3.312-3.598-4.976l-1.81-2.494
			l-1.884-2.453c-2.52-3.263-5.05-6.537-7.58-9.812c-2.575-3.237-5.239-6.406-7.85-9.587c-1.32-1.58-2.599-3.183-3.946-4.727
			c-1.351-1.539-2.697-3.074-4.04-4.603c-1.343-1.523-2.68-3.043-4.011-4.554c-1.323-1.517-2.657-3.008-4.033-4.45
			c-2.724-2.901-5.414-5.766-8.06-8.585c-2.65-2.81-5.394-5.451-8.005-8.091c-2.63-2.626-5.186-5.205-7.796-7.6
			c-2.581-2.416-5.093-4.766-7.521-7.04c-2.418-2.279-4.887-4.349-7.187-6.399c-2.319-2.028-4.542-3.971-6.656-5.819
			c-2.168-1.787-4.225-3.481-6.157-5.073c-1.934-1.586-3.743-3.07-5.416-4.442c-1.676-1.367-3.279-2.552-4.692-3.657
			c-2.058-1.579-3.796-2.913-5.177-3.973c-2.105-1.616-5.106-1.271-6.798,0.776l-86.204,104.346
			c-1.625,1.968-1.486,4.844,0.327,6.64c0.721,0.712,1.553,1.536,2.489,2.463c0.897,0.901,1.925,1.855,2.979,2.969
			c1.054,1.113,2.192,2.318,3.409,3.604c1.219,1.28,2.515,2.642,3.88,4.078c1.317,1.482,2.702,3.043,4.147,4.67
			c1.427,1.642,2.987,3.272,4.471,5.09c1.497,1.8,3.044,3.66,4.636,5.573c1.621,1.878,3.168,3.917,4.77,5.977
			c1.585,2.074,3.279,4.119,4.871,6.312c1.593,2.186,3.212,4.408,4.851,6.658c0.836,1.107,1.629,2.262,2.41,3.434
			c0.79,1.164,1.584,2.332,2.381,3.506c0.798,1.168,1.601,2.342,2.404,3.52c0.802,1.178,1.537,2.41,2.312,3.615
			c1.522,2.432,3.1,4.828,4.596,7.277c1.458,2.473,2.917,4.947,4.369,7.41l1.09,1.838l1.021,1.877
			c0.682,1.246,1.361,2.49,2.038,3.727c2.795,4.889,5.154,9.93,7.623,14.666c1.13,2.428,2.241,4.814,3.329,7.152
			c0.544,1.164,1.082,2.316,1.614,3.453c0.493,1.158,0.979,2.301,1.459,3.43c0.965,2.246,1.903,4.434,2.812,6.547
			c0.839,2.143,1.649,4.213,2.427,6.199c0.39,0.992,0.77,1.963,1.142,2.912c0.352,0.926,0.788,1.928,1.022,2.699
			c0.555,1.619,1.08,3.156,1.574,4.6c0.504,1.434,0.977,2.775,1.413,4.016c0.573,1.711,1.099,3.279,1.574,4.697
			c0.529,1.584,0.995,2.984,1.395,4.184c0.898,2.693,3.88,4.066,6.515,3.008L898.791,535.129z" />
                                                    <path d="M459.808,348.748c1.306,0.178,2.75,0.375,4.324,0.59c1.564,0.272,3.256,0.567,5.063,0.882
			c1.804,0.31,3.724,0.639,5.747,0.987c1.758,0.292,3.579,0.716,5.472,1.112l54.404-111.282c-2.697-0.421-5.372-0.839-7.993-1.248
			c-1.796-0.267-3.564-0.574-5.325-0.794c-1.761-0.213-3.501-0.424-5.218-0.632c-3.429-0.407-6.764-0.804-9.989-1.187
			c-3.234-0.277-6.359-0.545-9.358-0.802c-3-0.23-5.861-0.533-8.6-0.663c-2.734-0.134-5.328-0.262-7.765-0.382
			c-2.435-0.115-4.713-0.222-6.818-0.322c-2.107-0.034-4.043-0.065-5.792-0.093c-2.46-0.03-4.548-0.055-6.222-0.075
			c-2.655-0.032-4.852,2.043-4.979,4.695l-4.961,103.577c-0.122,2.552,1.719,4.774,4.25,5.121
			C457.126,348.38,458.383,348.553,459.808,348.748z" />
                                                    <path d="M606.027,405.781c1.462,1.063,2.848,2.071,4.15,3.02c1.304,0.934,2.525,1.808,3.654,2.617
			c0.489,0.336,1.296,0.948,1.955,1.438c0.679,0.507,1.326,0.99,1.939,1.448c1.339,0.999,2.521,1.881,3.533,2.636
			c2.276,1.698,5.506,1.124,7.065-1.25l71.03-108.196c1.56-2.374,0.803-5.567-1.661-6.98c-1.096-0.628-2.375-1.362-3.823-2.193
			c-0.665-0.382-1.365-0.783-2.101-1.205c-0.801-0.453-1.638-0.927-2.511-1.421c-2.021-1.114-4.207-2.317-6.542-3.604
			c-2.336-1.273-4.823-2.627-7.443-4.056c-2.497-1.251-5.121-2.566-7.86-3.939c-2.75-1.342-5.556-2.835-8.565-4.19
			c-2.995-1.372-6.091-2.791-9.273-4.25c-3.161-1.492-6.497-2.847-9.883-4.269c-3.4-1.392-6.821-2.914-10.394-4.257
			c-0.905-0.343-1.824-0.69-2.736-1.036l-30.642,132.998c1.694,1.064,3.29,2.192,4.862,3.21
			C602.611,403.515,604.361,404.676,606.027,405.781z" />
                                                    <path
                                                        d="M364.434,348.206c1.372-0.181,2.719-0.405,4.064-0.547c1.345-0.136,2.674-0.271,3.984-0.405
			c2.615-0.271,5.158-0.535,7.619-0.791c2.468-0.165,4.853-0.325,7.142-0.479c1.142-0.078,2.26-0.154,3.353-0.229
			c1.09-0.073,2.182-0.166,3.118-0.167c1.929-0.051,3.76-0.098,5.479-0.143c1.714-0.054,3.316-0.105,4.8-0.152
			c1.829-0.012,3.509-0.023,5.025-0.033c1.67-0.009,3.146-0.017,4.408-0.024c2.84-0.015,5.072-2.42,4.886-5.254l-6.394-97.57
			c-0.187-2.834-2.713-4.927-5.53-4.571c-1.253,0.158-2.716,0.343-4.373,0.552c-1.536,0.195-3.237,0.412-5.089,0.648
			c-2.188,0.325-4.554,0.675-7.083,1.05c-2.521,0.384-5.205,0.793-8.034,1.224c-1.448,0.204-2.781,0.475-4.18,0.739
			c-1.395,0.266-2.822,0.539-4.279,0.817c-2.909,0.562-5.938,1.148-9.076,1.754c-3.113,0.709-6.333,1.443-9.642,2.196
			c-1.651,0.379-3.325,0.764-5.019,1.154c-1.692,0.396-3.389,0.88-5.11,1.325c-3.435,0.915-6.942,1.85-10.51,2.8
			c-3.532,1.065-7.123,2.147-10.757,3.243c-1.812,0.561-3.643,1.09-5.463,1.689c-1.812,0.619-3.637,1.24-5.467,1.865
			c-1.827,0.626-3.661,1.254-5.5,1.885c-1.84,0.626-3.683,1.255-5.501,1.972c-3.645,1.391-7.304,2.788-10.963,4.185
			c-3.643,1.426-7.226,3.006-10.817,4.501c-1.79,0.763-3.585,1.499-5.354,2.282c-1.757,0.811-3.508,1.619-5.253,2.425
			c-1.741,0.806-3.476,1.61-5.201,2.409c-1.725,0.798-3.443,1.584-5.113,2.451c-3.352,1.692-6.663,3.364-9.919,5.008
			c-3.257,1.633-6.361,3.435-9.444,5.094c-3.069,1.69-6.087,3.302-8.934,5.039c-2.863,1.698-5.648,3.351-8.342,4.949
			c-2.702,1.576-5.208,3.278-7.664,4.816c-2.439,1.563-4.776,3.062-6.999,4.487c-2.175,1.493-4.239,2.909-6.178,4.24
			c-1.934,1.332-3.744,2.578-5.418,3.731c-1.672,1.153-3.151,2.296-4.514,3.284c-1.847,1.364-3.424,2.528-4.7,3.47
			c-2.131,1.573-2.631,4.544-1.141,6.735l40.515,59.566c1.442,2.12,4.261,2.785,6.494,1.524c1.029-0.58,2.245-1.267,3.632-2.049
			c1.209-0.669,2.517-1.459,3.994-2.228c1.476-0.77,3.072-1.6,4.777-2.488c1.7-0.889,3.51-1.835,5.417-2.832
			c1.94-0.93,3.979-1.908,6.107-2.928c2.138-0.996,4.307-2.137,6.646-3.132c2.321-1.019,4.721-2.072,7.189-3.155
			c2.443-1.125,5.031-2.108,7.649-3.158c2.632-1.02,5.268-2.174,8.029-3.149c2.749-0.991,5.545-1.998,8.374-3.018
			c1.403-0.533,2.847-0.984,4.294-1.446c1.444-0.465,2.896-0.932,4.353-1.401c1.454-0.47,2.914-0.942,4.378-1.416
			c1.472-0.447,2.965-0.847,4.448-1.275c2.979-0.824,5.938-1.738,8.938-2.504c3.002-0.743,6.004-1.486,8.994-2.225
			c1.484-0.395,2.99-0.704,4.489-1.013c1.496-0.315,2.988-0.629,4.475-0.942c1.482-0.315,2.959-0.628,4.429-0.94
			c1.473-0.294,2.954-0.521,4.415-0.784c2.922-0.507,5.808-1.009,8.648-1.501C358.885,348.973,361.688,348.585,364.434,348.206z" />
                                                    <path d="M88.175,425.22c-1.062,1.502-2.128,3.011-3.199,4.526c-1.068,1.514-2.14,3.034-3.216,4.559
			c-1.071,1.527-2.073,3.111-3.115,4.669c-2.054,3.137-4.156,6.25-6.168,9.422c-1.965,3.199-3.93,6.398-5.887,9.585l-1.46,2.386
			l-1.386,2.425c-0.921,1.612-1.839,3.221-2.754,4.822c-3.74,6.353-6.989,12.847-10.291,19.015
			c-1.537,3.145-3.049,6.238-4.529,9.266c-0.734,1.512-1.461,3.01-2.178,4.488c-0.675,1.498-1.341,2.979-1.999,4.441
			c-1.31,2.918-2.584,5.758-3.817,8.504c-1.15,2.781-2.262,5.467-3.329,8.045c-1.046,2.586-2.103,5.033-3.004,7.408
			c-0.889,2.377-1.733,4.633-2.527,6.752c-0.79,2.117-1.529,4.098-2.212,5.93c-0.631,1.85-1.21,3.549-1.734,5.084
			c-0.68,2.018-1.264,3.75-1.741,5.168c-0.845,2.506,0.44,5.225,2.91,6.172l37.71,14.457c2.4,0.92,5.103-0.154,6.212-2.473
			c0.55-1.148,1.207-2.523,1.962-4.102c0.626-1.301,1.318-2.742,2.073-4.311c0.802-1.547,1.669-3.217,2.596-5.004
			c0.924-1.781,1.906-3.68,2.942-5.68c1.044-1.994,2.246-4.039,3.439-6.199c1.208-2.148,2.467-4.387,3.77-6.705
			c1.373-2.273,2.792-4.625,4.252-7.043c0.727-1.207,1.464-2.43,2.21-3.668c0.785-1.215,1.58-2.443,2.383-3.688
			c1.606-2.48,3.247-5.012,4.916-7.59c3.546-5.02,7.014-10.307,10.933-15.406c0.957-1.289,1.918-2.582,2.882-3.879l1.445-1.947
			l1.514-1.904c2.016-2.539,4.04-5.086,6.064-7.633c2.061-2.516,4.2-4.967,6.279-7.439c1.054-1.227,2.066-2.479,3.145-3.672
			c1.08-1.191,2.156-2.379,3.228-3.562c1.07-1.182,2.135-2.359,3.195-3.531c1.05-1.178,2.11-2.335,3.211-3.444
			c2.166-2.243,4.306-4.459,6.411-6.64c2.101-2.177,4.294-4.197,6.364-6.239c2.086-2.027,4.104-4.027,6.182-5.86
			c2.044-1.86,4.032-3.669,5.956-5.42c1.908-1.761,3.874-3.333,5.69-4.911c1.828-1.557,3.58-3.049,5.246-4.468
			c1.636-1.295,3.188-2.523,4.646-3.679c1.45-1.154,2.807-2.235,4.062-3.235c0.576-0.476,1.356-1.046,2.015-1.547
			c0.676-0.511,1.321-0.997,1.933-1.458c1.333-1.007,2.51-1.895,3.518-2.655c2.267-1.711,2.618-4.973,0.774-7.133l-42.935-50.299
			c-1.844-2.16-5.121-2.325-7.166-0.355c-0.909,0.876-1.972,1.899-3.174,3.058c-0.552,0.531-1.134,1.092-1.744,1.679
			c-0.621,0.603-1.212,1.152-1.982,1.939c-1.472,1.485-3.063,3.092-4.764,4.808c-1.692,1.717-3.493,3.544-5.392,5.47
			c-1.765,1.912-3.621,3.922-5.557,6.019c-1.912,2.113-3.974,4.242-5.969,6.576c-2.003,2.322-4.073,4.723-6.202,7.19
			c-2.155,2.438-4.24,5.057-6.385,7.714c-2.129,2.671-4.373,5.336-6.514,8.16c-2.135,2.824-4.305,5.695-6.501,8.603
			C90.296,422.222,89.229,423.71,88.175,425.22z" />
                                                    <path d="M10.155,601.572c-0.251,1.236-0.545,2.684-0.878,4.32c-0.305,1.502-0.643,3.166-1.011,4.977
			c-0.361,1.852-0.714,4.039-1.108,6.271c-0.388,2.254-0.8,4.652-1.234,7.18c-0.21,1.26-0.45,2.562-0.649,3.875
			c-0.177,1.305-0.357,2.639-0.542,4c-0.704,5.453-1.631,11.32-2.165,17.588c-0.31,3.123-0.628,6.33-0.953,9.609
			c-0.268,3.283-0.447,6.645-0.678,10.053c-0.54,6.811-0.639,13.875-0.864,21.021L0,693.152l0.013,2.697
			c0.01,1.801,0.02,3.605,0.03,5.414c0.011,1.807,0.022,3.617,0.032,5.428l0.017,2.717l0.104,2.719
			c0.147,3.617,0.294,7.236,0.441,10.84l0.111,2.695l0.034,0.873l0.048,0.65l0.096,1.299c0.128,1.732,0.255,3.459,0.382,5.18
			c0.127,1.721,0.254,3.434,0.379,5.139c0.173,1.777,0.344,3.549,0.516,5.309c0.173,1.758,0.345,3.504,0.516,5.24
			c0.086,0.865,0.172,1.729,0.258,2.588c0.107,0.846,0.214,1.689,0.32,2.529c0.426,3.35,0.845,6.645,1.255,9.871
			c0.495,3.211,0.979,6.354,1.449,9.412c0.44,3.057,1.007,6.014,1.528,8.873c0.043,0.229,0.086,0.455,0.128,0.682
			c0.435,2.338,2.469,4.031,4.846,4.031h13.291c2.838,0,5.09-2.389,4.923-5.221c-0.045-0.756-0.091-1.52-0.142-2.291
			c-0.166-2.756-0.366-5.598-0.43-8.531c-0.096-2.928-0.194-5.936-0.295-9.01c-0.019-3.072-0.038-6.211-0.057-9.404
			c-0.005-0.797-0.01-1.598-0.015-2.4c0.017-0.791,0.035-1.586,0.053-2.385c0.035-1.592,0.07-3.197,0.106-4.812
			c0.035-1.611,0.071-3.234,0.107-4.865c0.08-1.707,0.159-3.424,0.24-5.146c0.08-1.723,0.161-3.453,0.241-5.188l0.061-1.303
			l0.03-0.652l0.004-0.082c0-0.207,0.004,0.191,0.006,0.123l0.012-0.158l0.025-0.314l0.202-2.523
			c0.268-3.365,0.537-6.74,0.807-10.117l0.206-2.527l0.291-2.521c0.194-1.678,0.387-3.354,0.58-5.027
			c0.192-1.672,0.384-3.34,0.575-5.002l0.285-2.488l0.369-2.471c1.012-6.57,1.872-13.033,3.132-19.221
			c0.591-3.1,1.12-6.15,1.727-9.119c0.661-2.957,1.307-5.85,1.936-8.666c1.164-5.641,2.673-10.885,3.901-15.746
			c0.315-1.213,0.623-2.402,0.924-3.562c0.318-1.143,0.661-2.225,0.977-3.297c0.637-2.133,1.242-4.156,1.81-6.059
			c0.581-1.918,1.058-3.633,1.614-5.354c0.583-1.756,1.117-3.365,1.601-4.82c0.526-1.586,0.991-2.986,1.389-4.186
			c0.895-2.693-0.668-5.58-3.412-6.311l-33.319-8.885C13.513,597.064,10.721,598.789,10.155,601.572z" />
                                                    <path
                                                        d="M387.317,774.27c10.84,5.299,22.323,7.811,33.628,7.811c28.378,0,55.65-15.811,68.953-43.023
			c2.562-5.238,4.545-11.021,5.835-16.467l77.577-336.717l29.544-128.233l18.303-79.437c2.13-9.245-5.224-15.543-12.602-15.543
			c-4.319,0-8.647,2.159-11.087,7.148l-37.245,76.183l-54.944,112.386L352.104,671.689
			C333.501,709.74,349.267,755.668,387.317,774.27z M423.789,665.836c20.759,0,37.588,16.828,37.588,37.588
			c0,20.758-16.829,37.588-37.588,37.588s-37.588-16.83-37.588-37.588C386.201,682.662,403.03,665.836,423.789,665.836z" />
                                                </g>
                                            </g>

                                        </svg>
                                    </div>
                                    <h5 class="sm-title-block mt-15">Influencer Buying</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <g>
                                                <path
                                                    d="M507.606,422.754l-86.508-86.508l42.427-42.426c3.676-3.676,5.187-8.993,3.992-14.053s-4.923-9.14-9.855-10.784   L203.104,184.13c-5.389-1.797-11.333-0.394-15.35,3.624c-4.018,4.018-5.421,9.96-3.624,15.35l84.853,254.559   c1.645,4.932,5.725,8.661,10.784,9.855c5.059,1.197,10.377-0.315,14.053-3.992l42.427-42.426l86.508,86.507   c2.929,2.929,6.768,4.394,10.606,4.394s7.678-1.464,10.606-4.394l63.64-63.64C513.465,438.109,513.465,428.612,507.606,422.754z    M433.36,475.787l-86.508-86.507c-5.857-5.858-15.356-5.858-21.213,0l-35.871,35.871l-67.691-203.073l203.073,67.691   l-35.871,35.871c-5.853,5.852-5.858,15.356,0,21.213l86.508,86.508L433.36,475.787z" />
                                                <path
                                                    d="M195,120c8.284,0,15-6.716,15-15V15c0-8.284-6.716-15-15-15s-15,6.716-15,15v90C180,113.284,186.716,120,195,120z" />
                                                <path
                                                    d="M78.327,57.114c-5.857-5.858-15.355-5.858-21.213,0c-5.858,5.858-5.858,15.355,0,21.213l63.64,63.64   c5.857,5.858,15.356,5.858,21.213,0c5.858-5.858,5.858-15.355,0-21.213L78.327,57.114z" />
                                                <path
                                                    d="M120.754,248.033l-63.64,63.64c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.858,15.356,5.858,21.213,0l63.64-63.64   c5.858-5.858,5.858-15.355,0-21.213C136.109,242.175,126.611,242.175,120.754,248.033z" />
                                                <path
                                                    d="M269.246,141.967l63.64-63.64c5.858-5.858,5.858-15.355,0-21.213c-5.857-5.858-15.355-5.858-21.213,0l-63.64,63.64   c-5.858,5.858-5.858,15.355,0,21.213C253.89,147.825,263.389,147.825,269.246,141.967z" />
                                                <path
                                                    d="M120,195c0-8.284-6.716-15-15-15H15c-8.284,0-15,6.716-15,15s6.716,15,15,15h90C113.284,210,120,203.284,120,195z" />
                                            </g>
                                        </svg>

                                    </div>
                                    <h5 class="sm-title-block mt-15">Special Projects</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="m493.264 411.668c12.082-12.083 18.736-28.147 18.736-45.235v-40.48c0-22.611-18.396-41.006-41.006-41.006h-36.893c-1.373 0-2.489-1.113-2.489-2.481l-.001-42.403h2.958c20.204 0 36.642-16.437 36.642-36.641v-72.639c0-20.204-16.438-36.641-36.642-36.641h-101.451c0-11.901 0-42.978 0-51.261 0-22.023-17.913-40.246-40.246-40.246h-252.626c-22.191-.001-40.246 18.053-40.246 40.245v203.519c0 22.191 18.055 40.246 40.246 40.246h252.627c22.191 0 40.245-18.054 40.245-40.246v-6.336h40.151l-.001 51.948h-4.163c-19.64 0-35.617 15.978-35.617 35.618 1.321 14.233-4.79 34.47 11.831 54.438l27.033 32.473c7.143 8.58 4.538 17.292 5.096 23.238-8.301 3.582-14.127 11.844-14.127 21.444v40.146c0 5.523 4.478 10 10 10h115.898c5.522 0 10-4.477 10-10v-40.148c0-10.111-6.463-18.738-15.473-21.975v-6.774c0-11.715 8.315-17.184 9.518-18.803zm-42.053-280.886v72.639c0 9.176-7.466 16.641-16.642 16.641h-2.967c-.363-14.92-12.074-27.384-27.194-28.39-16.545-1.131-30.74 11.846-31.13 28.39-38.143 0-38.821 0-63.638 0-9.176 0-16.641-7.465-16.641-16.641v-72.639c0-9.176 7.465-16.641 16.641-16.641h124.929c9.176 0 16.642 7.465 16.642 16.641zm-138.093 115.617c0 11.164-9.082 20.246-20.245 20.246h-252.627c-11.164 0-20.246-9.082-20.246-20.246v-162.516h14c5.522 0 10-4.477 10-10s-4.478-10-10-10h-14c.035-22.003-.079-21.267.105-23.071 1.039-10.196 9.675-18.178 20.141-18.178h252.627c11.177 0 20.245 9.099 20.245 20.246v21.003h-199.118c-5.522 0-10 4.477-10 10s4.478 10 10 10h199.118v10.258h-3.478c-20.204 0-36.641 16.437-36.641 36.641v72.639c0 20.204 16.437 36.641 36.641 36.641h3.478zm47.571 122.871c-4.645-5.579-7.202-12.65-7.202-19.91v-21.732c0-8.612 7.006-15.618 15.617-15.618h4.164v25.714c0 5.523 4.478 10 10 10s10-4.477 10-10c.001-84.411-.001-34.203.001-116.959 0-12.18 18.342-12.092 18.342-.003 0 15.853.001 46.165.001 61.704 0 12.396 10.089 22.481 22.489 22.481h36.893c11.583 0 21.006 9.423 21.006 21.006v40.48c0 21.768-14.712 32.468-15.83 34.043-15.053 15.053-12.034 32.98-12.424 35.399h-66.299c-.456-3.513 2.626-19.299-9.726-34.133zm118.53 120.096h-95.899v-30.146c0-1.844 1.5-3.344 3.345-3.344h89.209c1.845 0 3.345 1.5 3.345 3.344z" />
                                                <path
                                                    d="m255.545 152.154h-15.253v-15.253c0-5.523-4.478-10-10-10s-10 4.477-10 10v15.253h-15.253c-5.522 0-10 4.477-10 10s4.478 10 10 10h15.253v15.253c0 5.523 4.478 10 10 10s10-4.477 10-10v-15.253h15.253c5.522 0 10-4.477 10-10s-4.478-10-10-10z" />
                                                <path
                                                    d="m128.08 152.154h-15.254v-15.253c0-5.523-4.478-10-10-10s-10 4.477-10 10v15.253h-15.253c-5.522 0-10 4.477-10 10s4.478 10 10 10h15.253v15.253c0 5.523 4.478 10 10 10s10-4.477 10-10v-15.253h15.254c5.522 0 10-4.477 10-10s-4.477-10-10-10z" />
                                                <path
                                                    d="m272.333 52.91h16c5.522 0 10-4.477 10-10s-4.478-10-10-10h-16c-5.522 0-10 4.477-10 10s4.478 10 10 10z" />
                                                <path
                                                    d="m84.025 73.883c0-5.523-4.478-10-10-10h-.025c-5.522 0-9.987 4.477-9.987 10s4.49 10 10.013 10 9.999-4.477 9.999-10z" />
                                                <path
                                                    d="m352.975 177.102h9.131v9.13c0 5.523 4.478 10 10 10s10-4.477 10-10v-9.13h9.13c5.522 0 10-4.477 10-10s-4.478-10-10-10h-9.13v-9.13c0-5.523-4.478-10-10-10s-10 4.477-10 10v9.13h-9.131c-5.522 0-10 4.477-10 10s4.477 10 10 10z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <h5 class="sm-title-block mt-15">Parallax <br> Effects</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 384.97 384.97" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M12.03,120.303h360.909c6.641,0,12.03-5.39,12.03-12.03c0-6.641-5.39-12.03-12.03-12.03H12.03
			c-6.641,0-12.03,5.39-12.03,12.03C0,114.913,5.39,120.303,12.03,120.303z" />
                                                    <path d="M372.939,180.455H12.03c-6.641,0-12.03,5.39-12.03,12.03s5.39,12.03,12.03,12.03h360.909c6.641,0,12.03-5.39,12.03-12.03
			S379.58,180.455,372.939,180.455z" />
                                                    <path d="M372.939,264.667H132.333c-6.641,0-12.03,5.39-12.03,12.03c0,6.641,5.39,12.03,12.03,12.03h240.606
			c6.641,0,12.03-5.39,12.03-12.03C384.97,270.056,379.58,264.667,372.939,264.667z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <h5 class="sm-title-block mt-15">Работа с репутацией</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M467,61H45C20.218,61,0,81.196,0,106v300c0,24.72,20.128,45,45,45h422c24.72,0,45-20.128,45-45V106
			C512,81.28,491.872,61,467,61z M460.786,91L256.954,294.833L51.359,91H460.786z M30,399.788V112.069l144.479,143.24L30,399.788z
			 M51.213,421l144.57-144.57l50.657,50.222c5.864,5.814,15.327,5.795,21.167-0.046L317,277.213L460.787,421H51.213z M482,399.787
			L338.213,256L482,112.212V399.787z" />
                                                </g>
                                            </g>
                                        </svg>

                                    </div>
                                    <h5 class="sm-title-block mt-15">Прогноз эффективности</h5>
                                </li>

                                <li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 578.405 578.405" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M289.203,0C129.736,0,0,129.736,0,289.203C0,448.67,129.736,578.405,289.203,578.405
			c159.467,0,289.202-129.735,289.202-289.202C578.405,129.736,448.67,0,289.203,0z M28.56,289.202
			C28.56,145.48,145.481,28.56,289.203,28.56l0,0v521.286l0,0C145.485,549.846,28.56,432.925,28.56,289.202z" />
                                                </g>
                                            </g>
                                        </svg>

                                    </div>
                                    <h5 class="sm-title-block mt-15"> Продвинутый таргетинг
                                    </h5>
                                </li>

                                <!--<li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 333 333" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M323,31.5H10c-5.5,0-10,4.5-10,10s4.5,10,10,10h313c5.5,0,10-4.5,10-10S328.5,31.5,323,31.5z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M230,114.5H10c-5.5,0-10,4.5-10,10s4.5,10,10,10h220c5.5,0,10-4.5,10-10S235.5,114.5,230,114.5z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M323,198.5H10c-5.5,0-10,4.5-10,10s4.5,10,10,10h313c5.5,0,10-4.5,10-10S328.5,198.5,323,198.5z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M151,281.5H10c-5.5,0-10,4.5-10,10s4.5,10,10,10h141c5.5,0,10-4.5,10-10S156.5,281.5,151,281.5z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <h5 class="sm-title-block mt-15">Split Text <br>Animations</h5>
                                </li>-->

                                <!--<li
                                    class="feature-item background-section p-30 d-flex flex-column justify-content-center text-center">
                                    <div class="box-icon">
                                        <svg viewBox="0 0 74 74" xmlns="http://www.w3.org/2000/svg">
                                            <path d="m41.24 72h-2.97a1 1 0 0 1 0-2h2.97a1 1 0 1 1 0 2z" />
                                            <path
                                                d="m69 72h-20.76a1 1 0 0 1 0-2h20.76a1 1 0 0 0 1-1v-64a1 1 0 0 0 -1-1h-64a1 1 0 0 0 -1 1v64a1 1 0 0 0 1 1h16.37a1 1 0 1 1 0 2h-16.37a3 3 0 0 1 -3-3v-64a3 3 0 0 1 3-3h64a3 3 0 0 1 3 3v64a3 3 0 0 1 -3 3z" />
                                            <path d="m31.27 72h-2.9a1 1 0 0 1 0-2h2.9a1 1 0 1 1 0 2z" />
                                            <path
                                                d="m11.069 15.188a3.625 3.625 0 1 1 3.625-3.626 3.629 3.629 0 0 1 -3.625 3.626zm0-5.25a1.625 1.625 0 1 0 1.625 1.624 1.627 1.627 0 0 0 -1.625-1.624z" />
                                            <path
                                                d="m21.319 15.188a3.625 3.625 0 1 1 3.625-3.626 3.629 3.629 0 0 1 -3.625 3.626zm0-5.25a1.625 1.625 0 1 0 1.625 1.624 1.627 1.627 0 0 0 -1.625-1.624z" />
                                            <path
                                                d="m31.569 15.188a3.625 3.625 0 1 1 3.625-3.626 3.629 3.629 0 0 1 -3.625 3.626zm0-5.25a1.625 1.625 0 1 0 1.625 1.624 1.627 1.627 0 0 0 -1.625-1.624z" />
                                            <path d="m71 20h-68a1 1 0 0 1 0-2h68a1 1 0 0 1 0 2z" />
                                            <path
                                                d="m31.629 59a.983.983 0 0 1 -.388-.079 1 1 0 0 1 -.534-1.309l10.95-26a1 1 0 0 1 1.844.776l-10.95 26a1 1 0 0 1 -.922.612z" />
                                            <path
                                                d="m46.274 53.308a1 1 0 0 1 -.626-1.781l7.37-5.9-7.118-5.663a1 1 0 1 1 1.239-1.564l8.1 6.443a1 1 0 0 1 0 1.563l-8.339 6.683a1 1 0 0 1 -.626.219z" />
                                            <path
                                                d="m27.726 53.308a1 1 0 0 1 -.624-.219l-8.348-6.689a1 1 0 0 1 0-1.563l8.1-6.443a1 1 0 1 1 1.244 1.566l-7.123 5.662 7.37 5.9a1 1 0 0 1 -.626 1.781z" />
                                        </svg>
                                    </div>
                                    <h5 class="sm-title-block mt-15">Valid <br> HTML Code</h5>
                                </li>-->
                            </ul>
                        </div>
                    </section>

                    <div class="section-image section-move-image v-light section-padding p-relative" data-dsn-title="НАШИ КЛИЕНТЫ" id="clients_block">
                        <div class="image-container">
						
						
                        <div class="dsn-container d-flex flex-column">


                            <h2 class="section-title">Наши клиенты </h2>

                        </div>						
						
						
						
						
                            <div class="swiper-container ">
                                <div class="swiper-wrapper transform-move-section move-left">
                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-1.png" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-2.png" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-3.png" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-4.png" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="swiper-container ">
                                <div class="swiper-wrapper transform-move-section">
                                    <div class="swiper-slide ">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-5.png" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-6.png" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-7.png" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-8.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-container ">
                                <div class="swiper-wrapper transform-move-section move-left">
                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-9.png" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-10.png" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-11.png" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="image-item">
                                            <img src="/web/main/img/view1/section-12.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="end-features section-padding background-section" data-dsn-title="СТРАТЕГИЯ" id="strategy_block">
                        <div class="dsn-container">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <h2 class="heading-h2 mb-30">90% рекламодателей увеличивают свои продажи с помощью блогеров!</h2>
                                        <p>Присоединяйся, мы умеем подбирать блогеров</p>
                                        <button onclick="swa()" type="button"  class="link-custom v-light image-zoom mt-30" data-dsn="parallax">
                                            Стратегия продвижения
                                        </button>
										<p style="margin-top:20px;">БЕСПЛАТНО</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== Footer ========== -->
                <footer class="footer border-top background-section">
                    <div class="dsn-container">
                        <div class="d-grid grid-sm-2">
                            <div class="footer-item">
                                <a href="" class="logo-footer m-auto">
                                    <img src="/web/main/img/logo.png" alt="" class="logo-dark cover-bg-img">
                                    <img src="/web/main/img/logo-dark.png" alt="" class="logo-light cover-bg-img">
                                </a>
                            </div>

                            <div class="footer-item text-right">
                                <h5 class="sm-title-block mb-10">Мы в социальных сетях</h5>
                                <ul class="box-social">
                                    <li data-dsn="parallax">
                                        <a href="https://adsblogger.media/">
										<i class="fab fa-dribbble"></i>
										</a>
                                    </li>
                                    <li data-dsn="parallax">
                                        <a href="https://wa.me/79779683920?text=Здравствуйте,%20хочу%20получить%20БЕСПЛАТНУЮ%20стратегию%20продвижения%20через%20блоггеров!">
										<i class="fab fa-whatsapp"></i>
										</a>
                                    </li>

                                    <li data-dsn="parallax">
                                        <a href="https://t.me/yuryanischenko">
										<i class="fab fa-telegram-plane"></i>
										</a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="footer-bottom d-grid grid-md-2 border-top pt-30 mt-30">
                            <div class="footer-item order-md-2">
                                <div class="nav-footer text-right">
                                    <ul>

                                        <li class="d-inline-block over-hidden" style="margin-left: 20px;margin-right:0px;"><a class="link-hover" data-dsn="parallax"
                                                href="#about_block">О нас</a>
                                        </li>
										
                                        <li class="d-inline-block over-hidden" style="margin-left: 20px;margin-right:0px;"><a class="link-hover" data-dsn="parallax"
                                                href="#aims_block">Возможности</a>										
										
                                        <li class="d-inline-block over-hidden" style="margin-left: 20px;margin-right:0px;"><a class="link-hover" data-dsn="parallax"
                                                href="#stages_block">Этапы работы</a>
                                        </li>
                                        <li class="d-inline-block over-hidden" style="margin-left: 20px;margin-right:0px;"><a class="link-hover" data-dsn="parallax"
                                                href="#advantages_block">Преимущества</a>
                                        </li>
                                        <li class="d-inline-block over-hidden" style="margin-left: 20px;margin-right:0px;"><a class="link-hover" data-dsn="parallax"
                                                href="#clients_block">Наши клиенты</a>
                                        </li>
                                        <li class="d-inline-block over-hidden" style="margin-left: 20px;margin-right:0px;"><a class="link-hover" data-dsn="parallax"
                                                href="#strategy_block">Стратегия</a>
                                        </li>										
                                        <li class="d-inline-block over-hidden" style="margin-left: 20px;margin-right:0px;"><a class="link-hover" data-dsn="parallax"
                                                href="https://adsblogger.media/login" target="_blank">Вход</a>
                                        </li>										
										
										
										
                                    </ul>
                                </div>
                            </div>



                            <div class="footer-item">
                                <div class="copyright">
                                    <div class="copright-text over-hidden">© 2022 ООО АДСБЛОГГЕР
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- ========== End Footer ========== -->
            </div>
        </div>

    </main>

    <!-- ========== Cursor Page ========== -->
    <div class="cursor">

        <div class="cursor-helper">
            <span class="cursor-drag">Drag</span>
            <span class="cursor-view">View</span>
            <span class="cursor-open"><i class="fas fa-plus"></i></span>
            <span class="cursor-close">Close</span>
            <span class="cursor-play">play</span>
            <span class="cursor-next"><i class="fas fa-chevron-right"></i></span>
            <span class="cursor-prev"><i class="fas fa-chevron-left"></i></span>
        </div>

    </div>
    <!-- ========== End Cursor Page ========== -->


    <!-- ========== social network ========== -->
    <div class="social-network">
        <ul class="socials d-flex  flex-column ">
            <li>
                <a href="https://adsblogger.media/" target="_blank">
                    <i class="fab fa-dribbble"></i>
                    <span>Adsblogger.media</span>
                </a>
            </li>

            <li>
                <a href="https://wa.me/79779683920?text=Здравствуйте,%20хочу%20получить%20БЕСПЛАТНУЮ%20стратегию%20продвижения%20через%20блоггеров!" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
            </li>
            <li>
                <a href="https://t.me/yuryanischenko" target="_blank">
                    <i class="fab fa-telegram-plane"></i>
                    <span>Telegram</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- ========== End social network ========== -->

    <!-- ========== Scroll Right Page To Top Page ========== -->
    <div class="scroll-to-top">
        <img src="/web/main/img/scroll_top.svg" alt="">
        <div class="box-number v-middle">
            <span>0%</span>
        </div>
    </div>
    <!-- ========== End Scroll Right Page To Top Page ========== -->

    <!-- ========== paginate-right-page ========== -->
    <div class="dsn-paginate-right-page"></div>






<div id="overlay">
  <div class="popup">
    <button class="close" title="Закрыть окно" onclick="swa2()"></button>


                            <div class="col-lg-8 col-md-6 all_over">
                                <div class="form-box d-flex flex-column">
                                    <h4 class="title-block p-relative mb-30 text-uppercase border-section-bottom grany">ОСТАВЬТЕ ЗАЯВКУ НА БЕСПЛАТНУЮ<br> СТРАТЕГИЮ ПРОДВИЖЕНИЯ</h4>
                                    <form class="form w-100" method="post" action="/web/main/mail_popup.php"
                                        data-toggle="validator">
                                        <div class="messages"></div>
                                        <div class="input__wrap controls">
                                            <div class="form-group citizen">
                                                <div class="entry-box">
                                                    <!--<label>Как Вас зовут? *</label>-->
                                                    <input id="form_name" type="text" name="name"
                                                        placeholder="Как вас зовут? *" required="required"
                                                        data-error="Введите ваше имя">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="form-group citizen">
                                                <div class="entry-box">
                                                    <!--<label>Ваш E-Mail *</label>-->
                                                    <input id="form_email" type="email" name="email"
                                                        placeholder="Ваш E-mail *" required="required"
                                                        data-error="Введите вашу почту">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
											
                                            <div class="form-group citizen">
                                                <div class="entry-box">
												
<script>
$(function(){
  $("#form_phone").mask("+7 (999) 999-99-99");
});
</script>												
												
                                                    <!--<label>Ваш Телефон *</label>-->
                                                    <input id="form_phone" type="tel" name="phone"
                                                        placeholder="Ваш номер телефона *" required="required"
                                                        data-error="Введите ваш номер телефона">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>	

                                            <div class="form-group citizen">
                                                <div class="entry-box">
                                                    <!--<label>Ваш Telegram</label>-->
                                                    <input id="form_telegram" type="text" name="telegram"
                                                        placeholder="Ваш логин в Telegram"
                                                        data-error="Введите ваш логин в Telegram">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>	
											



                                            <div class="text-right">
                                                <div class="image-zoom w-auto d-inline-block move-circle"
                                                    data-dsn="parallax">
                                                    <input type="submit" value="Отправить заявку" class="v-light">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



  </div>
</div>


<script>
var b = document.getElementById('overlay');
function swa(){
	b.style.visibility = 'visible';
	b.style.opacity = '1';
	b.style.transition = 'all 0.7s ease-out 0s';
}
function swa2(){
	b.style.visibility = 'hidden';
	b.style.opacity = '0';
}
window.onclick = function(event) {
if (event.target == overlay) {
	b.style.visibility = 'hidden';
	b.style.opacity = '0';
}
}
</script>