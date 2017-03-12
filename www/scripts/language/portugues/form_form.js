function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Nome";
    txtLang[1].innerHTML = "A&ccedil;&atilde;o";
    txtLang[2].innerHTML = "M&eacute;todo";
        
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Formul&aacute;rio</title>")
    }