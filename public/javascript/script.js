$(function() {
    $('#buttonMoreForm').click(
        function() {
            if($(this).attr("data-text") === "more") {
                $(this).attr("data-text","less");
                $(this).html("Less options"); 
            } else {
                $(this).attr("data-text","more");
                $(this).html("More options"); 
            }
            $('#moreForm').slideToggle("slow");
        }
    );
        
        $('.example').click(
            function() {
                $("#inputUrl").val($(this).attr("data-example"));
                permalink($(this).attr("data-example"));
            }
        );
        
        permalink($("#inputUrl").val());
        $("#inputUrl").on('change keyup paste', function() {
            var value = $(this).val();
            permalink(value);
        });
        
        function permalink(val) {
            if(val.match(/.*({searchterms}).*/i)) {
                $('#permalink').show("slow");
                $('#permalink').children("input").val("https://bangs.bonduel.net/su/"+encodeURIComponent(val));
            }else{
                $('#permalink').hide("slow");
            }
        }
});