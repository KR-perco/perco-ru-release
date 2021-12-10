<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock'); 
?>
<script>
        app.setPageTitle({
          title: "FAQ"
        });
	  
</script> 

<div class="faq" id="content">
		<div class="scrollmenu" id="scrollmenu"></div>
		<div class="section-list" id="section-list"></div>
  	</div>
  
    <script>
        var posts;

        $.getJSON('data_faq.json', function(json){      
            for (var prop in json) {
                sectionName = json[prop].NAME;
                sectionCode = json[prop].CODE;
                image = json[prop].DESCRIPTION.substr(14).replace(".svg", "");
                
                link = '<a class="link" onclick="changeSection(this)" data-filter="'+ sectionCode +'" ><img alt="'+ sectionName +'" src="/percoMobileMVP/img/catalog-'+ image +'.png">' + sectionName + '</a>';
                scrollmenu = document.getElementById("scrollmenu");
                scrollmenu.insertAdjacentHTML('beforeend', link);
                section = '<div class="section tabs" data-cat="'+ sectionCode +'" id="'+ sectionCode +'"></div>';
                sectionList = document.getElementById("section-list");
                sectionList.insertAdjacentHTML('beforeend', section);

                if (json[prop].ITEMS){
                    for(var item in json[prop].ITEMS){
                        var questionList = "";
                        for (var question in json[prop].ITEMS[item].ELEMENTS){
                            questionList += '<p class="question">'+ json[prop].ITEMS[item].ELEMENTS[question].NAME +'</p><p class="answer">'+ json[prop].ITEMS[item].ELEMENTS[question].PREVIEW_TEXT +'</p>';
                        }

                        itemSection = '<input name="vkladki" type="checkbox" id="'+ json[prop].ITEMS[item].CODE +'"><label for="'+ json[prop].ITEMS[item].CODE +'"><span class="dashed">'+ json[prop].ITEMS[item].NAME +'</span></label><div>'+ questionList +'</div>';
                        sec = document.getElementById(sectionCode);
                        sec.insertAdjacentHTML('beforeend', itemSection);
                    }
                }
                if (json[prop].ELEMENTS){
                    for (var question in json[prop].ELEMENTS){
                        questionList += '<p class="question">'+ json[prop].ELEMENTS[question].NAME +'</p><p class="answer">'+ json[prop].ELEMENTS[question].PREVIEW_TEXT +'</p>';
                    }
                    sec = document.getElementById(sectionCode);
                    sec.insertAdjacentHTML('beforeend', questionList);
                }
            }

            showActive();
            
        });

        function showActive(){
            posts = $('.section-list .section');
            posts.hide();

            $('a.link:first-child').addClass('active');
            $('.section:first-child').show();
        }

        function changeSection(obj){
            $('.scrollmenu a').removeClass('active');
            $(obj).addClass('active');
        
            var customType = $(obj).data('filter'); // category
            posts
                .hide()
                .filter(function () {
                    return $(this).data('cat') === customType;
                })
                .fadeIn();
        }
    </script>
  

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>