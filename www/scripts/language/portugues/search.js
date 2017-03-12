function loadText()
	{
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Procurar";
    txtLang[1].innerHTML = "Substituir";
    txtLang[2].innerHTML = "Coincidir Mai&uacute;sculas";
    txtLang[3].innerHTML = "Coincidir a Palavra Inteira";
    
    document.getElementById("btnSearch").value = "Procurar Proxima";;
    document.getElementById("btnReplace").value = "Substituir";
    document.getElementById("btnReplaceAll").value = "Substituir Tudo";  
    document.getElementById("btnClose").value = "Fechar";
	}
function writeTitle()
	{
	document.write("<title>Procurar & Substituir</title>")
	}