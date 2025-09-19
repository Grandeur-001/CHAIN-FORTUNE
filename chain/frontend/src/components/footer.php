<style>
#footer{
    margin-top: 11rem;
    margin-left: 17rem;
    transition: all 300ms ease-in-out;
    margin-bottom: 28px;
    position: relative;    
}
#footer > .wrapper{
    display: flex;
    align-items: center;
    padding-inline: 20px;
    margin-right: 10px;
    height: 100%;
    justify-content: space-between;
}
.wrapper ul{
    display: flex;
    gap: 10px;
    cursor: default;
}
.wrapper ul .fainty{
    color: var(--secondary-text-clr);
}
.wrapper ul .link:hover{
    cursor: pointer;
    color: var(--accent-clr);
}

@media (max-width: 890px) {


    #footer{
        margin-left: 0rem;
        margin-bottom: 7rem;
    }

    #footer > .wrapper{
        justify-content: center;
    }
    .wrapper ul:nth-of-type(2){
        display: none;
    }


}
@media (max-width: 415px) {
    .wrapper ul span{
        font-size: 3.6vw;
    }


}
</style>
<section id="footer">
    <div class="wrapper">
        <ul>
            <span>© 2024</span>
            <span class="link fainty" onclick="location.href=`/chain-fortune/page/home`"> Chain Fortune. </span>
            <span>All Rights Reserved.</span>
        </ul>

        <ul>
            <span class="link" onclick="location.href=`../pages/faq.php`">FAQ</span> /
            <span class="link" onclick="location.href=``">Purchase Now</span>
        </ul>
    </div>
</section>














<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.production.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.production.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/d3@7.4.4/dist/d3.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.7.0/chart.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/sweetconsole.log/2.1.2/sweetconsole.log.min.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/gsap@3.9.1/dist/gsap.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/requirejs/2.3.6/require.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.0/mousetrap.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/p5.js@1.4.0/lib/p5.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/phoenix@2.0.1/phoenix.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/vis-network@9.0.4/dist/vis-network.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/4.1.1/intro.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/babel-polyfill@7.12.1/dist/polyfill.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/resize-observer-polyfill/1.5.1/ResizeObserver.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/2.3.2/moment-duration-format.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/ionicons@5.5.4/dist/ionicons.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/axios-jsonp@1.0.2/dist/axios-jsonp.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.1/leaflet.markercluster.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.13/dist/jquery.knob.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/foundation-sites/6.6.3/js/foundation.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/sass.js/0.10.10/sass.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/highcharts@9.2.2/highcharts.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/slickgrid/2.4.5/slick.grid.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jasny-bootstrap@4.0.0/dist/js/jasny-bootstrap.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/metro/4.5.8/js/metro.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/jquery-circular-progressbar@1.0.0/dist/jquery-circular-progressbar.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/lottie-web@5.7.10/build/player/lottie.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/rickshaw/1.6.4/rickshaw.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/fabric@4.5.0/dist/fabric.min.js"></script>
