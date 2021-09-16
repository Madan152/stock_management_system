<footer>
    <div class="text-center row padding">
        <p>Innovative Technology, Ranchi | All Rights Reserved. | Disclaimer</p>
        <p>Powered by Innovative Technology</p>
    </div>
</footer>

<script>
    $(".header_tab").each(function() {
           var total = $(this).find(".menu").length;
           var i=0;
          $(this).find(".menu").each(function() {   
           if($(this).next("li").hasClass("divider")){
            $(this).hide();
            $(this).next("li").hide();
            i++;
           }
           if($(this).next("li").hasClass("tab_color")){
               if($(this).next("li").next("li").hasClass("divider")){
                   $(this).hide();
                   i++;
               }
           }
           
       });
       if(total == i){
        $(this).parent().hide();   
       }
       });
</script>
<script>
$('form').submit(function() {
 $('#submit').prop("disabled", "disabled");
})
</script>