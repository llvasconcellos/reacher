function loadText()
    {
    document.getElementById("txtLang").innerHTML = "Quebra de Linha";
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function getText(s)
    {
    switch(s)
        {
        case "Search":return "Procurar";
        case "Cut":return "Cortar";
        case "Copy":return "Copiar";
        case "Paste":return "Colar";
        case "Undo":return "Desfazer";
        case "Redo":return "Refazer";
        default:return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Editor de C&oacute;digo Fonte</title>")
    }
