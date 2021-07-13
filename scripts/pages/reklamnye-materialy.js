function run_edge(url, id)
{
	AdobeEdge.loadComposition(url, id, {
		scaleToFit: "none",
		centerStage: "none",
		minW: "0",
		maxW: "undefined",
		width: "351px",
		height: "255px"
	}, {"dom":{}}, {"dom":{}});
}
$(function(){
	//Adobe Edge Runtime
	if ($(".EDGE-13406137").length > 0)
		run_edge('/scripts/banners/inter-catalog', 'EDGE-13406137');
	if ($(".EDGE-16757158").length > 0)
		setTimeout(function () {
			run_edge('/scripts/banners/inter-catalog-system', 'EDGE-16757158');
		}, 500);
	//Adobe Edge Runtime End
});