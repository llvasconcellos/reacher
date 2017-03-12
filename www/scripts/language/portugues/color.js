function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Palheta Web";
    txtLang[1].innerHTML = "Cores Nomeadas";
    txtLang[2].innerHTML = "216 Cores Web-Safe";
    txtLang[3].innerHTML = "Nova";
    txtLang[4].innerHTML = "Atual";
    txtLang[5].innerHTML = "Cores Customizadas";
    
    document.getElementById("btnAddToCustom").value = "Adicionar as Cores Customizadas";
    document.getElementById("btnCancel").value = " Cancelar ";
    document.getElementById("btnRemove").value = " Remover Cor ";
    document.getElementById("btnApply").value = " Aplicar ";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Cores</title>")
    }
