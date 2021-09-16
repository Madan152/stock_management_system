<script>
    function showonlyone(thechosenone) {
        $('.entry-row').each(function (index) {
            if ($(this).attr("id") == thechosenone) {
                $(this).show(200);
            }
            else {
                $(this).hide(600);
            }
        });
    }

    $(document).ready(function () {
        $('.btnTab').click(function () {
            $('.btnTab').removeClass('btn-success').addClass('btn-default');
            $(this).removeClass('btn-default').addClass('btn-success');
        });
    });

    $(document).ready(function () {
        $('#sidebar').affix({
            offset: {
                top: 245
            }
        });
    });

    var $body = $(document.body);
    var navHeight = $('.navbar').outerHeight(true) + 10;

    $body.scrollspy({
        target: '#leftCol',
        offset: navHeight
    });

</script>
<?php
//if ($_SESSION['msg_str'] != "") {
//    echo "<script>"
//    . "$(document).ready(function () {"
//    . "$('#myModal').find('.modal-title').html('" . $_SESSION['msg_hdr'] . "');"
//    . "$('#myModal').find('.modal-body').text('" . $_SESSION['msg_str'] . "');"
//    . "$('#myModal').modal('show');"
//    . " });"
//    . "</script>";
//    $_SESSION['msg_str'] = "";
//}
?>