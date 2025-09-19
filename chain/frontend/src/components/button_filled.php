
<style>
    .button_component2{
        padding: 13px 20px;
        background: transparent;
        cursor: pointer;
        color: var(--text-clr);
        border-radius: 3px;
        text-transform: uppercase;
        display: flex;
        justify-content: center;
        font-weight: 500;
        box-shadow:inset -500px 0px 1px var(--accent-clr);
        transition: all 0.3s ease;
        @media screen and (max-width: 500px) {
            width: 100%;

        }

       
        &:hover{
            color: var(--accent-clr);
            box-shadow:inset 0 0 0px 1px var(--accent-clr);
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
    href="<?php echo isset($buttonFilledHref) ? htmlspecialchars($buttonFilledHref) : '#'; ?>"
    class="button_component2"><?php echo isset($buttonFilledText) ? htmlspecialchars($buttonFilledText) : 'Default'; ?>
</a>
