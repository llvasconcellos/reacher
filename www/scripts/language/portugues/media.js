function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "URL";
    txtLang[1].innerHTML = "Largura";
    txtLang[2].innerHTML = "Altura";    
    txtLang[3].innerHTML = "Auto Iniciar";    
    txtLang[4].innerHTML = "Mostrar Controles";
    txtLang[5].innerHTML = "Mostrar Barra de Status";   
    txtLang[6].innerHTML = "Mostrar Display";
    txtLang[7].innerHTML = "Auto Rebobinar";   

    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Media</title>")
    }
