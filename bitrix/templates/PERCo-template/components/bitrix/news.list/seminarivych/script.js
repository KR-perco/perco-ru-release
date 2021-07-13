function plusminus(img_id, seminars_id)
 {
	var src;
	src = url("file", document.getElementById(img_id).src);
	if (src == "plus.png")
	{
		document.getElementById(seminars_id).style.display = "block";
		document.getElementById(img_id).src = "/images/e-learning/minus.png";
	}
	else
	{
		document.getElementById(seminars_id).style.display = "none";
		document.getElementById(img_id).src = "/images/e-learning/plus.png";
	}
}