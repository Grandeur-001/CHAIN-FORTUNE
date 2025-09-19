<style>
    #loader{
        position: fixed;
        width: 100%;
        height: 100vh;
        z-index: 999999;
        background: var(--base-clr);
        top: 0;
        display: grid;
        place-content: center;
        place-items: center;

    }

    #loader > img{
        animation: bounceLoader 1s infinite;
    }

    @media (max-width: 800px) {
        #loader img{
            scale: 0.69;
        }
    }
 </style>
<div id="loader">
    <img src="./assets/images/loader.svg" width="90"  alt="">
</div>
<script>
    let loader;

    function loadNow(opacity) {
        if (opacity <= 0) {
            displayContent();
        } else {
            loader.style.opacity = opacity;
            window.setTimeout(function() {
                loadNow(opacity - 0.05);
            }, 50);
        }
    }

    function displayContent() {
        loader.style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function() {
        loader = document.getElementById('loader');
        loadNow(1);
    });
</script>