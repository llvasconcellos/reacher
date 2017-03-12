function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "URL";
    txtLang[1].innerHTML = "Titulo";
    txtLang[2].innerHTML = "Espa&ccedil;amento";
    txtLang[3].innerHTML = "Alinhamento";
    txtLang[4].innerHTML = "Superior";
    txtLang[5].innerHTML = "Borda";
    txtLang[6].innerHTML = "Inferior";
    txtLang[7].innerHTML = "Largura";
    txtLang[8].innerHTML = "Esquerda";
    txtLang[9].innerHTML = "Altura";
    txtLang[10].innerHTML = "Direita";
    
    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "absBottom";
    optLang[1].text = "absMiddle";
    optLang[2].text = "baseline";
    optLang[3].text = "bottom";
    optLang[4].text = "left";
    optLang[5].text = "middle";
    optLang[6].text = "right";
    optLang[7].text = "textTop";
    optLang[8].text = "top";
 
    document.getElementById("btnBorder").value = " Estilo da Borda ";
    document.getElementById("btnReset").value = "Reset"
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Imagem</title>")
    }