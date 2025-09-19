<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        /* font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; */
        background-color: var(--base-clr);
        
        color: var(--text-clr);
        min-height: 100vh;
    }
    
    canvas {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        /* display: none; */
        /* visibility: hidden; */
    }
    
    /* Banner Styles */
    .banner {
        padding: 4rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        line-height: 1.6;
        /* background: url(/chain-fortune/images/authbg/home-bg-w91DfXqUJ.png); */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* animation:  bannerTranform 5s infinite forwards; */

    }

    .banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.1;
        /* background: radial-gradient(circle at 50% 50%, var(--accent-clr) 0%, transparent 50%); */
    }
    @keyframes bannerTranform {
        0% {
            background-position: 200%  900%;
            background-position-y: bottom;


        }
    }
    .banner-content {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .banner h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(120deg, var(--text-clr), var(--accent-clr));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 0 30px rgba(79, 94, 254, 0.5);

    }

    .subtitle {
        font-size: 1.25rem;
        color: var(--secondary-text-clr);
        max-width: 600px;
        margin: 0 auto 3rem;
    }

    .stats {
        display: flex;
        justify-content: center;
        gap: 4rem;
        margin-bottom: 3rem;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--accent-clr);
    }

    .stat-label {
        color: var(--secondary-text-clr);
        font-size: 1rem;
    }

    .banner-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 3rem;
    }

    .btn {
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(79, 94, 254, 0.5);
    }

    .btn.primary {
        background-color: var(--accent-clr);
        color: var(--text-clr);
    }

    .btn.secondary {
        background-color: transparent;
        border: 2px solid var(--accent-clr);
        color: var(--accent-clr);
    }

    .market-ticker {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .ticker-item {
        background-color: var(--hover-clr);
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .ticker-item.positive .change {
        color: var(--positive-text-clr);
    }

    .ticker-item.negative .change {
        color: var(--negative-text-clr);
    }

    .coin {
        font-weight: 600;
    }

    .price {
        color: var(--text-clr);
    }
    
    
    /* wrapper for all the sections */
    .sections-wrapper{
    width: 100%;
    background: var(--base-clr);
    }

    /* Features Section */
    .card-wrapper {
        max-width: 1200px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        padding: 4rem 1rem;
        margin: 0 auto;
        /* background: var(--base-clr); */
        /* width: 100%; */
    }

    .card {
        background-color: var(--base-clr);
        border: 1px solid var(--line-clr);
        border-radius: 1rem;
        padding: 2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);

    }


    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        border: 1px solid var(--accent-clr);

    }

    .icon {
        width: 48px;
        height: 48px;
        margin-bottom: 1.5rem;
        color: var(--accent-clr);
    }

    .icon svg {
        width: 100%;
        height: 100%;
    }

    h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-clr);
    }

    p {
        color: var(--secondary-text-clr);
        font-size: 1rem;
        margin: 0;
        line-height: 26px;
    }

    .card-wrapper2{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    padding: 4rem 2rem;
    margin: 0 auto;
    overflow: hidden;
    }
    .card-wrapper2 .text-card p{
        line-height: 28px;
    }
    @keyframes headShake {
        from {
            -webkit-transform: scale3d(1, 1, 1);
                    transform: scale3d(1, 1, 1);
        }
        10%, 20% {
            -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
                    transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
        }
        30%, 50%, 70%, 90% {
            -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
                    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
        }
        40%, 60%, 80% {
            -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
                    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
        }
        to {
            -webkit-transform: scale3d(1, 1, 1);
                    transform: scale3d(1, 1, 1);
        }
    }

    .card-wrapper3{
        display: flex;
        /* grid-template-columns: repeat(6, 1fr); */
        gap: 2rem;
        padding: 4rem 2rem;
        padding-inline: 100px;
        place-content: center;
        place-items: center;
        align-items: center;
        align-content: center;
        text-align: center;

        
        
        .six-cols-card{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-radius: 1rem;
            transition: all 0.4s ease;
            
            &:hover{
                scale: 1.1;
                box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);
            }
            &:hover .icon{
                animation: headShake 1s forwards;
            }




            p{
                font-weight: bolder;
                font-size: 1.02rem;

            }
        }
    }
    
    
    @media (max-width: 1183px) {
    .card-wrapper2{
        grid-template-columns: repeat(1, 1fr);
    }
    .card-wrapper3{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        padding-inline: 80px;
    }
    }
    @media (max-width: 778px) {
    .card-wrapper3{
        display: grid;
        padding-inline: 40px;
        grid-template-columns: repeat(2, 1fr);
    }

    }

    @media (max-width: 655px) {
    .card-wrapper2 .image-card{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }
    .card-wrapper2 .image-card img,
    .carousel-image{
        width: 500px;
    }
    .card-wrapper2 .text-card p{
        line-height: 26px;
    }
    }
    @media (max-width: 530px) {
    .card-wrapper2{
        padding: 4rem 1.3rem;
    }

    }






    /* Responsive Design */
    @media (max-width: 1024px) {
        .banner h1 {
            font-size: 3rem;
        }

        .stats {
            gap: 2rem;
        }

        .stat-value {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .banner h1 {
            font-size: 2.5rem;
        }

        .subtitle {
            font-size: 1.1rem;
        }

        .stats {
            flex-direction: column;
            gap: 2rem;
        }

        .card-wrapper {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .card {
            padding: 1.5rem;
        }

        h3 {
            font-size: 1.25rem;
        }

        .market-ticker {
            flex-direction: column;
            align-items: center;
        }

        .ticker-item {
            width: 100%;
            max-width: 300px;
            justify-content: space-between;
        }
    }

    @media (max-width: 480px) {
        .banner {
            padding: 3rem 1rem;
        }

        .banner h1 {
            font-size: 2rem;
        }

        .subtitle {
            font-size: 1rem;
        }

        .banner-cta {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

        .features {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .icon {
            /* width: 40px; */
            /* height: 40px; */
        }

        .card-wrapper3{
            grid-template-columns: repeat(1, 1fr);
            gap: 70px;

            .six-cols-card{
                p{
                    font-size: 1.4rem;
                }
            }
        }

    }

    @media (max-width: 320px) {
        .banner h1 {
            font-size: 1.75rem;
        }

        .card {
            padding: 1rem;
        }

        h3 {
            font-size: 1.1rem;
        }

        p {
            font-size: 0.9rem;
        }

        .ticker-item {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>