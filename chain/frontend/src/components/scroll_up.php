



<!-- back to top start -->
<div class="back-top-wrapper" >
    <div id="back-top" class="" style="box-shadow: 0 0 10px 3px rgba(108, 98, 98, 0.2); ">
        <a title="Go to Top" id="scrollUp" href="#">
            <svg class="arrow-up sc-eqUAAy cMqsAc mx-icon iconfont iconzhiding" focusable="false" width="1.2em" height="1.2em" fill="" aria-hidden="true" viewBox="0 0 24 24">
                <path d="M5 4H19V6H5V4Z"></path>
                <path d="M13 11.2333L17.5449 15.7782L18.9591 14.364L11.9999 7.40479L5.04077 14.364L6.45499 15.7782L11 11.2332V20H13V11.2333Z"></path>
            </svg>
        </a>
    </div>
    <div style="position: fixed; right: 100px; bottom: 0; margin-bottom: 25px; z-index: 2000;">
        <div>
            <div class="ant-tooltip ant-tooltip-placement-left ant-tooltip-hidden">
                <div class="ant-tooltip-content">
                    <div class="ant-tooltip-arrow">
                        <span class="ant-tooltip-arrow-content"></span>
                    </div>
                    <div class="ant-tooltip-inner" role="tooltip">Back to Top</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/chain-fortune/js/scroll_up.style.js"></script>
<!-- <script src="/chain-fortune/js/scroll_up.js"></script> -->
<script>


    $(document).ready(function () {
        var totop = $('#back-top');  
        var win = $(window);
        win.on('scroll', function() {
            if (win.scrollTop() > 250) {
                totop.fadeIn();
                $('.ant-tooltip').show();
            } else {
                totop.fadeOut();
                $('.ant-tooltip').hide();
            }
        });
    });

  
    $('#back-top a').on("click", function () {
    $('body,html').animate({
        scrollTop: 0,
    }, 4000);
    return false;
    });
</script>
<!-- back to top end -->

