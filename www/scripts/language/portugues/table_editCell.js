function loadText()
    {
    
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Auto-ajustar";
    txtLang[1].innerHTML = "Propriedades";
    txtLang[2].innerHTML = "Estilo";
    txtLang[3].innerHTML = "Largura";
    txtLang[4].innerHTML = "Auto-ajustar ao conte&uacute;do";
    txtLang[5].innerHTML = "Largura fixa da c&eacute;lula";
    txtLang[6].innerHTML = "Altura";
    txtLang[7].innerHTML = "Auto-ajustar ao conte&uacute;do";
    txtLang[8].innerHTML = "Altura fixa da c&eacute;lula";
    txtLang[9].innerHTML = "Alinhamento do Texto";
    txtLang[10].innerHTML = "Espa&ccedil;o Interno";
    txtLang[11].innerHTML = "Esquerda";
    txtLang[12].innerHTML = "Direita";
    txtLang[13].innerHTML = "Superior";
    txtLang[14].innerHTML = "Inferior";
    txtLang[15].innerHTML = "Espa&ccedil;o em Branco";
    txtLang[16].innerHTML = "Fundo";
    txtLang[17].innerHTML = "Pr&eacute;-visualizar";
    txtLang[18].innerHTML = "Texto CSS";
    txtLang[19].innerHTML = "Aplicar para";

    document.getElementById("btnPick").value = "Escolher";
    document.getElementById("btnImage").value = "Imagem";
    document.getElementById("btnText").value = "Formata&ccedil;&atilde;o do Texto";
    document.getElementById("btnBorder").value = "Estilo da Borda";

    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    
    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "pixels"
    optLang[1].text = "porcento"
    optLang[2].text = "pixels"
    optLang[3].text = "porcento"
    optLang[4].text = "N&atilde;o selecionado"
    optLang[5].text = "Superior"
    optLang[6].text = "Meio"
    optLang[7].text = "Superior"
    optLang[8].text = "Linha Base"
    optLang[9].text = "Inferior"
    optLang[10].text = "Superior"
    optLang[11].text = "Topo do texto"
    optLang[12].text = "Base do texto"
    optLang[13].text = "N&atilde;o selecionado"
    optLang[14].text = "Esquerda"
    optLang[15].text = "Centralizado"
    optLang[16].text = "Direita"
    optLang[17].text = "Justificado"
    optLang[18].text = "N&atilde;o selecionado"
    optLang[19].text = "Sem quebra"
    optLang[20].text = "pre"
    optLang[21].text = "Normal"
    optLang[22].text = "C&eacute;lula Atual"
    optLang[23].text = "Linha Atual"
    optLang[24].text = "Coluna Atual"
    }
function getText(s)
    {
    switch(s)
        {
        case "Custom Colors": return "Cores Customizadas";
        case "More Colors...": return "Mais Cores...";
        default: return "";
        }
    }    
function writeTitle()
    {
    document.write("<title>Propriedades da C&eacute;lula</title>")
    }