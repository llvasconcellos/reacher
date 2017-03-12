<HTML>
	<HEAD>
		<title>Edição de Conteúdo</title>
		<SCRIPT SRC="rte_res___0.js"></SCRIPT>
		<SCRIPT SRC="rte___0.js"></SCRIPT>		
		<STYLE type="text/css">
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				border:none;
				padding:0pt;
			}
			#tbDBSelect {
				display:none;
				text-align:left;
				width: 100;
				margin-right: 1pt;
				margin-bottom: 0pt;
				margin-top: 0pt;
				padding: 0pt;
			}
			#DBSelect, #idMode, .userButton {
				font:8pt arial;
			}
			#DBSelect {
				width:100;
			}
			#idMode {
				margin-top:0pt;
			}
			.tbButton {
				text-align:left;
				margin:0pt 1pt 0pt 0pt;
				padding:0pt;
			}
			#EditBox {
				position: relative;
			}
		</STYLE>
		<STYLE type="text/css" id="skin" disabled>
			#EditBox {
				border-top: solid 1px black;
			}
			#tbUpRight, #tbUpLeft {
				width:20px;
			}	
			#idMode {
				margin-left:11px;
				padding:0pt;
			}
			#idMode LABEL {
				color: navy;
				text-decoration: underline;
			}
			#tbTopBar {
				height:19px;
			}
			#tbButtons, #tbContents {
				background: #B4CADF;
				vertical-align: top;
			}
			#tbContents {
				padding:0px 5px;
			}
			#tbBottomBar {
				height:6px;
			}
		</STYLE>
		<STYLE type="text/css" id="defPopupSkin">
			#popup BODY {
				margin:0px;
				border-top:none;
			}
			#popup .colorTable {
				height:91px;
			}
			#popup #header {
				width:100%;
			}
			#popup #close {
				cursor:default;
				font:bold 8pt system;
				width:16px;
				text-align: center;
			}
			#popup #content {
				padding:10pt;
			}
			#popup TABLE {
				vertical-align:top;
			}
			#popup .tabBody {
				border:1px black solid;
				border-top: none;
			}
			#popup .tabItem, #popup .tabSpace {
				border-bottom:1px black solid;
				border-left:1px black solid;
			}
			#popup .tabItem {
				border-top:1px black solid;
				font:10pt arial,geneva,sans-serif;
			}
			#popup .currentColor {
				width:20px;
				height:20px;
				margin: 0pt;
				margin-right:15pt;
				border:1px black solid;
			}
			#popup .tabItem DIV {
				margin:3px;
				padding:0px;
				cursor: hand;
			}
			#popup .tabItem DIV.disabled {
				color: gray;
				cursor: default;
			}
			#popup .selected {
				font-weight:bold;
			}
		</STYLE>
		<STYLE type="text/css" id="popupSkin">
			#popup BODY {
				border: 3px #B4CADF solid; 
				background: #F3F8FC;
			}
			#popup #header {
				background: #B4CADF;
				color: black;
			}
			#popup #caption {
				text-align: left;
				font: bold 12pt arial , geneva, sans-serif;
			}
			#popup .ColorTable, #popup #idList TD#current {
				border: 1px black solid;
			}
			#popup #idList TD{
				cursor: hand;
				border: 1px #F3F8FC solid;
			}
			#popup #close {
				border: 1px black solid;
				cursor:hand;
				color: black;
				font-weight: bold;
				margin-right: 6px;
				padding:0px 4px 2px;
			}
			#popup #tableProps .tablePropsTitle {
				color:#006699;
				text-align:left;
				margin:0pt;
				border-bottom: 1px black solid;
				margin-bottom:5pt;
			}
			#tableButtons, #tableProps {
				padding:5px;
			}
			#popup #tableContents {
				height:175px;
			}
			#popup #tableProps .tablePropsTitle, #popup #tableProps, #popup #tableProps TABLE {
				font:bold 9pt Arial, Geneva, Sans-serif;
			}
			#popup #tableOptions  {
				font:9pt Arial, Geneva, Sans-serif;
				padding:15pt 5pt;
			}
			#popup #puDivider {
				background:black;
				width:1px;
			}
			#popup #content {
				margin: 0pt;
				padding:5pt 5pt 10pt 5pt;
			}
			#popup #ColorPopup {
				width: 250px;
			}
			#popup .ColorTable TR {
				height:6px;
			}
			#popup .ColorTable TD {
				width:6px;
				cursor:hand;
			}
			#popup .block P,#popup .block H1,#popup .block H2,#popup .block H3,
			#popup .block H4, #popup .block H5,#popup .block H6,#popup .block PRE {
				margin:0pt;
				padding:0pt;
			}
			#popup #customFont {
				font:12pt Arial;
				text-decoration:italic;
			}
		</STYLE>
		<SCRIPT language="JavaScript">
			var g_state;
			window.onload	= _initEditor;
		</SCRIPT>
	</HEAD>													
	<BODY oncontextmenu="return false" tabindex="-1" scroll="no" onselectstart="return false" ondragstart="return false" onscroll="return false">
		<DIV id="idEditor" style="visibility:hidden;">
			<TABLE id="idToolbar" width="100%" cellspacing="0" cellpadding="0" onClick="_CPopup_Hide()">
				<TR>
					<TD id="tbMidLeft"></TD>
					<TD id="tbContents" align="center"><SCRIPT>_drawToolbar()</SCRIPT></TD>
					<TD id="tbButtons" align="right"></TD>
					<TD id="tbMidRight"></TD>
				</TR>
				<TR id="tbbottomBar">
					<TD id="tbLowLeft"></TD>
					<TD colspan="2" id="tbLowMiddle"></TD>
					<TD id="tbLowRight"></TD>
				</TR>
			</TABLE>
			<IFRAME name="idPopup" style="height: 200px; left: 25px; margin-top: 8px; position: absolute; visibility: hidden; width: 200px; z-index: -1;"></IFRAME>
			<IFRAME id="EditBox" name="idEditbox" width="100%" height="100%" onfocus="_CPopup_Hide()"></IFRAME>
			<DIV id="tbmode"><SCRIPT>_drawModeSelect()</SCRIPT></DIV>
		</DIV>
	</BODY>
</HTML>