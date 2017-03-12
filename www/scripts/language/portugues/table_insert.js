function loadText()
    {
    var txtLang =  document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Linhas";
    txtLang[1].innerHTML = "Espa&ccedil;amento";
    txtLang[2].innerHTML = "Colunas";
    txtLang[3].innerHTML = "Espa&ccedil;amento Interno";
    txtLang[4].innerHTML = "Bordas";
    txtLang[5].innerHTML = "Mesclar";
    
	var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Sem Borda";
    optLang[1].text = "Sim";
    optLang[2].text = "N&atilde;o";
    
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnInsert").value = "Inserir";

    document.getElementById("btnSpan1").value = "Span v";
    document.getElementById("btnSpan2").value = "Span >";
    }
function writeTitle()
    {
    document.write("<title>Inserir Tabela</title>")
    }