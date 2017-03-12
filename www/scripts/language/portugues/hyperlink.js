function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "URL";
    txtLang[1].innerHTML = "Bookmark";
    txtLang[2].innerHTML = "Alvo";
    txtLang[3].innerHTML = "T&iacute;tulo";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Pr&oacute;pria"
    optLang[1].text = "Em Branco"
    optLang[2].text = "Pai"
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Hyperlink</title>")
    }