window.onload = init;

function init()
{
	showHint();
}
function ajaxInit() 
{
	var XHR = null;
	
	try 
	{
		XHR = new XMLHttpRequest();
	}
	catch(e)
	{
		try
		{
			XHR = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch(e2)
		{
			try
			{
				XHR = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e3)
			{
				alert("Niestety Twoja przeglądarka nie obsługuje AJAXA");
			}
		}
	}
	
	return XHR;	
}
function showHint()
{
	var XHR = ajaxInit();
	
	if (XHR != null)
	{
		var powierzchniamin = document.getElementById("powierzchniamin").value;
		var powierzchniamax = document.getElementById("powierzchniamax").value;
		var ludnoscmin = document.getElementById("ludnoscmin").value;
		var ludnoscmax = document.getElementById("ludnoscmax").value;
		
		var query;
		
		query = "powierzchniamin=" + powierzchniamin +
				"&powierzchniamax=" + powierzchniamax +
				"&ludnoscmin=" + ludnoscmin +
				"&ludnoscmax=" + ludnoscmax;
		
		XHR.open("GET", "wojewodztwa.php?"+query, true);
		
		XHR.onreadystatechange = function()
		{
			if (XHR.readyState == 4)
			{
				if (XHR.status == 200)
				{
					document.getElementById("tekst").innerHTML = XHR.responseText;
				}
				else
				 alert("Wystąpił błąd "+ XHR.status);
			}
		}
		
		XHR.send(null);
		
	}
}
