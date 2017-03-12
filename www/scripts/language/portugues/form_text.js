function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Tipo";
    txtLang[1].innerHTML = "Nome";
    txtLang[2].innerHTML = "Tamanho";
    txtLang[3].innerHTML = "Comprimento M&atilde;ximo";
    txtLang[4].innerHTML = "N&ordm; de Linhas";
    txtLang[5].innerHTML = "Valor";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Texto"
    optLang[1].text = "&Aacute;rea de Texto"
    optLang[2].text = "Senha"
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Campo de Texto</title>")
    }