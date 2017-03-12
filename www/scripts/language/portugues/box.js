function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Cor";
    txtLang[1].innerHTML = "Sombreamento";   
    
    txtLang[2].innerHTML = "Margem";
    txtLang[3].innerHTML = "Esquerda";
    txtLang[4].innerHTML = "Direita";
    txtLang[5].innerHTML = "Superior";
    txtLang[6].innerHTML = "Inferior";
    
    txtLang[7].innerHTML = "Espa&ccedil;amento Interno";
    txtLang[8].innerHTML = "Esquerda";
    txtLang[9].innerHTML = "Direita";
    txtLang[10].innerHTML = "Superior";
    txtLang[11].innerHTML = "Inferior";
    
    txtLang[12].innerHTML = "Dimens&atilde;o";
    txtLang[13].innerHTML = "Largura";
    txtLang[14].innerHTML = "Altura";
    
    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "pixels";
    optLang[1].text = "porcento";
    optLang[2].text = "pixels";
    optLang[3].text = "porcento";
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function getText(s)
    {
    switch(s)
        {
        case "No Border": return "Sem Borda";
        case "Outside Border": return "Borda Externa";
        case "Left Border": return "Borda Esquerda";
        case "Top Border": return "Borda Superior";
        case "Right Border": return "Borda Direita";
        case "Bottom Border": return "Borda Inferior";
        case "Pick": return "Escolher";
        case "Custom Colors": return "Cores Customizadas";
        case "More Colors...": return "Mais Cores...";
        default: return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Formata&ccedil;&atilde;o de Caixa</title>")
    }