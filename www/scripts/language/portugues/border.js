function loadText()
    {
    document.getElementById("txtLang").innerHTML = "Cor";
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnOk").value = " OK ";
    }
function getText(s)
	{
	switch(s)
		{
		case "No Border": return "Sem Borda";
		case "Outside Border": return "Borda Externa";
		case "Left Border": return "Borda Esquerda";
		case "Top Border": return "Borda Superior";
		case "Right Border": return "Borda Direita";
		case "Bottom Border": return "Borda Inferior";
		case "Pick": return "Escolher";
		case "Custom Colors": return "Cores Customizadas";
		case "More Colors...": return "Mais Cores...";
		default: return "";
		}
	}
function writeTitle()
	{
	document.write("<title>Bordas</title>")
	}