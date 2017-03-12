function loadText()
    {
    var txtLang =  document.getElementsByName("txtLang");
    //txtLang[0].innerHTML = "Size";
    txtLang[0].innerHTML = "Auto-ajustar";
    txtLang[1].innerHTML = "Propriedades";
    txtLang[2].innerHTML = "Estilo";
    //txtLang[4].innerHTML = "Insert Row";
    //txtLang[5].innerHTML = "Insert Column";
    //txtLang[6].innerHTML = "Span/Split Row";
    //txtLang[7].innerHTML = "Span/Split Column";
    //txtLang[8].innerHTML = "Delete Row";
    //txtLang[9].innerHTML = "Delete Column";    
    txtLang[3].innerHTML = "Largura";
    txtLang[4].innerHTML = "Auto-ajustar ao Conte&uacute;do";
    txtLang[5].innerHTML = "Largura Fixa da Tabela";
    txtLang[6].innerHTML = "Auto-ajustar &agrave; Janela";
    txtLang[7].innerHTML = "Altura";
    txtLang[8].innerHTML = "Auto-ajustar ao Conte&uacute;do";
    txtLang[9].innerHTML = "Altura Fixa da Tabela";
    txtLang[10].innerHTML = "Auto-ajustar &agrave; Janela";
    txtLang[11].innerHTML = "Alinhamento";
    txtLang[12].innerHTML = "Margem";
    txtLang[13].innerHTML = "Esquerda";
    txtLang[14].innerHTML = "Direita";
    txtLang[15].innerHTML = "Superior";
    txtLang[16].innerHTML = "Inferior";
    txtLang[17].innerHTML = "Bordas";
    txtLang[18].innerHTML = "Mesclar";
    txtLang[19].innerHTML = "Fundo";
    txtLang[20].innerHTML = "Espa&ccedil;o Celulas";
    txtLang[21].innerHTML = "Espa&ccedil;o Interno";
    txtLang[22].innerHTML = "Texto CSS";
        
    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "pixels"
    optLang[1].text = "porcento"
    optLang[2].text = "pixels"
    optLang[3].text = "porcento"
    optLang[4].text = "esquerda"
    optLang[5].text = "centro"
    optLang[6].text = "direita"
    optLang[7].text = "sem borda"
    optLang[8].text = "Sim"
    optLang[9].text = "N&atilde;o"

    document.getElementById("btnPick").value="Escolher";
    document.getElementById("btnImage").value="Imagem";

    document.getElementById("btnCancel").value = "Cancelar";
    document.getElementById("btnApply").value = "Aplicar";
    document.getElementById("btnOk").value = " OK ";
    }
function getText(s)
    {
    switch(s)
        {
        case "Cannot delete column.":
            return "N&atilde;o &eacute; possivel apagar a coluna. A coluna cont&eacute;m celulas mescladas de outras colunas. Por favor, remova a mesclagem primeiro.";
        case "Cannot delete row.":
            return "&atilde;o &eacute; possivel apagar a linha. A linhya cont&eacute;m celulas mescladas de outras linhas. Por favor, remova a mesclagem primeiro.";
        case "Custom Colors": return "Cores Customizadas";
        case "More Colors...": return "Mais Cores...";
        default:return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Propriedades da Tabela</title>")
    }