<div class="main" id="mainline3">
    <hr class="clear">
    <div id="pagetitle">
        Регистрация
    </div>
    <div id="errorsDiv">

    </div>
    <div class="regformdiv">
        <form method="post" id="regForm">
            <label class="lcontent">
                Име:
            </label>
            <input type="text" name="firstname"  pattern="[\u0400-\u04ff]+$" maxlength="20" class="rcontent" autofocus>

            <br class="clear">
            <label class="lcontent">
                Фамилия:
            </label>
            <input type="text" name="lastname" pattern="[\u0400-\u04ff]+$" maxlength="20" class="rcontent">
            <br class="clear">
            <label class="lcontent">
                Телефонен номер:
            </label>
            <input type="text" name="number" pattern="\d{5,15}$" class="rcontent">
            <br class="clear">
            <label class="lcontent">
                E-mail:
            </label>
            <input type="email" name="mail" maxlength="30" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" class="rcontent">
            <br class="clear">
            <label class="lcontent">
                Потребителско име:
            </label>
            <input type="text" name="username" maxlength="20" class="rcontent">
            <br class="clear">
            <label class="lcontent">
                Парола:
            </label>
            <input type="password" name="pass" class="rcontent">
            <br class="clear">
            <div id="regbutton">
                <input type="button" value="Регистрация" class="regbtn" >
            </div>
        </form>
    </div>
    <hr>
</div>