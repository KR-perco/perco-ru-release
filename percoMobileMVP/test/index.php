<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
   <script type="text/javascript">
      function openTable()
      {
         app.openBXTable({
            url: "/percoMobileMVP/list.php",
            TABLE_SETTINGS: {
               alphabet_index: false, // Выключим алфавитный индекс
               showtitle: true, //Покажем тайтл
               cache: false,// не кэшируем 
               name: "Разделы", //
               callback: function (data)
               {
                  alert(JSON.stringify(data));
               }
            }
         });
      }
 
 
      //title
      app.setPageTitle({
         title: "test"
      });
      

      //pull-down-to-refresh
      app.pullDown({
         enable: true,
         callback: function ()
         {
            document.location.reload();
         },
         downtext: "Тяни...",
         pulltext: "Отпускай...",
         loadtext: "Жди..."
      });


   </script>

   <button style="width:100%;height:50px" onclick="openTable();">Table</button>  
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>