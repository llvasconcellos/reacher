function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Numerada";
    txtLang[1].innerHTML = "Marcadores";
    txtLang[2].innerHTML = "Numero de In&iacute;cio";
    txtLang[3].innerHTML = "Margem Esquerda";
    txtLang[4].innerHTML = "Utilizando Imagem - url"
    txtLang[5].innerHTML = "Margem Esquerda";
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";   
    }
function getText(s)
    {
    switch(s)
        {
        case "Please select a list.":return "Favor selecionar uma lista.";
        default:return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Formata&ccedil;&atilde;o de Lista</title>")
    }
