function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Alinhamento";
    txtLang[1].innerHTML = "Identa&ccedil;&atilde;o";
    txtLang[2].innerHTML = "Espa&ccedil;amento entre Palavras";
    txtLang[3].innerHTML = "Espa&ccedil;amento entre Caract&eacute;res";
    txtLang[4].innerHTML = "Altura de Linha";
    txtLang[5].innerHTML = "Mai&uacute;sculas";
    txtLang[6].innerHTML = "Espa&ccedil;o em Branco";
    
    document.getElementById("divPreview").innerHTML = "Lorem ipsum dolor sit amet, " +
        "consetetur sadipscing elitr, " +
        "sed diam nonumy eirmod tempor invidunt ut labore et " +
        "dolore magna aliquyam erat, " +
        "sed diam voluptua. At vero eos et accusam et justo " +
        "duo dolores et ea rebum. Stet clita kasd gubergren, " +
        "no sea takimata sanctus est Lorem ipsum dolor sit amet.";
    
    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "N&atilde;o Selecionado";
    optLang[1].text = "Esquerda";
    optLang[2].text = "Direita";
    optLang[3].text = "Centralizado";
    optLang[4].text = "Justificado";
    optLang[5].text = "N&atilde;o Selecionado";
    optLang[6].text = "Capitalizar";
    optLang[7].text = "Todas Mai&uacute;sculas";
    optLang[8].text = "Todas Min&iacute;sculas";
    optLang[9].text = "Nenhum";
    optLang[10].text = "N&atilde;o Selecionado";
    optLang[11].text = "Sem Quebra";
    optLang[12].text = "pre";
    optLang[13].text = "Normal";
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";   
    }
function writeTitle()
    {
    document.write("<title>Formata&ccedil;&atilde;o de Par&aacute;grafo</title>")
    }
