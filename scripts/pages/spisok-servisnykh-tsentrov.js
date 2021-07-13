var sc = true;
if (url("?country") == "")
	var service = "rossiya";
else
	var service = url("?country");
var massRegions = {
	rossiya: {url: ""},
	UA: {url: "UA"},
	BY: {url: "BY"},
	KZ: {url: "KZ"}
};
massCities = {
	almaty: {name: "Алматы"},
	astana: {name: "Астана"},
	karaganda: {name: "Караганда"},
	minsk: {name: "Минск"},
	kiev: {name: "Киев"}
};