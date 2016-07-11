<div class="main" id="mainline3">
    <hr class="clear">
    <div id="options">
        <label id="loptions">- ОПЦИИ -</label>
        <form id="formoptions" >
            <input type="hidden" value="all" name="color" id="colorInput">
        </form>
        <hr>
        <div class="option">
            <input type="radio" name="products" value="all" checked  form="formoptions"> 
            <label class="lradiobtn">Всички</label><br>
            <input type="radio" name="products" value="news"  form="formoptions"> 
            <label class="lradiobtn">НОВО</label>
        </div>
        <hr>
        <div class="option">
            <label class="loption ">Подреди по :</label>
            <select name="order" form="formoptions">
                <option value="nameasc" > Наименование (А-Я) </option>
                <option value="namedesc"> Наименование (Я-А) </option>
                <option value="priceasc"> Цена възходящо </option>
                <option value="pricedesc"> Цена низходящо </option>
            </select>
        </div>
        <hr>
        <div class="option">
            <label class="loption">Категория :</label><br>
            <input type="checkbox" name="bijou[]" value="necklace"  form="formoptions"> 
            <label class="category">Колиета</label><br>                    
            <input type="checkbox" name="bijou[]" value="bracelet" form="formoptions"> 
            <label class="category">Гривни</label><br>     
            <input type="checkbox" name="bijou[]" value="earring" form="formoptions"> 
            <label class="category">Обеци</label><br>     
            <input type="checkbox" name="bijou[]" value="ring"  form="formoptions"> 
            <label class="category">Пръстени</label><br>     
            <input type="checkbox" name="bijou[]" value="parure"  form="formoptions"> 
            <label class="category">Комплекти</label><br>     

        </div>
        <hr>
        <div class="option">
            <label class="loption">Тип сплав :</label><br>
            <input type="checkbox" name="metal[]" value="silver"  form="formoptions"> 
            <label class="metal">Сребро</label><br> 
            <input type="checkbox" name="metal[]" value="gold"  form="formoptions"> 
            <label class="metal">Злато</label><br> 
        </div>
        <hr>
        <div class="option">
            <label class="loption">Цвят на камъка :</label><br>
            <div class="color" id="red" > <span class="tooltiptext" >Червен</span>
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
        <hr>
    </div>
    <div id="results">
    </div>
    <hr class="clear">
</div>