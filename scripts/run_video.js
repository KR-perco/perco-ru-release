function run_video ()
{
	document.getElementById(id_video).click();
}
window.onload = function ()
{
	if (typeof id_video !== "undefined")
	{
		run_video();
	}
}