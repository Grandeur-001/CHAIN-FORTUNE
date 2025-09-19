const ScrollUpStyles = `
  .back-top-wrapper{
        transition: all 0.5s ease;
        width: 60px;
    }
    .back-top-wrapper:hover .ant-tooltip{
        transform: translateX(0);
        opacity: 1;
    }
 

    #back-top {
        background: var(--base-clr);
        height: 50px;
        width: 50px;
        right: 31px;
        bottom: 18px;
        position: fixed;
        color: var(--text-clr);
        font-size: 20px;
        text-align: center;
        border-radius: 50%;
        line-height: 48px;
        box-shadow: 0 0 10px 3px rgba(108, 98, 98, 0.2);
        z-index: 2000;
        transform: rotate(-90deg);
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid var(--line-clr);

    }
    #back-top:hover{
        border: 1px solid var(--accent-clr);

    }
  
    #back-top a .arrow-up {
        transform: rotate(90deg);
        display: flex;
        justify-content: center;
        align-items: center;    
        fill: var(--text-clr);
    }

    #back-top:hover a .arrow-up{
        fill: var(--accent-clr);
    } 


    .ant-tooltip{
        background: var(--line-clr);
        padding: 8px 12px;
        border-radius: 7px;
        font-size: 12px;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.5s ease;
    }
    .ant-tooltip::before{
        content: '';
        position: absolute;
        bottom: 8px;
        left: 100%;
        transform: translateX(-70%);
        width: 9px;
        height: 9px;
        background-color: var(--line-clr);
        transform-origin: center;
        rotate: 45deg;
    }

`
const ScrollUpCss = document.createElement('style');
ScrollUpCss.appendChild(document.createTextNode(ScrollUpStyles));
document.head.appendChild(ScrollUpCss);