function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Tipo";
    txtLang[1].innerHTML = "Nome";
    txtLang[2].innerHTML = "Valor";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Bot&atilde;o"
    optLang[1].text = "Enviar"
    optLang[2].text = "Limpar"
        
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Bot&atilde;o</title>")
    }