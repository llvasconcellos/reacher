function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Nome";
    txtLang[1].innerHTML = "Valor";
    txtLang[2].innerHTML = "Padr&atilde;o";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Selecionado"
    optLang[1].text = "N&atilde;o Selecionado"
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Bot&atilde; de R&aacute;dio</title>")
    }