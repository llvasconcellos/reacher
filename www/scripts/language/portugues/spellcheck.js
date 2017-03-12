function loadText()
	{
    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnOk").value = " OK ";
	}
function getText(s)
	{
	switch(s)
		{
		case "Required":
			return "&Eacute; necess&aacute;rio ieSpell (www.iespell.com).";
		default:return "";
		}
	}
function writeTitle()
	{
	document.write("<title>Verificar Ortografia</title>")
	}