const Styles = `


    :root {
        --base-clr: #11121a;
        --line-clr: #42434a;
        --hover-clr: #222533;
        --text-clr: #e6e6ef;
        --accent-clr: #5e63ff;
        --secondary-text-clr: #b0b3c1;
        --negative-text-clr: rgb(255, 0, 0);
        --positive-text-clr: rgb(0, 255, 106);
        --pending-text-clr: rgb(255, 255, 0);
        --info-clr: rgb(0, 145, 255);

        --negative-bg-clr: rgba(231, 76, 60, 0.15);
        --positive-bg-clr: rgba(46, 204, 113, 0.15); 
        --pending-bg-clr: rgba(255, 255, 0, 0.15); 
        --input-focus-clr: rgba(94, 99, 255, 0.1);

        } 
        
        /* move class animation */
        .move_in{
            opacity: 0;
            transform: translateY(80px);
            transition: opacity 0.6s ease-out, transform 0.8s ease-out;
        }
        .move_in.visible{
            opacity: 1;
            transform: translateY(0);
        }











        @media screen and (min-width: 1024px) {
        :root {
            --normal-font-size: 1rem;
            --small-font-size: .875rem;
            --smaller-font-size: .813rem;
        }
        }

        /*=============== BASE ===============*/
        * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        }
        html{
            scroll-behavior: smooth;
            scrollbar-width: none;
            -webkit-scrollbar-width: none;
        }

        body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;    
        font-size: var(--normal-font-size);
        background-color: var(--base-clr);
        color: var(--text-clr);
        }

        ul {
        list-style: none;
        }

        a {
        text-decoration: none;
        }

        /*=============== REUSABLE CSS CLASSES ===============*/
        .nav-container {
        max-width: 1120px;
        margin-inline: 1.5rem;
        }

        /*=============== HEADER ===============*/
        .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        box-shadow: 0 2px 8px #171921;
        background-color: var(--base-clr);
        /* border-bottom: 1px solid var(--line-clr); */
        z-index: var(--z-fixed);
        }

        /*=============== NAV ===============*/
        .nav {
        height: var(--header-height);
        }
        .nav__data {
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }
        .nav__logo {
        display: inline-flex;
        align-items: center;
        column-gap: 0.25rem;
        color: var(--text-clr);
        font-weight: var(--font-semi-bold);
        transition: color 0.3s;
        }
        .nav__logo i {
        font-size: 1.25rem;
        }
        .nav__logo:hover {
        color: var(--accent-clr);
        }
        .nav__toggle {
        position: relative;
        width: 32px;
        height: 32px;
        }
        .nav__toggle-menu, .nav__toggle-close {
        font-size: 1.25rem;
        color: var(--text-clr);
        position: absolute;
        display: grid;
        place-items: center;
        inset: 0;
        cursor: pointer;
        transition: opacity 0.1s, transform 0.4s;
        }
        .nav__toggle-close {
            opacity: 0;
            border-radius: 50%;
            background: var(--hover-clr);
        }
        .nav__toggle-close:hover{

        }

        @media screen and (max-width: 1118px) {
        .header {
            padding-block: 8px;
        }
        .nav__menu {
            background-color: var(--base-clr);
            position: absolute;
            left: 0;
            top: 2.5rem;
            width: 100%;
            height: calc(100vh - 3.5rem);
            overflow: auto;
            padding-block: 1.5rem 4rem;
            pointer-events: none;
            opacity: 0;
            transition: top 0.4s, opacity 0.3s;
        }
        .nav__menu::-webkit-scrollbar {
            width: 0.5rem;
        }
        .nav__menu::-webkit-scrollbar-thumb {
            background-color: hsl(220, 12%, 70%);
        }
        }
        .nav__link {
        color: var(--text-clr);
        font-weight: var(--font-semi-bold);
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.3s;
        }
        .nav__link:hover {
        background-color: var(--hover-clr);
        }
        .home-link:hover{
            color: var(--accent-clr);
        }

        /* Show menu */
        .show-menu {
        opacity: 1;
        top: 3.5rem;
        pointer-events: initial;
        }

        /* Show icon */
        .show-icon .nav__toggle-menu {
        opacity: 0;
        transform: rotate(90deg);
        }

        .show-icon .nav__toggle-close {
        opacity: 1;
        transform: rotate(90deg);
        }

        /*=============== DROPDOWN ===============*/
        .dropdown__button {
        cursor: pointer;
        }
        .dropdown__arrow {
        font-size: 1.5rem;
        font-weight: initial;
        transition: transform 0.4s;
        }
        .dropdown__content, .dropdown__group, .dropdown__list {
        display: grid;
        }
        .dropdown__container {
        background-color: var(--hover-clr);
        height: 0;
        overflow: hidden;
        transition: height 0.7s;
        }
        .dropdown__content {
        row-gap: 1.75rem;
        }
        .dropdown__group {
        padding-left: 2.5rem;
        row-gap: 0.5rem;
        }
        .dropdown__group:first-child {
        margin-top: 1.25rem;
        }
        .dropdown__group:last-child {
        margin-bottom: 1.25rem;
        }
        .dropdown__icon i {
        font-size: 1.25rem;
        color: var(--accent-clr);
        }
        .dropdown__title {
        font-size: var(--small-font-size);
        font-weight: var(--font-semi-bold);
        color: var(--t);
        }
        .dropdown__list {
        row-gap: 0.25rem;
        }
        .dropdown__link {
        font-size: var(--smaller-font-size);
        font-weight: var(--font-medium);
        color: var(--secondary-text-clr);
        transition: color 0.3s;
        }
        .dropdown__link:hover {
        color: var(--accent-clr);
        }

        /* Rotate dropdown icon */
        .show-dropdown .dropdown__arrow {
        transform: rotate(180deg);
        }

        /*=============== BREAKPOINTS ===============*/
        /* For small devices */
        @media screen and (max-width: 300px) {
        .dropdown__group {
            padding-left: 1.5rem;
        }
        }
        /* For large devices */
        @media screen and (min-width: 1118px) {
    

        /* Nav */
        .nav {
            height: calc(var(--header-height) + 2rem);
            display: flex;
            justify-content: space-between;
        }
        .nav__toggle {
            display: none;
        }
        .nav__list {
            display: flex;
            column-gap: 3rem;
            height: 100%;
        }
        .nav li {
            display: flex;
        }
        .nav__link {
            padding: 0;
        }
        .nav__link:hover {
            background-color: initial;
        }

        /* Dropdown */
        .dropdown__button {
            column-gap: 0.25rem;
            pointer-events: none;
        }
        .dropdown__container {
            height: max-content;
            position: absolute;
            left: 0;
            right: 0;
            top: 6.5rem;
            background-color: var(--base-clr);
            box-shadow: 0 2px 8px #171921;

            pointer-events: none;
            opacity: 0;
            transition: top 0.4s, opacity 0.3s;
        }
        .dropdown__content {
            grid-template-columns: repeat(4, max-content);
            column-gap: 6rem;
            max-width: 1120px;
            margin-inline: auto;
        }
        .dropdown__group {
            padding: 4rem 0;
            align-content: baseline;
            row-gap: 1.25rem;
        }
        .dropdown__group:first-child, .dropdown__group:last-child {
            margin: 0;
        }
        .dropdown__list {
            row-gap: 0.75rem;
        }
        .dropdown__icon {
            width: 60px;
            height: 60px;
            background-color: var(--hover-clr);
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin-bottom: 1rem;
        }
        .dropdown__icon i {
            font-size: 2rem;
        }
        .dropdown__title {
            font-size: var(--normal-font-size);
        }
        .dropdown__link {
            font-size: var(--small-font-size);
        }
        .dropdown__link:hover {
            color: var(--accent-clr);
        }
        .dropdown__item {
            cursor: pointer;
        }
        .dropdown__item:hover .dropdown__arrow {
            transform: rotate(180deg);
        }
        .dropdown__item:hover > .dropdown__container {
            top: 5.5rem;
            opacity: 1;
            pointer-events: initial;
            cursor: initial;
        }
        }
        @media screen and (min-width: 1152px) {
        .nav-container {
            margin-inline: auto;
        }
        }

        @media screen and (max-width: 500px) {
            .button-li{
                padding-inline: 20px;
                margin-top: 10px;
            }
        }
        @media screen and (max-width: 430px) {
            .button-li{
                flex-direction: column;
                gap: 10px;
                padding-inline: 10px;
            }
        }
`;

const css = document.createElement('style');
css.appendChild(document.createTextNode(Styles));
document.head.appendChild(css);