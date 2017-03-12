function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "URL";
    txtLang[1].innerHTML = "Repetir";
    txtLang[2].innerHTML = "Alinhamento Horizontal";
    txtLang[3].innerHTML = "Alinhamento Vertical";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Repetir"
    optLang[1].text = "N&atilde;o Repetir"
    optLang[2].text = "Repetir Horizontalmente"
    optLang[3].text = "Repetir Verticalmente"
    optLang[4].text = "Esquerda"
    optLang[5].text = "Centralizado"
    optLang[6].text = "Direita"
    optLang[7].text = "pixels"
    optLang[8].text = "porcento"
    optLang[9].text = "Superior"
    optLang[10].text = "Centro"
    optLang[11].text = "Inferior"
    optLang[12].text = "pixels"
    optLang[13].text = "porcento"
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Imagem de Fundo</title>")
    }

