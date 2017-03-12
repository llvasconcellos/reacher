function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Nome";
    txtLang[1].innerHTML = "Tamanho";
    txtLang[2].innerHTML = "M&uacute;ltipla Sele&ccedil;o";
    txtLang[3].innerHTML = "Valores";
    
    document.getElementById("btnAdd").value = "  Adicionar  ";
    document.getElementById("btnUp").value = "  Para Cima  ";
    document.getElementById("btnDown").value = "  Para Baixo  ";
    document.getElementById("btnDel").value = " Apagar ";
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function writeTitle()
    {
    document.write("<title>Lista</title>")
    }