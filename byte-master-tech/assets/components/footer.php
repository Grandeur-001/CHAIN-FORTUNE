<style>
    footer{
        margin-top: 40px;
        background: inherit;
        color: var(--text-clr);
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background: var(--black-clr);

        .footer-card-wrapper{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            place-content: center;
            width: 100%;
            margin: 0 auto;
            padding: 1.5rem;
            border-bottom: 1px solid var(--line-clr);
            @media (max-width: 768px) {
                grid-template-columns: repeat(2, 1fr);
            };
            @media (max-width: 500px) {
                grid-template-columns: repeat(1, 1fr);
            };

            .footer-card{
                width: 100%;
                margin: 0 auto;
                padding: 1rem;

                .card-header > h3{
                    font-size: 1.4rem;
                }
                .card-links{
                    ul{
                        display: flex;
                        flex-direction: column;
                        gap: 0.7rem;
                        margin-top: 2rem;
                        

                        li a{
                            color: var(--text-clr);
                            transition: all 0.4s ease;
                            &:hover{
                                color: var(--accent-clr);
                            }
                        }
                    }
                }

            }
            .footer-card:nth-of-type(1){
                margin-right: 11rem;
                @media (max-width: 768px) {
                   margin-right: 0;
                };

                .readmore-link{
                    display: flex;
                    align-items: center;
                    color: var(--accent-clr);
                    gap: 9px;
                    transition: all 0.4s ease;
                    span{
                        margin-top: 7px;
                        transform: rotate(-30deg);
                        transition: all 0.4s ease;
                    }
                    &:hover span{
                       transform: rotate(0deg);
                    }
                    
                }
            }
        }
        .footer-copyright{
            width: 100%;
            text-align: center;
            padding: 30px;
            p{
                text-align: center;
                margin: auto;
            }
        }
    }



</style>
<footer>
    <div class="footer-card-wrapper">
        <div class="footer-card move_in">
            <div class="logo" onclick="location.href=`index.php`">
                ByteMasters!
                <span class="logo-icon">⚡</span>
            </div>
            <p style="margin-top:1rem;">Recognizing the need is the primary step to unlocking limitless possibilities.</p>
                <a href="#" class="readmore-link">
                    Read More
                    <span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </span>
                </a>
                
        </div>
       
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Socials</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li><a href="https://www.facebook.com/share/15DgJt6rBN/">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Quick Links</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li><a href="about-us.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-card move_in">
            <div class="card-header">
                <h3>Support</h3>
            </div>
            <div class="card-links">
                <ul>
                    <li><a href="#">Our Support</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>
          Copyrights © 2025 All Rights Reserved by ByteMasters
        </p>
    </div>



</footer>