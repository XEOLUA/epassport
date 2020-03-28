<?
session_start();
?>
<head>
    <title>Калькулятор індекс ваги тіла (індекс Кетле)</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="css/mobil.css"  type="text/css">
</head>
<script type='text/javascript'>
    function calc()
    {
        var m,w,r;
        m=f.weight.value;
        h=f.height.value;
        h=h*h;
        r=m/(0.0001*h);
        document.getElementById("result").innerText=r.toFixed(1);
    }
    function copyToClipboard(elementId) {

        // Create a "hidden" input
        var aux = document.createElement("input");

        // Assign it the value of the specified element
        aux.setAttribute("value", document.getElementById(elementId).innerHTML);

        // Append it to the body
        document.body.appendChild(aux);

        // Highlight its content
        aux.select();

        // Copy the highlighted text
        document.execCommand("copy");

        // Remove it from the body
        document.body.removeChild(aux);

    }
</script>

<body>
<form name=f>
    <span style='float:right'><button style='margin-right:70px' class='mob newbut' onClick=window.close();>Закрити</button></span>
    <div class=calc>
        <div style='font-size:20px;margin-left:25px;margin-top:20px;'>Моя вага
            <input type=text id="weight"> кг.
        </div>
        <hr style='margin-left:25px;width:260px;' size=2 color=red>
        <div style='font-size:20px;margin-left:25px;margin-bottom:20px;'>Мій ріст
            <input type=text id="height"> см.
        </div>
</form>
<span  class="newbut1" onclick="calc()">Розрахувати</span>
<div style='font-size:20px;margin-left:25px; padding:20px;'>
    Результат:
    <div style='font-size:20px;margin-left:25px; padding:20px;' id="result">...</div>
</div>
<span class=newbut1 id="button1" onclick="copyToClipboard('result')">Копіювати результат</span>
</div>
<img src="images/imt.png">
</body>
