function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Inserir Linha";
    txtLang[1].innerHTML = "Inserir Coluna";
    txtLang[2].innerHTML = "Aumentar/Diminuir<br>Meclagem de Linha";
    txtLang[3].innerHTML = "Aumentar/Diminuir<br>Meclagem de Coluna";
    txtLang[4].innerHTML = "Apagar Linha";
    txtLang[5].innerHTML = "Apagar Coluna";

	document.getElementById("btnInsRowAbove").title="Inserir Linha (Acima)";
	document.getElementById("btnInsRowBelow").title="Inserir Linha (Abaixo)";
	document.getElementById("btnInsColLeft").title="Inserir Coluna (Esquerda)";
	document.getElementById("btnInsColRight").title="Inserir Coluna (Direita)";
	document.getElementById("btnIncRowSpan").title="Aumentar Meclagem de Linha";
	document.getElementById("btnDecRowSpan").title="Diminuir Meclagem de Linha";
	document.getElementById("btnIncColSpan").title="Aumentar Meclagem de Coluna";
	document.getElementById("btnDecColSpan").title="Diminuir Meclagem de Coluna";
	document.getElementById("btnDelRow").title="Apagar Linha";
	document.getElementById("btnDelCol").title="Apagar Coluna";
	document.getElementById("btnClose").value = " Fechar ";
    }
function getText(s)
    {
    switch(s)
        {
        case "Cannot delete column.":
            return "N&atilde;o &eacute; possivel apagar a coluna. A coluna cont&eacute;m celulas mescladas de outras colunas. Por favor, remova a mesclagem primeiro.";
        case "Cannot delete row.":
            return "N&atilde;o &eacute; possivel apagar a linha. A linha cont&eacute;m celulas mescladas de outras linhas. Por favor, remova a mesclagem primeiro.";
        default:return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Tamanho da Tabela</title>")
    }