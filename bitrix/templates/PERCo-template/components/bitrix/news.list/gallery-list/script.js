$(function(){
	$('#gallery div').on('click', function() {
		var startElement = $(this).children('a').attr('src');
		
		for (i = 0; i < elements.length; i++) {
			if (elements[0].src != startElement) {	
				var save = elements[i];
				elements.shift();
				elements.push(save);
				i--;
			} else { break; }
		}
		
		$(this).lightGallery({
			dynamic: true,
			dynamicEl: elements
		})
	});
});

var elements;
setTimeout(filterSelection, 1000, "all");

// Execute the function and show all blocks
function filterSelection(c) {
	var i;
	elements = [];
	
	if (c == "all") c = "";

	// Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
	var list = document.getElementsByClassName("item");
	for (let item of list) {
		var element = {};
		var el = item.children;
		RemoveClass(item, "show");
		if (item.className.indexOf(c) > -1) {
			AddClass(item, "show");
			element.src = $(el).attr("src");
			element.thumb = $(el).children("img").attr("src");
			element.subHtml = $(el).attr("data-sub-html");
			elements.push(element); 
		}
	}

	// Add active class to the current button (highlight it)
	var sectionBlock = document.getElementById("sectionBlock");
	var btns = sectionBlock.getElementsByClassName("btn-theme");
	for (var i = 0; i < btns.length; i++) {
		btns[i].addEventListener("click", function () {
			var current = document.getElementsByClassName("active");
			current[0].className = current[0].className.replace(" active", "");
			this.className += " active";
		});
	}
	
	//Yandex counter
	yaCounter176255.reachGoal(c);

}

// Show filtered elements
function AddClass(element, name) {
	var i, arr1, arr2;
	arr1 = element.className.split(" ");
	arr2 = name.split(" ");
	for (i = 0; i < arr2.length; i++) {
		if (arr1.indexOf(arr2[i]) == -1) {
			element.className += " " + arr2[i];
		}
	}
}

// Hide elements that are not selected
function RemoveClass(element, name) {
	var i, arr1, arr2;
	arr1 = element.className.split(" ");
	arr2 = name.split(" ");
	for (i = 0; i < arr2.length; i++) {
		while (arr1.indexOf(arr2[i]) > -1) {
			arr1.splice(arr1.indexOf(arr2[i]), 1);
		}
	}
	element.className = arr1.join(" ");
}