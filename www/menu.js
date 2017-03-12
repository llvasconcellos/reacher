var saiu = 0;
var intervalo;
var count = 0;
var ultimo_menu = "";

function start(menu){
	count = 0;
	saiu = 0;
	intervalo = setInterval('checamouse("' + menu + '")', 10);
}
function checamouse(menu){
	if (saiu != 0){
		escondemenu(menu);
		clearInterval(intervalo);
		saiu = 0;
	}
}
function escondemenu(menu){
	var div = window.document.getElementById(menu);
	div.style.visibility = "hidden";
}
function mostramenu(menu){
	if(ultimo_menu.length>0) escondemenu(ultimo_menu);
	var div = window.document.getElementById(menu);
	div.style.overflow = "";
	div.style.height = "";
	div.style.marginTop = "-15px";
	div.style.visibility = "visible";
	ultimo_menu = menu;
}