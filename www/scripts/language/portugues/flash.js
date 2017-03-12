function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Fonte";
    txtLang[1].innerHTML = "Fundo";
    txtLang[2].innerHTML = "Largura";
    txtLang[3].innerHTML = "Altura";    
    txtLang[4].innerHTML = "Qualidade";   
    txtLang[5].innerHTML = "Alinhamento";
    txtLang[6].innerHTML = "Loop";
    txtLang[7].innerHTML = "Sim";
    txtLang[8].innerHTML = "N&atilde;o";
    
    txtLang[9].innerHTML = "Class ID";
    txtLang[10].innerHTML = "CodeBase";
    txtLang[11].innerHTML = "PluginsPage";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Baixo"
    optLang[1].text = "Alto"
    optLang[2].text = "<N&atilde;o Configurado>"
    optLang[3].text = "Esquerda"
    optLang[4].text = "Direita"
    optLang[5].text = "Superior"
    optLang[6].text = "Inferior"
    
    document.getElementById("btnPick").value = "Escolher";
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnOk").value = " OK ";
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
    document.write("<title>Inserir Flash</title>")
    }