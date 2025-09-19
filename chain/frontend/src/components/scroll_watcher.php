<style>
.scroll_watcher{
    height: 3.8px;
    background: var(--text-clr);
    width: 100%;
    position: fixed;
    top: 0px;
    z-index: 99900;
    transform-origin: left;
    scale: 0 1;
    animation: scroll-watcher linear;
    animation-timeline: scroll();
}

@keyframes scroll-watcher {
    to{
    scale: 1 1;
    }
}
</style>
<div class="scroll_watcher"></div>
