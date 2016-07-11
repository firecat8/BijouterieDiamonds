<div class="main" id="mainline3">
    <hr class="clear">
    <header>
        <div id="pagetitle">
            Добави продукт
            <?php
            if (isset($_SESSION['isADD']) && $_SESSION['isADD'] === TRUE) {
                echo '<label id="msg">(Добавен успешно!)</label>';
                $_SESSION['isADD'] = FALSE;
            }
            ?>
        </div>
    </header>
    <div class="regformdiv">
        <form method="post" enctype="multipart/form-data" action="add_product.php" id="addform">
            <input type="hidden" value="red" id="colorInput" name="color">
            <label class="lcontent"> Име: </label>
            <input type="text" maxlength="20" class="rcontent" name="nameproduct">
            <br class="clear">
            <label class="lcontent"> Цена: </label>
            <input type="text" maxlength="10" class="rcontent" name="priceproduct">
            <br class="clear">
            <label class="lcontent">Тип бижу:</label>
            <select class="rcontent" name="bijou">
                <option value="necklace"> Колиета </option>
                <option value="bracelet"> Гривни</option>
                <option value="earring"> Обеци</option>
                <option value="ring"> Пръстени </option>
                <option value="parure"> Комплекти </option>
            </select>
            <br class="clear">
            <label class="lcontent">Тип сплав:</label>
            <select class="rcontent" name="metal">
                <option value="silver"> Сребро </option>
                <option value="gold"> Злато</option>
            </select>
            <br class="clear">
            <label class="lcontent"> Снимка: </label>
            <input type="file" class="rcontent" name="picture">
            <br class="clear">
            <label class="lcontent"> Цвят на камъка: </label>
            <div class="rcontent">                        
                <div class="color selected" id="red" > <span class="tooltiptext" >Червен</span>
                </div>
                <div class="color" id="orange" >   <span class="tooltiptext">Оранжев</span>
                </div>
                <div class="color" id="yellow" > <span class="tooltiptext">Жълт</span>
                </div>
                <div class="color" id="green" > <span class="tooltiptext">Зелен</span>
                </div>
                <div class="color" id="aqua" >  <span class="tooltiptext">Аква</span>
                </div>
                <div class="color" id="blue" >  <span class="tooltiptext">Син</span>
                </div>
                <div class="color" id="lila" > <span class="tooltiptext">Лилав</span>
                </div>
                <div class="color" id="pink" > <span class="tooltiptext">Розов</span>
                </div>
                <div class="color" id="white"> <span class="tooltiptext">Бял</span>
                </div>
                <div class="color" id="grey" > <span class="tooltiptext">Сив</span>
                </div>
                <div class="color" id="black" > <span class="tooltiptext">Черен</span>
                </div>
                <div class="color" id="brown" > <span class="tooltiptext">Кафяв</span>
                </div>
            </div>
            <br class="clear">
            <div id="regbutton">
                <input type="submit" value="Добави" class="subbtn" >
            </div>
        </form>
    </div>
    <hr>
</div>