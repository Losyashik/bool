<?php
include_once("./components/header.php")
?>
<title>Арт-интерьер</title>
<header class="header">
    <img src="./images/logo.png" class="header_logo" />
    <h2 class="header_slogan">Студия дизайна интерьера для вас</h2>

</header>
<main class="main">
    <section class="gallery section section_dark" id="gallery">
        <h1 class="heading gallery_heading">Галерея</h1>
        <div class="gallery_works__body">
            <?php

            $result = $link->query("SELECT `name` ,`src` ,`discription` FROM catalog ORDER BY `time` ASC LIMIT 10;");
            for ($data = []; $row = $result->fetch_assoc(); $data[] = $row);
            foreach ($data as $key => $elem) {
                echo
                '<article class="gallery_works__item art' . ($key + 1) . '">
                        <img src="' . $elem['src'] . '" alt="" class="gallery_works__description">
                        <div class="discription gallery_works__item_discription">
                            <h4>' . $elem['name'] . '</h4>
                            <p>' . $elem['discription'] . '</p>
                        </div>
                    </article>';
            }
            ?>
        </div>
        <a href="catalog.php" class="link gallery_all__link">Посмотреть все наши работы</a>
    </section>
    <section class=" section section_light how_we_work" id="how_we_work">
        <h1 class="heading how_we_work-heading">Как мы работаем</h1>
        <div class="how_we_work__body">
            <div class="how_we_work__item ">
                <div class="item_block">Вы оставляете заявку</div>
                <div class="item_block item_block--right">
                    -Мы созваниваемся<br />
                    -Проводим консультация, оформление технического задания на проектирование
                </div>
            </div>
            <div class="how_we_work__item">
                <div class="item_block">Проектирование пространства</div>
                <div class="item_block item_block--right">
                    -Созданём планировочное решения с расстановкой мебели (2-3 варианта)<br />
                    -Проводим анализ стилевого решения пространства (подбор возможных вариантов интерьера)
                </div>
            </div>
            <div class="how_we_work__item">
                <div class="item_block">Визуализация</div>
                <div class="item_block item_block--right">
                    -Фотореалистичная визуализация каждого помещения<br />
                    -Согласование эскизов с заказчиком
                </div>
            </div>
            <div class="how_we_work__item">
                <div class="item_block">Комплектация</div>
                <div class="item_block item_block--right">
                    -Подбор мебели, отделочных материалов и оборудования<br />
                    -Выезд дизайнера вместе с вами на подборы<br />
                    -Подготовка КП от партнеров поставщиков
                </div>
            </div>
        </div>
    </section>
    <section class="comments section section_dark" id="comments">
        <h1 class="heading comments_heading">Отзывы</h1>
        <div class="comments_body slider">
            <?php
            $result = $link->query("SELECT `name` ,`text` FROM comments WHERE approval = '1' ORDER BY `time` ASC");
            for ($data = []; $row = $result->fetch_assoc(); $data[] = $row);
            $len = count($data);
            foreach ($data as $key => $elem) {
                if (($key % 4) == 0) {
                    $result = '<div class="comments_slide">';
                }
                $result .= '
                <div class="comments__item">
                    <h4 class="comments__item__name">' . $elem['name'] . '</h4>
                    <p class="comments__item__text">
                        ' . $elem['text'] . '
                    </p>
                </div>';
                if ((($key + 1) % 4) == 0 or $len == ($key + 1)) {
                    $result .= '</div>';
                    echo $result;
                }
            }
            ?>

            <div class="comments_slide_add">
                <form class="comments_add_form" method="post">
                    <h4 class="comments_add_form__heading">Оставить отзыв</h4>
                    <div class="comments_add_form__body">
                        <input required type="text" name="name" placeholder="Ваше имя">
                        <input required type="email" name="mail" placeholder="E-mail">
                        <textarea required name="text" maxlength="400" placeholder="Текст коментария"></textarea>
                    </div>
                    <button type="submit" name="comment" value="1">Отправить</button>
                </form>
            </div>
        </div>
    </section>
    <section class=" section section_light application_form" id="application_form">
        <div class="application_form__image">
            <img src="./images/form.jpg" alt="">
        </div>
        <form method="post" class="application_form__body">
            <h1 class="heading application_form__heading">Оставить заявку</h1>
            <div class="application_form__form_body">
                <input type="email" placeholder="e-mail" name="mail" id="">
                <input type="text" placeholder="ФИО" name="name" id="">
                <textarea name="addres" placeholder="Адрес" id=""></textarea>
            </div>
            <div class="application_form__error_block"></div>
            <label><input type="checkbox" name="" id="">Даю свое согласие на обработку персональных данных</label>
            <button type="submit" name="application">Отправить заявку</button>
        </form>
    </section>
</main>
<?php
include_once("./components/footer.php")
?>