var sStyleWeight1;
var sStyleWeight2;
var sStyleWeight3;
var sStyleWeight4; 

function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Fonte";
    txtLang[1].innerHTML = "Estilo";
    txtLang[2].innerHTML = "Tamanho";
    txtLang[3].innerHTML = "Cor da Fonte";
    txtLang[4].innerHTML = "Cor de Fundo";
    txtLang[5].innerHTML = "Efeitos";
    
    txtLang[6].innerHTML = "Decora&ccedil;&atilde;o";
    txtLang[7].innerHTML = "Mai&uacute;sculas";
    txtLang[8].innerHTML = "Mai&uacute;sculas pequenas";
    txtLang[9].innerHTML = "Vertical";

    txtLang[10].innerHTML = "N&atilde;o Selecionado";
    txtLang[11].innerHTML = "Sublinhado";
    txtLang[12].innerHTML = "Sobrelinhado";
    txtLang[13].innerHTML = "Tachado";
    txtLang[14].innerHTML = "Nenhum";

    txtLang[15].innerHTML = "N&atilde;o Selecionado";
    txtLang[16].innerHTML = "Capitalizar";
    txtLang[17].innerHTML = "Todas Mai&uacute;sculas";
    txtLang[18].innerHTML = "Todas Min&uacute;sculas";
    txtLang[19].innerHTML = "Nenhum";

    txtLang[20].innerHTML = "N&atilde;o Selecionado";
    txtLang[21].innerHTML = "Mai&uacute;sculas pequenas";
    txtLang[22].innerHTML = "Normal";

    txtLang[23].innerHTML = "N&atilde;o Selecionado";
    txtLang[24].innerHTML = "Sobrescrito";
    txtLang[25].innerHTML = "Subescrito";
    txtLang[26].innerHTML = "Relativo";
    txtLang[27].innerHTML = "Linha Base";
    
    txtLang[28].innerHTML = "Espa&ccedil;amento de Caracteres";
    txtLang[29].innerHTML = "Pr&eacute;-visualizar";
    txtLang[30].innerHTML = "Aplicar para";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Regular"
    optLang[1].text = "It&aacute;lico"
    optLang[2].text = "Negrito"
    optLang[3].text = "Negrito It&aacute;lico"
    
    optLang[0].value = "Regular"
    optLang[1].value = "It&aacute;lico"
    optLang[2].value = "Negrito"
    optLang[3].value = "Negrito It&aacute;lico"
    
    sStyleWeight1 = "Regular"
    sStyleWeight2 = "It&aacute;lico"
    sStyleWeight3 = "Negrito"
    sStyleWeight4 = "Negrito It&aacute;lico"
    
    optLang[4].text = "Superior"
    optLang[5].text = "Meio"
    optLang[6].text = "Inferior"
    optLang[7].text = "Topo do Texto"
    optLang[8].text = "Base do Texto"
    optLang[9].text = "Texto Selecionado"
    optLang[10].text = "Tag Atual"
    
    document.getElementById("btnPick1").value = "Escolher";
    document.getElementById("btnPick2").value = "Escolher";

    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnApply").value = "Aplicar";
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
    document.write("<title>Formata&ccedil;&atilde;o do Texto</title>")
    }