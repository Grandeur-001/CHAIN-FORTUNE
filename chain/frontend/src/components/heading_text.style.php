<style>

    .head-text{
        position: relative;
        text-align: center;
        margin-top: 2rem;
        color: var(--text-clr);
        font-size: var(--large-font-size);
        padding: 0 1rem;
        z-index: 3;
    }
    .head-text::after{
        z-index: -1;
        content: "<?php echo isset($headTextWaterMark) ? htmlspecialchars($headTextWaterMark) : 'Default'; ?>";
        position: absolute;
        color: var(--hover-clr);
        opacity: 0.6;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        font-size: 55px;
        transform: translateY(-40px);
    }
    @media (max-width: 820px) {
        .head-text::after{
            font-size: 40px;
        }
        
    }
    @media (max-width: 560px) {
        .head-text::after{
            font-size: 37px;
        }
    }


</style>