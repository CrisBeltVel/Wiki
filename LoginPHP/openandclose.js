showcat = new Boolean(true);
showmenu = new Boolean(true);

function showcategorias()
{
	if(showcat==true)
	{
		document.getElementById('selectcategorias').style.display='none';
	}else{
		document.getElementById('selectcategorias').style.display='block';
	}	
	showcat=!showcat;
}

function showburger()
{
	if(showmenu==true)
	{
		document.getElementById('menunavegacion').style.display='none';
		document.getElementById('buscador').style.display='none';
		
	}else{
		document.getElementById('menunavegacion').style.display='flex';
		document.getElementById('buscador').style.display='block';
	}
	showmenu=!showmenu;

}