<style>
    @keyframes pulse {
        from {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }

        50% {
            -webkit-transform: scale3d(1.05, 1.05, 1.05);
            transform: scale3d(1.05, 1.05, 1.05);
        }

        to {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
    }
    .button_component3{
        /* animation: pulse 1s infinite; */
        border-radius: 3px;
        padding: 13px 20px;
        cursor: pointer;
        text-transform: uppercase;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        box-shadow:inset 0 0 0px 1px var(--accent-clr);
        color: var(--accent-clr);
        background: var(--base-clr);

        @media screen and (max-width: 500px) {
            width: 100%;

        }
        &:hover{
            animation: none;
            color: var(--text-clr);

            box-shadow:inset 500px 0px 1px var(--accent-clr);
            background: transparent;
            text-decoration: none;

        }
        &:active{
            scale: 0.95;
            box-shadow: 0 0 0 4px white;
        }
    }
</style>

<a 
    href="<?php echo isset($buttonOutlinedHref) ? htmlspecialchars($buttonOutlinedHref) : '#'; ?>" 
    class="button_component3"><?php echo isset($buttonOutlinedText) ? htmlspecialchars($buttonOutlinedText) : 'Default'; ?>
</a>
