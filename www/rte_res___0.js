var L_CANCEL_TEXT = "Cancelar";
var L_INSERT_TEXT = "Inserir";
var L_LINKIMGBORDER_TEXT = "Exibir uma borda em torno da imagem com link";
var L_LINKSELECT_TEXT = "Selecionar uma página da comunidade:";
var L_LINKSELECTPAGE_TEXT = "Selecionar Página";
var L_LINKWEB_TEXT = "ou digitar um URL para uma página da Web:";
var L_PUTITLEBGCOLOR_TEXT = "Definir a Cor do Plano de Fundo";
var L_PUTITLEFONTFACE_TEXT = "Definir Estilo da Fonte";
var L_PUTITLEFONTSIZE_TEXT = "Definir Tamanho da Fonte";
var L_PUTITLEIMAGE_TEXT = "Inserir ou Editar Imagem";
var L_PUTITLELINK_TEXT = "Inserir ou Editar um Link";
var L_PUTITLENEWTABLE_TEXT = "Criar ou Editar Tabela";
var L_PUTITLEPARAGRAPHSTYLE_TEXT = "Definir Estilo do Parágrafo";
var L_PUTITLETEXTCOLOR_TEXT = "Definir a Cor do Texto";
var L_STYLEFORMATTED_TEXT = "Pré-formatado";
var L_STYLEHEADING_TEXT = "Título";
var L_STYLENORMAL_TEXT = "Normal";
var L_STYLESAMPLE_TEXT = "ABCabc012...  ";
var L_TABLEBG_TEXT = "Fundo";
var L_TABLEBORDERS_TEXT = "Bordas";
var L_TABLEINPUTBGCOLOR_TEXT = "Cor do Fundo:";
var L_TABLEINPUTBGIMGURL_TEXT = "URL de Imagem de Fundo:";
var L_TABLEINPUTBORDER_TEXT = "Largura da Borda:";
var L_TABLEINPUTBORDERCOLOR_TEXT = "Cor da Borda:";
var L_TABLEINPUTCELLPADDING_TEXT = "Enchimento da Célula:";
var L_TABLEINPUTCELLSPACING_TEXT = "Espaçamento da Célula:";
var L_TABLEINPUTCOLUMNS_TEXT = "Colunas: ";
var L_TABLEINPUTROWS_TEXT = "Filas: ";
var L_TABLEPADDINGANDSPACING_TEXT = "Enchimento e Espaçamento";
var L_TABLEROWSANDCOLS_TEXT = "Linhas e Colunas";
var L_TABLEINSERTROW_TEXT = "Inserir Linha";
var L_TABLEINSERTCELL_TEXT = "Inserir Coluna";
var L_TABLEINSERT_TEXT = "Inserir Tabela";
var L_TABLEUPDATE_TEXT = "Atualizar Tabela";
var L_TABLENEW_TEXT = "Nova Tabela";
var L_TABLEEDIT_TEXT = "Editar Tabela";
var L_TIPB_TEXT = "Negrito";
var L_TIPBGCOLOR_TEXT = "Cor do Fundo";
var L_TIPCJ_TEXT = "Justificar no Centro";
var L_TIPCOPY_TEXT = "Copiar Texto";
var L_TIPCUT_TEXT = "Recortar Texto";
var L_TIPDINDENT_TEXT = "Diminuir Recuo";
var L_TIPFGCOLOR_TEXT = "Cor do Texto";
var L_TIPFSIZE_TEXT = "Tamanho da Fonte";
var L_TIPFSTYLE_TEXT = "Estilo da Fonte";
var L_TIPI_TEXT = "Itálico";
var L_TIPIINDENT_TEXT = "Aumentar Recuo";
var L_TIPLINE_TEXT = "Inserir Linha";
var L_TIPLINK_TEXT = "Inserir Link";
var L_TIPLJ_TEXT = "Justificar à Esquerda";
var L_TIPOL_TEXT = "Lista Numerada";
var L_TIPP_TEXT = "Estilo de Parágrafo";
var L_TIPPASTE_TEXT = "Colar Texto";
var L_TIPPICTURE_TEXT = "Inserir Figura";
var L_TIPRJ_TEXT = "Justificar à Direita";
var L_TIPTABLE_TEXT = "Inserir Tabela";
var L_TIPU_TEXT = "Sublinhado";
var L_TIPUL_TEXT = "Lista com Marcadores";
var L_MODETITLE_TEXT = "Modo HTML Avançado";
var L_MODETITLE_TEXT = "Use HTML para criar sua página.";
var L_MODEDESC_TEXT = "- Editar diretamente comandos de formatação em HTML.";
var L_CUSTOMFONT_TEXT = "Outras Fontes...";
var L_CUSTOMFONTENTRY_TEXT = "Insira o nome da fonte:";
var L_SAMPLEFONTENTRY_TEXT = "Arial, Geneva, Sans-serif";
var L_CLOSEBUTTON_TEXT = "x";
var L_PHOTOURL_TEXT = "http://communities.msn.com/central/helium/pt-br/uni/editor/rte/photos/photos.htm";
var L_TBDATABINDING_TEXT = "Colunas";
var L_TBDATALABEL_TEXT   = 'Adicionar um espaço reservado para a coluna selecionada.';
var L_DEFAULTHTML_TEXT = "<DIV></DIV>";

// Customize Font List
// FONTNAME_TEXT - Displayed in the pop-up
// FONTNAMEDEF_TEXT - The font definition used in the HTML
var L_FONTARIAL_TEXT = "Arial";
var L_FONTARIALDEF_TEXT = "Geneva, Arial, Sans-serif";
var L_FONTARIALBLACK_TEXT = "Arial Black";
var L_FONTARIALBLACKDEF_TEXT = "Arial Black, Geneva, Arial, Sans-serif";
var L_FONTCOURIERNEW_TEXT = "Courier New";
var L_FONTCOURIERNEWDEF_TEXT = "Courier New, Courier, Monospace";
var L_FONTTIMESNEWROMAN_TEXT = "Times New Roman";
var L_FONTTIMESNEWROMANDEF_TEXT = "Times New Roman, Times, Serif";
var L_FONTVERDANA_TEXT = "Verdana";
var L_FONTVERDANADEF_TEXT = "Verdana, Geneva, Arial, Sans-serif";
var L_LUCIDAHAND_TEXT = "Lucida Handwriting";
var L_LUCIDAHANDDEF_TEXT = "Lucida Handwriting, Cursive";
var L_GARAMOND_TEXT = "Garamond";
var L_GARAMONDDEF_TEXT = "Garamond, Times, Serif";
var L_WEBDINGS_TEXT = "Webdings";
var L_WEBDINGSDEF_TEXT = "Webdings";
var L_WINGDINGS_TEXT = "Wingdings";
var L_WINGDINGSDEF_TEXT = "Wingdings";

// Add/ Remove fonts by modifying array
// _CFont(Definition, Display Text, Symbol)
// Set Symbol=true for non-alphabetic fonts to append display text in default font to the sample string
function _CFont(szDef,szText,bSymbol) {
return new Array(szDef,szText,bSymbol);
};
defaultFonts = new Array();
defaultFonts[0] = _CFont(L_FONTARIALDEF_TEXT, L_FONTARIAL_TEXT, false);
defaultFonts[1] = _CFont(L_FONTARIALBLACKDEF_TEXT, L_FONTARIALBLACK_TEXT, false);
defaultFonts[2] = _CFont(L_FONTVERDANADEF_TEXT, L_FONTVERDANA_TEXT, false);
defaultFonts[3] = _CFont(L_FONTTIMESNEWROMANDEF_TEXT, L_FONTTIMESNEWROMAN_TEXT, false);
defaultFonts[4] = _CFont(L_GARAMONDDEF_TEXT,L_GARAMOND_TEXT, false);
defaultFonts[5] = _CFont(L_LUCIDAHANDDEF_TEXT,L_LUCIDAHAND_TEXT, false);
defaultFonts[6] = _CFont(L_FONTCOURIERNEWDEF_TEXT, L_FONTCOURIERNEW_TEXT, false);
defaultFonts[7] = _CFont(L_WEBDINGSDEF_TEXT, L_WEBDINGS_TEXT, true);
defaultFonts[8] = _CFont(L_WINGDINGSDEF_TEXT, L_WINGDINGS_TEXT, true);
// Width of each toolbar button
// Entry 5-8 are specify "Paragraph","Font Style", and "Font Size" respectively
// Update widths if localized
var L_TOOLBARGIF_TEXT = "imagens/rte_tbBR.gif";
var PHOTO_URL = L_PHOTOURL_TEXT
var aSizes = new Array(25,25,25,7,27,25,25,7,25,25,25,8,25,25,25,8,25,25,25,25,8,25,25,25,25,8,25);