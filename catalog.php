<?php
include_once("./components/header.php")
?>
<title>Арт-интерьер - Галерея</title>
<h1 class="catalog_heading">Наша галерея</h1>
<main class="main_catalog">
    <?php
    $result = $link->query("SELECT `name` ,`src` ,`discription` FROM catalog ORDER BY `time` ASC");
    for ($data = []; $row = $result->fetch_assoc(); $data[] = $row);
    foreach ($data as $elem) {
        echo
        '<article class="main_catalog_item">
                <img class="main_catalog_item__image" src="' . $elem['src'] . '" alt="">
                <div class="main_catalog_item__discription discription">
                    <h4 class="discription_name">' . $elem['name'] . '</h4>
                    <p class="discription_text">' . $elem['discription'] . '</p>
                </div>
            </article>';
    }
    ?>
</main>
<script>
    window.onload = () => {
        maxHeight = 0;
        windowWidth = window.innerWidth;
        $(".main_catalog_item").each((i, item) => {
            if (windowWidth > 1024)
                rand = Math.floor(Math.random() * (500 - 250 - 0 + 1) + 250)
            else {
                rand = Math.floor(Math.random() * (300 - 200 - 0 + 1) + 250)

            }
            $(item).css({
                "height": rand + "px"
            })
            maxHeight += rand;
            console.log(maxHeight);
        })
        if (windowWidth > 1024)
            $(".main_catalog").css({
                "height": (maxHeight / 4) + 250 + "px"
            });
        else {
            $(".main_catalog").css({
                "height": (maxHeight / 2) + 100 + "px"
            });
        }
    }
</script>
<?php
include_once("./components/footer.php")
?>