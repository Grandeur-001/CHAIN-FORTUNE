
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <title>Chain Fortune</title>
    <?php 
        include "../components/index_style.php";
    ?>
</head>
<body>
    <?php 
        include "../components/index_header.php";
    ?>
    <div style="margin-top: 5rem;"></div>
    <!-- banner start -->
    <section class="banner">
        <div class="banner-content">
            <h1>Trade Crypto with Confidence</h1>
            <p class="subtitle">Experience secure, professional, and efficient cryptocurrency trading with <?php include("../components/company_name.php"); ?></p>
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-value">$2.5B+</span>
                    <span class="stat-label">Daily Volume</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">150+</span>
                    <span class="stat-label">Cryptocurrencies</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">2M+</span>
                    <span class="stat-label">Active Traders</span>
                </div>
            </div>
            <div class="banner-cta move_in">
                <?php 
                    $buttonFilledText = "Start Trading";
                    $buttonFilledHref = "/chain-fortune/auth/login";
                    include("../components/button_filled.php"); 

                    $buttonOutlinedText = "View Markets";
                    $buttonOutlinedHref = "../page/markets";
                    include("../components/button_outlined.php"); 
                ?>
                <!-- <button onclick="location.href=`/chain-fortune/auth/login`" class="btn primary">Start Trading</button> -->
                <!-- <button class="btn secondary">View Markets</button> -->
            </div>
        </div>
        <div class="market-ticker move_in">
            <div class="ticker-item positive">
                <span class="coin">BTC/USD</span>
                <span class="price">$48,235.50</span>
                <span class="change">+2.45%</span>
            </div>
            <div class="ticker-item negative">
                <span class="coin">ETH/USD</span>
                <span class="price">$2,854.20</span>
                <span class="change">-0.82%</span>
            </div>
            <div class="ticker-item positive">
                <span class="coin">SOL/USD</span>
                <span class="price">$102.75</span>
                <span class="change">+5.31%</span>
            </div>

        </div>
    </section>
    <!-- banner end -->



    <!-- sections wrapper start -->
    <div class="sections-wrapper" style="overflow: hidden;">
        <div style="padding-top: 2rem;">
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Our Features";
                $headText = "Our Features";
                include("../components/heading_text.style.php");
                include("../components/heading_text.php");
                
            ?>
        </div>
        <!-- features start-->
        <div class="features card-wrapper" id="feature-card-wrapper">
            <div w3-repeat="featureCard" class="move_in feature-card card">
                <div class="icon">{{icon}}</div>
                <h3> {{title}} </h3>
                <p> {{paragraph}} </p>
            </div>
        </div>
        
        <script>
            let featureCardObject = {"featureCard":[
                {
                    "icon": `<svg width="79" height="48" fill="#5e63ff" xmlns="http://www.w3.org/2000/svg"><path d="M47.395 36.778l-1.641-.233a7.285 7.285 0 0 0-.484-1.167l.996-1.327a.704.704 0 0 0-.065-.92l-1.812-1.814a.704.704 0 0 0-.921-.065l-1.326.996a7.293 7.293 0 0 0-1.165-.483l-.233-1.643a.704.704 0 0 0-.697-.605h-2.563a.704.704 0 0 0-.697.605l-.233 1.643a7.297 7.297 0 0 0-1.166.483l-1.149-.864a12.19 12.19 0 0 0 3.104-6.76h.298a.704.704 0 1 0 0-1.41h-.207l.002-.12c0-1.094-.144-2.179-.426-3.225a.705.705 0 1 0-1.36.367c.25.927.377 1.888.377 2.858a10.84 10.84 0 0 1-3.39 7.916l-.012.012c-.089.089-2.185 2.203-2.816 4.414-.14.489-.22 1.22-.268 1.923a.699.699 0 0 0-.01.117v.04c-.027.434-.041.85-.049 1.182h-1.998a53.864 53.864 0 0 1-.167-4.964c.02-1.089.082-1.985.17-2.722.915-.14 1.908-.383 2.613-.806 1.28-.767 1.55-2.323 1-3.295-.433-.766-1.496-1.362-3.067-.524-.803.428-1.362 1.41-1.707 3.002-.025.113-.049.23-.071.349-.48.04-.892.055-1.153.053a14 14 0 0 1-1.15-.053c-.023-.12-.046-.236-.071-.35-.346-1.59-.904-2.573-1.707-3.001-1.571-.838-2.635-.242-3.068.524-.286.504-.35 1.145-.179 1.759a2.61 2.61 0 0 0 1.18 1.536c.705.423 1.698.666 2.613.806.088.737.15 1.633.17 2.722a53.862 53.862 0 0 1-.167 4.964h-1.999c-.02-.907-.09-2.433-.327-3.262-.627-2.2-2.726-4.324-2.815-4.413l-.013-.013a10.842 10.842 0 0 1-3.39-7.916c0-6.029 4.901-10.933 10.924-10.933 3.963 0 7.623 2.155 9.552 5.625a.704.704 0 1 0 1.232-.685 12.342 12.342 0 0 0-2.754-3.371h.823a.705.705 0 0 0 0-1.41h-.94a.705.705 0 0 0-.7.765 12.33 12.33 0 0 0-6.536-2.313l-2.164-.308a10.532 10.532 0 0 0-.864-2.088l1.62-2.159a.704.704 0 0 0-.065-.92l-2.706-2.71a.704.704 0 0 0-.922-.065l-2.156 1.622a10.523 10.523 0 0 0-2.087-.865L16.057.606A.705.705 0 0 0 15.36 0h-3.828a.704.704 0 0 0-.697.606l-.38 2.673c-.724.213-1.423.502-2.086.865L6.213 2.522a.705.705 0 0 0-.922.065L2.585 5.296a.704.704 0 0 0-.065.92l1.62 2.16a10.542 10.542 0 0 0-.864 2.088l-2.67.38A.705.705 0 0 0 0 11.54v3.831c0 .35.258.648.605.698l2.671.379c.213.726.502 1.425.865 2.088l-1.621 2.16a.705.705 0 0 0 .065.92l2.706 2.709a.705.705 0 0 0 .922.065l2.157-1.622a10.52 10.52 0 0 0 2.086.865l.379 2.674c.05.347.346.605.697.605h1.836a12.267 12.267 0 0 0 3.221 5.11c.108.11 1.937 1.988 2.453 3.8.234.82.283 2.861.282 3.578v2.359a3.225 3.225 0 0 0 2.578 3.156 3.215 3.215 0 0 0 3.145 2.571h.113a3.215 3.215 0 0 0 3.145-2.57 3.225 3.225 0 0 0 2.578-3.157v-.916l.894.127c.127.403.289.793.483 1.168l-.996 1.326a.704.704 0 0 0 .065.921l1.812 1.814a.705.705 0 0 0 .922.065l1.325-.997a7.28 7.28 0 0 0 1.166.483l.233 1.644c.05.347.346.605.697.605h2.563c.35 0 .648-.258.697-.605l.233-1.643a7.284 7.284 0 0 0 1.166-.484l1.325.997c.28.21.673.183.922-.065l1.812-1.814a.705.705 0 0 0 .065-.92l-.996-1.327c.194-.375.356-.765.483-1.168l1.64-.233A.704.704 0 0 0 48 40.04v-2.565a.705.705 0 0 0-.605-.698zM28.696 27.63c.17-.091.492-.24.767-.24.17 0 .322.056.412.215.192.34.096 1.035-.5 1.392-.413.249-1.012.423-1.64.544.336-1.433.777-1.813.961-1.911zm-7.865 1.367c-.596-.357-.692-1.051-.5-1.392.09-.16.243-.215.412-.215.276 0 .597.148.768.24.183.098.624.478.96 1.911-.627-.12-1.225-.295-1.64-.544zm-8.687-3.493l-.359-2.528a.704.704 0 0 0-.53-.585 9.12 9.12 0 0 1-2.571-1.066.704.704 0 0 0-.79.039l-2.039 1.533-1.842-1.843 1.533-2.042a.705.705 0 0 0 .04-.789A9.136 9.136 0 0 1 4.52 15.65a.704.704 0 0 0-.585-.53l-2.526-.36v-2.607l2.526-.36a.705.705 0 0 0 .585-.53A9.135 9.135 0 0 1 5.585 8.69a.705.705 0 0 0-.039-.789L4.013 5.86l1.842-1.844 2.04 1.534c.23.173.543.188.789.039a9.121 9.121 0 0 1 2.571-1.067c.28-.068.49-.3.53-.585l.359-2.528h2.604l.359 2.528c.04.285.25.517.53.585a9.124 9.124 0 0 1 2.571 1.067c.247.15.56.134.79-.04l2.039-1.533 1.842 1.844-1.533 2.04a.705.705 0 0 0-.04.789c.45.741.79 1.54 1.015 2.378-1.164.27-2.265.706-3.278 1.28-.322-2.773-2.683-4.934-5.54-4.934a5.57 5.57 0 0 0-4.646 2.493.705.705 0 0 0 1.173.78 4.164 4.164 0 0 1 3.474-1.864 4.176 4.176 0 0 1 4.16 4.434 12.43 12.43 0 0 0-3.33 3.83 4.176 4.176 0 0 1-5-4.09.705.705 0 0 0-1.409 0 5.587 5.587 0 0 0 5.579 5.582l.122-.002a12.288 12.288 0 0 0-.855 4.516c0 .82.08 1.627.233 2.411h-.86zm20.116 9.874a7.297 7.297 0 0 0-.483 1.167l-.759.108c.038-.328.086-.62.146-.83.117-.41.3-.822.517-1.217l.58.772zm-7.962-1.658a30.254 30.254 0 0 0-.144-2.555c.535.034.905.036.948.035.044 0 .414 0 .95-.035a30.46 30.46 0 0 0-.144 2.555 54.491 54.491 0 0 0 .162 4.978h-1.933c.08-1.03.197-2.95.161-4.978zm.861 12.358h-.112a1.803 1.803 0 0 1-1.657-1.098h3.426a1.803 1.803 0 0 1-1.657 1.098zm4.315-4.318c0 .999-.812 1.811-1.81 1.811h-5.122c-.998 0-1.81-.812-1.81-1.811v-1.653h8.742v1.653zm17.117-2.331l-1.49.212a.704.704 0 0 0-.586.53 5.882 5.882 0 0 1-.686 1.658.705.705 0 0 0 .039.788l.905 1.206-.948.948-1.203-.905a.704.704 0 0 0-.79-.04 5.87 5.87 0 0 1-1.655.687c-.28.069-.49.3-.53.586l-.212 1.492h-1.34l-.211-1.492a.704.704 0 0 0-.53-.586 5.875 5.875 0 0 1-1.656-.686.705.705 0 0 0-.79.039l-1.203.905-.947-.948.905-1.206a.705.705 0 0 0 .039-.788 5.885 5.885 0 0 1-.686-1.658.705.705 0 0 0-.586-.53l-1.49-.212v-1.342l1.49-.211a.704.704 0 0 0 .586-.53 5.883 5.883 0 0 1 .686-1.658.704.704 0 0 0-.04-.789l-.904-1.205.947-.949 1.204.906c.23.173.543.188.789.038a5.876 5.876 0 0 1 1.656-.686c.28-.068.49-.3.53-.585l.212-1.493h1.339l.212 1.493c.04.285.25.517.53.585a5.882 5.882 0 0 1 1.656.687c.246.15.558.134.789-.04l1.203-.904.948.948-.905 1.205a.705.705 0 0 0-.04.789 5.88 5.88 0 0 1 .687 1.657c.068.28.3.49.585.53l1.491.212v1.342z" fill="#5e63ff"/><path d="M38.765 34.622a4.14 4.14 0 0 0-4.133 4.136.705.705 0 1 0 1.409 0 2.729 2.729 0 0 1 2.725-2.727 2.729 2.729 0 0 1 2.724 2.727 2.729 2.729 0 0 1-2.724 2.728 2.719 2.719 0 0 1-1.806-.685.704.704 0 1 0-.935 1.054 4.13 4.13 0 0 0 2.74 1.04 4.14 4.14 0 0 0 4.134-4.137 4.14 4.14 0 0 0-4.134-4.136zM36.304 13.73h.94a.705.705 0 0 0 0-1.41h-.94a.704.704 0 1 0 0 1.41zm6.066.68c.233.141.455.303.66.482.31.27.797.21 1.036-.122a.71.71 0 0 0-.11-.941 6.198 6.198 0 0 0-.856-.624.705.705 0 0 0-.73 1.206zm-2.778-.68c.297 0 .59.012.887.031a.712.712 0 0 0 .751-.625.704.704 0 0 0-.622-.777 9.18 9.18 0 0 0-1.016-.038.704.704 0 1 0 0 1.409zm1.202 9.405a4.78 4.78 0 0 1-.813.079.705.705 0 0 0 .008 1.409h.008a6.184 6.184 0 0 0 1.054-.103.705.705 0 0 0-.257-1.385zm2.489-1.32a4.774 4.774 0 0 1-.623.529.711.711 0 0 0-.209.915.71.71 0 0 0 1.024.234 6.14 6.14 0 0 0 .808-.684.705.705 0 0 0-1-.994zm1.509-.805a.711.711 0 0 0 .904-.42 6.13 6.13 0 0 0 .277-1.023.705.705 0 0 0-1.387-.25c-.048.268-.12.533-.213.788a.705.705 0 0 0 .42.904zm-.55-4.49c.113.247.203.506.27.77a.711.711 0 0 0 .884.5.711.711 0 0 0 .482-.85 6.129 6.129 0 0 0-.352-1.001.704.704 0 1 0-1.284.58zM3.325 29.065a.705.705 0 0 0-.909.408 6.14 6.14 0 0 0-.29 1.02.705.705 0 0 0 1.384.266c.052-.267.127-.531.223-.785a.704.704 0 0 0-.408-.909zm2.342 6.628a4.781 4.781 0 0 1-.654-.49.705.705 0 0 0-.938 1.052c.264.234.55.448.848.634a.71.71 0 0 0 1.008-.295.711.711 0 0 0-.264-.901zm6.05.71h-.94a.705.705 0 0 0 0 1.409h.94a.705.705 0 0 0 0-1.41zm3.287 0h-.939a.705.705 0 0 0 0 1.409h.94a.705.705 0 0 0 0-1.41zm3.288 0h-.94a.705.705 0 0 0 0 1.409h.94a.705.705 0 0 0 0-1.41zM3.82 33.561a4.733 4.733 0 0 1-.26-.773.705.705 0 0 0-1.37.333c.084.343.198.681.34 1.005a.71.71 0 0 0 .975.34.711.711 0 0 0 .316-.905zm4.609 2.842c-.285 0-.568 0-.851-.036a.705.705 0 1 0-.173 1.399 8.55 8.55 0 0 0 1.024.046.705.705 0 1 0 0-1.409zM4.35 28.48a.702.702 0 0 0 .494-.203c.194-.19.406-.366.63-.52a.705.705 0 0 0-.802-1.16c-.29.2-.564.428-.816.675-.44.432-.125 1.207.494 1.207zm2.999-1.492c.266-.046.54-.07.814-.07a.704.704 0 1 0 0-1.409 6.2 6.2 0 0 0-1.055.09.71.71 0 0 0-.576.802c.06.384.433.653.817.587z" fill="#5e63ff"/></svg>`,
                    "title":"Constant Innovation",
                    "paragraph":"<?php include("../components/company_name.php"); ?> is always evolving, consistently enhancing the trading experience to make it seamless, intuitive, and user-friendly."
                },

                {
                    "icon": `<svg width="48" height="47" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M47.374 28.659l.007-.003-7.717-16.836 1.872-.932-.7-1.402-1.825.909-.247-.538a.783.783 0 0 0-1.424 0l-.22.48a10.077 10.077 0 0 0-4.238-.937h-6.58V7.833h1.567V6.267h-1.347l.564-2.254a3.23 3.23 0 1 0-6.267 0l.563 2.253h-1.346v1.567h1.566V9.4h-6.576a10.076 10.076 0 0 0-4.241.94l-.22-.481a.783.783 0 0 0-1.425 0l-.246.538-1.825-.913-.7 1.404 1.871.935L.524 28.656a.765.765 0 0 0-.071.327 5.49 5.49 0 0 0 5.483 5.483h7.833a5.49 5.49 0 0 0 5.483-5.483.765.765 0 0 0-.078-.324l-7.738-16.9a8.522 8.522 0 0 1 3.59-.793h6.576v28.66L18.928 42.3H16.12a3.921 3.921 0 0 0-3.917 3.916c0 .433.351.784.784.784H34.92a.783.783 0 0 0 .783-.784 3.921 3.921 0 0 0-3.916-3.916h-2.81l-2.674-2.675V10.966h6.58c1.24 0 2.465.27 3.59.793l-7.748 16.897a.765.765 0 0 0-.072.327 5.49 5.49 0 0 0 5.484 5.483h7.833a5.49 5.49 0 0 0 5.483-5.483.762.762 0 0 0-.078-.324zm-33.605 4.24H5.936a3.923 3.923 0 0 1-3.838-3.133h15.51a3.923 3.923 0 0 1-3.839 3.134zm3.48-4.7H2.456l7.196-15.698c.131.035.27.035.401 0L17.249 28.2zm5.393-25.993a1.714 1.714 0 0 1 2.62 0c.318.403.43.93.304 1.427l-.659 2.634h-1.91l-.658-2.634a1.654 1.654 0 0 1 .303-1.427zm.527 7.194V7.833h1.567V9.4h-1.567zm1.567 1.566v28.2h-1.567v-28.2h1.567zm7.05 32.9a2.354 2.354 0 0 1 2.216 1.567H13.903a2.355 2.355 0 0 1 2.216-1.567h15.667zM26.76 42.3h-5.618l1.567-1.567h2.485L26.76 42.3zm11.09-29.797a.53.53 0 0 0 .395-.016L45.448 28.2H30.656l7.194-15.697zM41.968 32.9h-7.833a3.923 3.923 0 0 1-3.839-3.134h15.51A3.923 3.923 0 0 1 41.97 32.9z" fill="#5e63ff"/></svg>`,
                    "title":"Trustworthy & Transparent",
                    "paragraph":"Our platform is built on a foundation of trust, offering transparent processes and clear communication to ensure you always know where your investments stand."
                },

                {
                    "icon": `<svg width="40" height="47" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M38.942 8.116c-6.329-1.772-12.695-4.53-18.41-7.979a.95.95 0 0 0-.984 0C13.668 3.684 7.646 6.294 1.137 8.116a.985.985 0 0 0-.712.953v10.102c0 10.403 4.697 17.289 8.637 21.233C13.304 44.651 18.246 47 20.04 47c1.794 0 6.735-2.349 10.977-6.596 3.94-3.944 8.637-10.83 8.637-21.233V9.07a.985.985 0 0 0-.712-.953zM37.72 19.17c0 9.716-4.381 16.142-8.056 19.821-4.172 4.176-8.632 6.03-9.623 6.03-.991 0-5.452-1.854-9.623-6.03-3.676-3.68-8.057-10.105-8.057-19.82V9.82c6.224-1.806 12.021-4.326 17.68-7.686C25.558 5.405 31.643 8.05 37.719 9.82v9.351z" fill="#5e63ff"/><path d="M11.463 9.71a.961.961 0 0 0-1.255-.558 77.63 77.63 0 0 1-5.274 1.904.987.987 0 0 0-.678.943v3.818c0 .546.434.988.968.988a.978.978 0 0 0 .968-.988V12.72a79.573 79.573 0 0 0 4.725-1.73.995.995 0 0 0 .546-1.282zm1.837.187a.95.95 0 0 0 .389-.084l.018-.007c.49-.22.71-.802.495-1.302a.962.962 0 0 0-1.277-.507l-.015.007a.995.995 0 0 0-.497 1.3.968.968 0 0 0 .888.593zM31.568 31.88a.955.955 0 0 0-1.339.286 23.978 23.978 0 0 1-2.78 3.549c-.863.91-1.796 1.76-2.776 2.523a1.003 1.003 0 0 0-.183 1.386.96.96 0 0 0 .77.389.95.95 0 0 0 .586-.203 26.875 26.875 0 0 0 2.994-2.72 25.93 25.93 0 0 0 3.01-3.842 1.002 1.002 0 0 0-.282-1.369zm-9.143 7.909l-.055.033a1 1 0 0 0-.353 1.351c.18.317.505.494.839.494a.946.946 0 0 0 .483-.134l.065-.038a1 1 0 0 0 .346-1.353.957.957 0 0 0-1.325-.353zm-8.981-18.307a3.092 3.092 0 0 0-2.225-.94c-.84 0-1.63.333-2.225.94a3.269 3.269 0 0 0 0 4.547l5.714 5.838a3.093 3.093 0 0 0 2.225.941c.84 0 1.63-.334 2.225-.941L31.085 19.68a3.269 3.269 0 0 0 0-4.547 3.092 3.092 0 0 0-2.225-.941c-.84 0-1.63.334-2.225.941l-9.702 9.914-3.489-3.565zm14.56-4.95a1.19 1.19 0 0 1 1.713 0 1.258 1.258 0 0 1 0 1.75L17.789 30.469a1.19 1.19 0 0 1-1.713 0l-5.713-5.838a1.258 1.258 0 0 1 0-1.75 1.192 1.192 0 0 1 1.713 0l4.172 4.263a.956.956 0 0 0 1.368 0l10.388-10.613z" fill="#5e63ff"/></svg>`,
                    "title":"Advanced Security Measures",
                    "paragraph":"We employ industry-leading security protocols, including two-factor authentication and encryption, to safeguard your funds and personal data from any threats."
                },

                {
                    "icon": `<svg width="44" height="44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.352 32.313c.38 0 .688.307.688.687h1.375a2.065 2.065 0 0 0-2.063-2.063v-1.375H8.977v1.375H6.915V33c0 1.137.925 2.063 2.062 2.063h1.375c.38 0 .688.307.688.687v.688H8.977a.688.688 0 0 1-.687-.688H6.915c0 1.137.925 2.063 2.062 2.063v1.374h1.375v-1.374h2.063V35.75a2.065 2.065 0 0 0-2.063-2.063H8.977A.688.688 0 0 1 8.29 33v-.688h2.062z" fill="#5e63ff"/><path d="M43.352 9.625V.687h-8.937v1.375h6.59l-12.09 12.09-4.813-4.812-8.237 8.237a2.715 2.715 0 0 0-1.388-.39c-.914 0-1.4.555-1.721.922-.3.343-.42.453-.687.453-.268 0-.387-.11-.688-.453-.322-.367-.807-.922-1.72-.922-.914 0-1.399.556-1.72.923-.3.342-.419.453-.685.453-.267 0-.386-.111-.685-.453-.32-.367-.806-.922-1.719-.922a2.753 2.753 0 0 0-2.2 4.4l3.33 4.44-2.275 1.99a8.728 8.728 0 0 0-2.98 6.568c0 4.812 3.915 8.727 8.726 8.727h.422c1.74 0 3.358-.518 4.721-1.399a2.06 2.06 0 0 0 1.944 1.398h24.75a2.065 2.065 0 0 0 2.062-2.062v-1.375c0-.53-.207-1.01-.536-1.375.33-.366.536-.845.536-1.375V35.75c0-.53-.207-1.01-.536-1.375.33-.366.536-.845.536-1.375v-1.375c0-.53-.207-1.01-.536-1.375.33-.366.536-.845.536-1.375V27.5a2.065 2.065 0 0 0-2.062-2.063h-.688v-13.75h-5.5v13.75h-1.375v-6.875h-5.5v6.875h-.687c-.242 0-.472.05-.688.127v-9.752h-5.5v13.75h-4.351a8.704 8.704 0 0 0-1.38-1.544l-2.274-1.99 3.33-4.44a2.77 2.77 0 0 0 .55-1.65c0-.51-.148-.98-.39-1.389l7.265-7.264 4.813 4.812L41.977 3.035v6.59h1.375zM16.54 41.938a.688.688 0 0 1-.688-.688v-.322a8.76 8.76 0 0 0 1.375-1.66v1.294h1.375v-1.374h1.375v1.374h1.375v-1.374h1.375v1.374h1.375v-1.374h1.375v1.374h1.375v-1.374h1.375v1.374h1.375v-1.374h.688c.38 0 .687.307.687.687v1.375c0 .38-.308.688-.687.688H16.54zm2.038-6.876h1.4v1.376h1.374v-1.376h1.375v1.376h1.375v-1.376h1.375v1.376h1.375v-1.376h1.375v1.376h1.375v-1.376h.688c.38 0 .687.309.687.688v1.375c0 .38-.308.688-.687.688H17.976a8.673 8.673 0 0 0 .602-2.75zm16.524-2.75v-1.374h1.375v1.375h1.375v-1.376h1.375v1.375h1.375v-1.374h.688c.38 0 .687.308.687.687V33c0 .38-.308.688-.687.688h-9.064a2.04 2.04 0 0 0 .126-.688v-1.375c0-.242-.05-.472-.126-.688h1.501v1.375h1.375zm6.875 3.438v1.375c0 .38-.308.688-.687.688h-9.064a2.04 2.04 0 0 0 .126-.688V35.75c0-.242-.05-.472-.126-.688h1.501v1.376h1.375v-1.376h1.375v1.376h1.375v-1.376h1.375v1.376h1.375v-1.376h.688c.38 0 .687.309.687.688zm0 5.5c0 .38-.308.688-.687.688h-9.064a2.04 2.04 0 0 0 .126-.688v-1.375c0-.242-.05-.472-.126-.688h1.501v1.376h1.375v-1.376h1.375v1.376h1.375v-1.376h1.375v1.376h1.375v-1.376h.688c.38 0 .687.309.687.688v1.375zm-5.5-28.188h2.75v12.376h-2.75V13.063zm-6.875 6.876h2.75v5.5h-2.75v-5.5zm-2.062 6.875h.687v1.375h1.375v-1.375h1.375v1.375h1.375v-1.375h1.375v1.375h1.375v-1.375h1.375v1.375h1.375v-1.375h1.375v1.375h1.375v-1.375h.688c.38 0 .687.308.687.687v1.375c0 .38-.308.688-.687.688H27.54a.688.688 0 0 1-.688-.688V27.5c0-.38.308-.688.688-.688zm-4.813-9.625h2.75v12.375h-2.75V17.188zm-2.75 13.75v1.375h1.375v-1.376h1.375v1.375h1.375v-1.374h1.375v1.375h1.375v-1.376h1.375v1.375h1.375v-1.374h.688c.38 0 .687.308.687.687V33c0 .38-.308.688-.687.688H18.554a8.712 8.712 0 0 0-.754-2.75h2.177zm-2.75 3.648c0 4.054-3.298 7.352-7.351 7.352h-.422c-4.054 0-7.352-3.298-7.352-7.352 0-2.12.915-4.137 2.51-5.533l2.561-2.24h4.983l2.561 2.24a7.354 7.354 0 0 1 2.51 5.533zm-1.65-13.823l-3.506 4.674H7.258l-3.506-4.675a1.376 1.376 0 0 1 1.1-2.2c.267 0 .386.111.684.453.321.367.807.922 1.72.922.913 0 1.398-.555 1.72-.922.299-.342.418-.453.684-.453.268 0 .387.111.687.454.322.367.807.922 1.722.922.913 0 1.399-.555 1.72-.922.301-.343.42-.453.688-.453a1.376 1.376 0 0 1 1.1 2.2z" fill="#5e63ff"/></svg>`,
                    "title":"Pure ECN",
                    "paragraph":"<?php include("../components/company_name.php"); ?> offers Electronic Communication Network technology, which seeks to guarantee that traders always trade under the best trading conditions."
                },
                {
                    "icon": `<svg style="scale: 1.3;" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 150 150" fill="none">
                                <circle cx="45" cy="75" r="20" fill="#5e63ff"/>
                                <path d="M45 55 L48 58 L52 56 L53 52 L56 53 L58 48 L55 45 L58 42 L56 38 L52 37 L53 33 L48 32 L45 35 L42 32 L38 33 L37 37 L33 38 L32 42 L35 45 L32 48 L33 53 L37 52 L38 56 L42 58 L45 55" fill="#5e63ff" opacity="0.5"/>

                                <circle cx="105" cy="75" r="20" fill="#5e63ff"/>
                                <path d="M105 55 L108 58 L112 56 L113 52 L116 53 L118 48 L115 45 L118 42 L116 38 L112 37 L113 33 L108 32 L105 35 L102 32 L98 33 L97 37 L93 38 L92 42 L95 45 L92 48 L93 53 L97 52 L98 56 L102 58 L105 55" fill="#5e63ff" opacity="0.5"/>

                                <circle cx="75" cy="105" r="15" fill="#5e63ff"/>
                                <path d="M75 90 L77 92 L80 91 L81 88 L83 89 L84 85 L82 83 L84 81 L83 78 L80 77 L81 74 L77 73 L75 76 L72 73 L69 74 L68 77 L64 78 L63 81 L66 83 L63 85 L64 89 L68 88 L69 91 L72 92 L75 90" fill="#5e63ff" opacity="0.5"/>
                            </svg>`,

                    "title":"Programmatic Execution",
                    "paragraph":"Our team can tailor execution to meet your requirements in a timely manner."
                },
                {
                    "icon": `<svg style="scale: 1.4;" xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                                <path d="M40 40 L50 40 L50 50 L60 50 L60 60 L50 60 L50 70 L40 70 L40 60 L30 60 L30 50 L40 50 Z" fill="#5e63ff"/>
                                <path d="M110 40 L100 40 L100 50 L90 50 L90 60 L100 60 L100 70 L110 70 L110 60 L120 60 L120 50 L110 50 Z" fill="#5e63ff"/>

                                <path d="M85 110 L65 90 L75 80 L85 90 L95 80 L105 90 L95 100 L85 110 Z" fill="#5e63ff" stroke="#5e63ff" stroke-width="2"/>
                                <path d="M60 90 L50 100 L55 105 L65 95 Z" fill="#5e63ff"/>
                                
                                <line x1="50" y1="40" x2="50" y2="50" stroke="#5e63ff" stroke-width="2"/>
                                <line x1="60" y1="50" x2="60" y2="60" stroke="#5e63ff" stroke-width="2"/>
                                <line x1="50" y1="60" x2="50" y2="70" stroke="#5e63ff" stroke-width="2"/>
                                <line x1="40" y1="60" x2="40" y2="70" stroke="#5e63ff" stroke-width="2"/>
                            </svg>`,
                    "title":"Bespoke Solutions",
                    "paragraph":"Our team can work with you to design solutions that are specific to your mandate and requirements."
                }
            ]};
            w3.displayObject("feature-card-wrapper", featureCardObject);
        </script>
        <!-- features end -->


        <!-- company profile start-->
        <div>
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Company Profile";
                $headText = "Company Profile";
                include ("../components/heading_text.style.php");
                include("../components/heading_text.php");
            ?>
        </div>
         <div class="card-wrapper2">
            <div class="move_in image-card">
                <div class="col-md-6" > 
                    <!-- state banner -->
                    <style>
                        .col-md-6 {
                            width: 100%;
                        }
                        .carousel {
                        position: relative;
                        width: 100%;
                        overflow: hidden;
                        }

                        .carousel-inner {
                        position: relative;
                        width: 100%;
                        }

                        .carousel-item {
                        position: relative;
                        display: none;
                        -ms-flex-align: center;
                        align-items: center;
                        width: 100%;
                        transition: -webkit-transform 0.6s ease;
                        transition: transform 0.6s ease;
                        transition: transform 0.6s ease, -webkit-transform 0.6s ease;
                        -webkit-backface-visibility: hidden;
                        backface-visibility: hidden;
                        -webkit-perspective: 1000px;
                        perspective: 1000px;
                        }

                        @media screen and (prefers-reduced-motion: reduce) {
                        .carousel-item {
                            transition: none;
                        }
                        }

                        .carousel-item.active,
                        .carousel-item-next,
                        .carousel-item-prev {
                        display: block;
                        }

                        .carousel-item-next,
                        .carousel-item-prev {
                        position: absolute;
                        top: 0;
                        }

                        .carousel-item-next.carousel-item-left,
                        .carousel-item-prev.carousel-item-right {
                        -webkit-transform: translateX(0);
                        transform: translateX(0);
                        }

                        @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
                        .carousel-item-next.carousel-item-left,
                        .carousel-item-prev.carousel-item-right {
                            -webkit-transform: translate3d(0, 0, 0);
                            transform: translate3d(0, 0, 0);
                        }
                        }

                        .carousel-item-next,
                        .active.carousel-item-right {
                        -webkit-transform: translateX(100%);
                        transform: translateX(100%);
                        }

                        @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
                        .carousel-item-next,
                        .active.carousel-item-right {
                            -webkit-transform: translate3d(100%, 0, 0);
                            transform: translate3d(100%, 0, 0);
                        }
                        }

                        .carousel-item-prev,
                        .active.carousel-item-left {
                        -webkit-transform: translateX(-100%);
                        transform: translateX(-100%);
                        }

                        @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
                        .carousel-item-prev,
                        .active.carousel-item-left {
                            -webkit-transform: translate3d(-100%, 0, 0);
                            transform: translate3d(-100%, 0, 0);
                        }
                        }

                        .carousel-fade .carousel-item {
                        opacity: 0;
                        transition-duration: .6s;
                        transition-property: opacity;
                        }

                        .carousel-fade .carousel-item.active,
                        .carousel-fade .carousel-item-next.carousel-item-left,
                        .carousel-fade .carousel-item-prev.carousel-item-right {
                        opacity: 1;
                        }

                        .carousel-fade .active.carousel-item-left,
                        .carousel-fade .active.carousel-item-right {
                        opacity: 0;
                        }

                        .carousel-fade .carousel-item-next,
                        .carousel-fade .carousel-item-prev,
                        .carousel-fade .carousel-item.active,
                        .carousel-fade .active.carousel-item-left,
                        .carousel-fade .active.carousel-item-prev {
                        -webkit-transform: translateX(0);
                        transform: translateX(0);
                        }

                        @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
                        .carousel-fade .carousel-item-next,
                        .carousel-fade .carousel-item-prev,
                        .carousel-fade .carousel-item.active,
                        .carousel-fade .active.carousel-item-left,
                        .carousel-fade .active.carousel-item-prev {
                            -webkit-transform: translate3d(0, 0, 0);
                            transform: translate3d(0, 0, 0);
                        }
                        }

                        .carousel-control-prev,
                        .carousel-control-next {
                        position: absolute;
                        top: 0;
                        bottom: 0;
                        display: -ms-flexbox;
                        display: flex;
                        -ms-flex-align: center;
                        align-items: center;
                        -ms-flex-pack: center;
                        justify-content: center;
                        width: 15%;
                        color: #fff;
                        text-align: center;
                        opacity: 0.5;
                        }

                        .carousel-control-prev:hover, .carousel-control-prev:focus,
                        .carousel-control-next:hover,
                        .carousel-control-next:focus {
                        color: #fff;
                        text-decoration: none;
                        outline: 0;
                        opacity: .9;
                        }

                        .carousel-control-prev {
                        left: 0;
                        }

                        .carousel-control-next {
                        right: 0;
                        }

                        .carousel-control-prev-icon,
                        .carousel-control-next-icon {
                        display: inline-block;
                        width: 20px;
                        height: 20px;
                        background: transparent no-repeat center center;
                        background-size: 100% 100%;
                        }

                        .carousel-control-prev-icon {
                        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
                        }

                        .carousel-control-next-icon {
                        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
                        }

                        .carousel-indicators {
                        position: absolute;
                        right: 0;
                        bottom: 10px;
                        left: 0;
                        z-index: 15;
                        display: -ms-flexbox;
                        display: flex;
                        -ms-flex-pack: center;
                        justify-content: center;
                        padding-left: 0;
                        margin-right: 15%;
                        margin-left: 15%;
                        list-style: none;
                        }

                        .carousel-indicators li {
                        position: relative;
                        -ms-flex: 0 1 auto;
                        flex: 0 1 auto;
                        width: 30px;
                        height: 3px;
                        margin-right: 3px;
                        margin-left: 3px;
                        text-indent: -999px;
                        background-color: rgba(255, 255, 255, 0.5);
                        }

                        .carousel-indicators li::before {
                        position: absolute;
                        top: -10px;
                        left: 0;
                        display: inline-block;
                        width: 100%;
                        height: 10px;
                        content: "";
                        }

                        .carousel-indicators li::after {
                        position: absolute;
                        bottom: -10px;
                        left: 0;
                        display: inline-block;
                        width: 100%;
                        height: 10px;
                        content: "";
                        }

                        .carousel-indicators .active {
                        background-color: #fff;
                        }

                        .carousel-caption {
                        position: absolute;
                        right: 15%;
                        bottom: 20px;
                        left: 15%;
                        z-index: 10;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        color: #fff;
                        text-align: center;
                        }


                        #myCarousel .carousel-control-prev, #myCarousel .carousel-control-next {
                            width: 40px;
                            height: 40px;
                            background: var(--hover-clr);
                            opacity: 1;
                            border-radius: 50%;
                        }
                        #myCarousel .carousel-control-prev:hover, #myCarousel .carousel-control-next:hover, #myCarousel .carousel-control-prev:focus, #myCarousel .carousel-control-next:focus {
                            background: var(--accent-clr);
                            color: #fff;
                        }
                        #myCarousel a.carousel-control-prev {
                            position: absolute;
                            left: 72px;
                            bottom: 16px;
                            top: inherit;
                        }
                        #myCarousel a.carousel-control-next {
                            position: absolute;
                            left: 10px;
                            top: inherit;
                            bottom: 16px;
                        }

                    </style>
                    <script src="/chain-fortune/js/bootstrap.js"></script>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item"> 
                                <img style="border-radius: 5px; max-width: 100%;" class="first-slide carousel-image" src="/chain-fortune/images/chain-fortune-group.jpg" alt="First slide"> 
                            </div>
                            <div class="carousel-item"> 
                                <img style="border-radius: 5px; max-width: 100%;" class="second-slide carousel-image" src="/chain-fortune/images/GroupPeople1.9e7e0ddc6d86262fe1a2.jpg" alt="Second slide"> 
                            </div>
                            <div class="carousel-item active"> 
                                <img style="border-radius: 5px; max-width: 100%;" class="third-slide carousel-image" src="/chain-fortune/images/chain-fortune-group2.jpg" alt="Third slide"> 
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center; gap: 0;">
                             <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> 
                                <i class="" style="display: flex; height: 100%; width: 100%; justify-content: center; align-items:center;">
                                    <svg width="15px" viewBox="64 64 896 896" focusable="false">
                                        <path fill="#fff" d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 000 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"/>
                                    </svg>
                                </i>
                            </a>
                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> 
                                <i class="" style="display: flex; height: 100%; width: 100%; justify-content: center; align-items:center;">
                                    <svg width="15px" fill="#fff" viewBox="64 64 896 896" focusable="false" xmlns="http://www.w3.org/2000/svg"><path d="M869 487.8L491.2 159.9c-2.9-2.5-6.6-3.9-10.5-3.9h-88.5c-7.4 0-10.8 9.2-5.2 14l350.2 304H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h585.1L386.9 854c-5.6 4.9-2.2 14 5.2 14h91.5c1.9 0 3.8-.7 5.2-2L869 536.2a32.07 32.07 0 000-48.4z" /></svg>
                                </i>
                            </a> 
                        </div> 
                    </div>
                    <!-- end banner --> 
                </div>
                <!-- <img style="border-radius: 5px; max-width: 100%;" src="/chain-fortune/images/business-person-looking-finance-graphs.jpg" width="" alt=""> -->
            </div>
            <div class="move_in text-card">
                <h3>Company Profile</h3>
                <p>
                    At <?php include("../components/company_name.php");?>, we specialize in providing secure, innovative, and client-focused brokerage services in Forex, cryptocurrencies, commodities and equities. Our Mission
                    is to empower traders and investors with the tools, knowledge, and support to succeed in global financial markets regulated by [Regulatory Body], we adhere to the highest standards of transparency, integrity, and compliance. Our advanced trading platforms, competitive spreads, and security protocols ensure a seamless and trusted
                    trading experience.
                    Since 2018, our ultra-fast trading engine and a broad selection of tokens have empowered millions to explore the world of digital assets. As pioneers in financial services and blockchain technology, we are committed to simplifying crypto trading and unlocking its boundless possibilities.
                </p>
                
                <div style="margin-top: 15px;">
                    <style>
                        .button_component2{
                            width: 200px;
                        }
                       @media (max-width: 655px) {
                        .button_component2{
                            width: 200px;
                        }
                       }

                    </style>
                    <?php 
                        $buttonFilledText = "Learn more";
                        $buttonFilledHref = "../pages/about";
                        include("../components/button_filled.php"); 
                    ?>
                </div>

            </div>
         </div>
        <!-- company profile end-->


        <!-- brands - start -->
        <div style="margin-top: 10px;"></div>
        <style>
            .brands-wrapper{
                display: flex;
                width: 100%;
                overflow-x: scroll;
                gap: 4rem;
                padding-block: 10px;
                padding-inline: 20px;
                background: #07070a;

            }
            .brands-wrapper::-webkit-scrollbar {
                height: 9px;
            }

            .brands-wrapper::-webkit-scrollbar-track {
                background: transparent;
            }

            .brands-wrapper::-webkit-scrollbar-thumb {
                background: var(--line-clr);
                border-radius: 4px;
            }

            .brands-wrapper::-webkit-scrollbar-thumb:hover {
                background: var(--secondary-text-clr);
            }
            .brand-item{
                transition: all 0.4s ease;
            }
            .brand-item:hover{
                transform: translateY(-5px);
                box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);

            }
        </style>
        <div class="brands-wrapper"  style="margin-bottom: 100px;">
            <a href="" class="brand-item">
                <img src="/chain-fortune/images/binance.png" alt="" width="180" srcset="">
            </a>

            <a href="" class="brand-item">
                <img src="/chain-fortune/images/chainlink.png" alt="" width="180" srcset="">
            </a>

            <a href="" class="brand-item">
                <img src="/chain-fortune/images/uniswap.png" alt="" width="180" srcset="">
            </a>

            <a href="" class="brand-item">
                <img src="/chain-fortune/images/sushi-swap.png" alt="" width="180" srcset="">
            </a>

            <a href="" class="brand-item">
                <img src="/chain-fortune/images/liveme.png" alt="" width="180" srcset="">
            </a>

            <a href="" class="brand-item">
                <img src="/chain-fortune/images/kamoney.png" alt="" width="180" srcset="">
            </a>
            
            <a href="" class="brand-item">
                <img src="/chain-fortune/images/trust-wallet.png" alt="" width="180" srcset="">
            </a>
        </div>
        <!-- brands - end -->











        <!-- four steps to start trading - start -->
        <div>
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Four Steps to start Trading";
                $headText = "Four Steps to start Trading";
                include ("../components/heading_text.style.php");
                include("../components/heading_text.php");
            ?>
        </div>
        <div class="card-wrapper">
            <div class="move_in card">
                <div class="icon">
                    <img src="/chain-fortune/images/register.png" width="68"  alt="">
                </div>
                <h3>1. Register</h3>
                <p>Go to create account, fill out all the fields as demanded by the authentication system, then click on sign up and open your live trading account.</p>
            </div>

            <div class="move_in card">
                <div class="icon">
                    <img src="/chain-fortune/images/verify.png" width="51"  alt="">
                </div>
                <h3>2. Verify</h3>
                <p>
                    Upload your valid documents and PII information in other to activate your account else you cannot trade.
                </p>
            </div>

            <div class="move_in card">
                <div class="icon">
                    <img src="/chain-fortune/images/fund.png" width="55"  alt="">
                </div>
                <h3>3. Fund  </h3>
                <p>
                    Sign In to your account and make a deposit in other to start trading
                </p>
            </div>

            <div class="move_in card">
                <div class="icon">
                    <img src="/chain-fortune/images/trade.png" width="55"  alt="">
                </div>
                <h3>4. Trade</h3>
                <p>
                    Start trading over 100 basic trading tools with the most reliable cryptocurrency trading broker.
                </p>
            </div>
        </div>
        <!-- four steps to start trading - end -->


        <!-- mobile app section start-->
        <style>
            .card-wrapper2 .move_in:nth-of-type(even){
                opacity: 0;
                transform: translateX(1000px);
                transition: opacity 0.6s ease-out, transform 1s ease;
            }
            .card-wrapper2 .move_in:nth-of-type(odd){
                opacity: 0;
                transform: translateX(-1000px);
                transition: opacity 0.6s ease-out, transform 1s ease;
            }
            .card-wrapper2 .move_in.visible{
                opacity: 1;
                transform: translateY(0);
            }
        </style>
        <style>
            .mobile-app-section{
                background: var(--black-clr);

                .text-card{
                    display: flex;
                    flex-direction: column;
                    gap: 14px;

                    .title{
                        font-size: calc(1.695rem + 2vw);
                        font-weight: 600;
                        margin-top: 20px;
                    }

                    .download-btn-container{
                        display: flex;
                        gap: 9px;
                        width: 100%;
                        @media (max-width: 660px) {
                            flex-direction: column;
                            width: 200px;
                            gap: 11px;
                            

                        }



                        button{
                            border: 1px solid var(--line-clr);
                            outline: none;
                            background: transparent;
                            display: flex;
                            align-items: center;
                            padding: 7px 11px;
                            color: var(--secondary-text-clr);
                            gap: 11px;
                            border-radius: 30px;
                            cursor: pointer;
                            transition: all 0.5s ease;

                            i{
                                font-size: 17px;
                            }
                            i > svg {
                                fill: var(--secondary-text-clr);
                                width: 17px;
    
                            }
                            &:hover{
                                color: var(--accent-clr);
                                border: 1px solid var(--accent-clr);
                            }
                            &:hover svg{
                                fill: var(--accent-clr);

                            }

                        }
                    }
                }
                .phone-mockup-card{
                    display: flex;
                    justify-content: end;
                    padding-right: 20px;

                    img{
                        width: 470px;
                    }
                }

                .qr-code-container{
                    display: flex;
                    width: 100%;
                    align-items: center;
                    background: var(--hover-clr);
                    justify-content: start;
                    gap: 12px;
                    padding: 6px;
                    border-radius: 8px;



                    .qr-code{

                        img{
                            max-width: 100%;
                        }

                    }
                    .description{
                        display: flex;
                        flex-direction: column;
                        gap: 5px;
                        font-weight: 500;


                        > div:nth-of-type(1){
                            font-size: 1.3rem;
                            font-weight: 500;
                        }
                    }
                }
            }
        </style>
        <div class="card-wrapper2 mobile-app-section">
            <div class="move_in text-card">
                <div class="title">Non-Stop Trading Platform for All Your Digital Assets</div>
                <p>
                    Sign up now on Chain Fortune and never miss another crypto gem
                </p>

                <div class="qr-code-container">
                    <div class="qr-code">
                        <img src="/chain-fortune/images/btc-qr.jpg" width="120" alt="">
                    </div>

                    <div class="description">
                        <div>Scan to Download</div>
                        <div>ios and Android</div>
                    </div>
                </div>
                
                <div style="margin-top: 15px;" class="download-btn-container">
                    <button onclick="window.open('')" class="dowload-btn">
                        <span class="dowload-btn-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M747.4 535.7c-.4-68.2 30.5-119.6 92.9-157.5-34.9-50-87.7-77.5-157.3-82.8-65.9-5.2-138 38.4-164.4 38.4-27.9 0-91.7-36.6-141.9-36.6C273.1 298.8 163 379.8 163 544.6c0 48.7 8.9 99 26.7 150.8 23.8 68.2 109.6 235.3 199.1 232.6 46.8-1.1 79.9-33.2 140.8-33.2 59.1 0 89.7 33.2 141.9 33.2 90.3-1.3 167.9-153.2 190.5-221.6-121.1-57.1-114.6-167.2-114.6-170.7zm-105.1-305c50.7-60.2 46.1-115 44.6-134.7-44.8 2.6-96.6 30.5-126.1 64.8-32.5 36.8-51.6 82.3-47.5 133.6 48.4 3.7 92.6-21.2 129-63.7z"/></svg>
                            </i>
                        </span>
                        <span class="text">App Store</span>
                    </button>
                    <button onclick="window.open('')" class="dowload-btn">
                        <span class="dowload-btn-icon">
                            <i class="ri-google-play-fill"></i>
                        </span>
                        <span class="text">Play Store</span>
                    </button>
                    <button onclick="window.open('')" class="dowload-btn">
                        <span class="dowload-btn-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M448.3 225.2c-18.6 0-32 13.4-32 31.9s13.5 31.9 32 31.9c18.6 0 32-13.4 32-31.9.1-18.4-13.4-31.9-32-31.9zm393.9 96.4c-13.8-13.8-32.7-21.5-53.2-21.5-3.9 0-7.4.4-10.7 1v-1h-3.6c-5.5-30.6-18.6-60.5-38.1-87.4-18.7-25.7-43-47.9-70.8-64.9l25.1-35.8v-3.3c0-.8.4-2.3.7-3.8.6-2.4 1.4-5.5 1.4-8.9 0-18.5-13.5-31.9-32-31.9-9.8 0-19.5 5.7-25.9 15.4l-29.3 42.1c-30-9.8-62.4-15-93.8-15-31.3 0-63.7 5.2-93.8 15L389 79.4c-6.6-9.6-16.1-15.4-26-15.4-18.6 0-32 13.4-32 31.9 0 6.2 2.5 12.8 6.7 17.4l22.6 32.3c-28.7 17-53.5 39.4-72.2 65.1-19.4 26.9-32 56.8-36.7 87.4h-5.5v1c-3.2-.6-6.7-1-10.7-1-20.3 0-39.2 7.5-53.1 21.3-13.8 13.8-21.5 32.6-21.5 53v235c0 20.3 7.5 39.1 21.4 52.9 13.8 13.8 32.8 21.5 53.2 21.5 3.9 0 7.4-.4 10.7-1v93.5c0 29.2 23.9 53.1 53.2 53.1H331v58.3c0 20.3 7.5 39.1 21.4 52.9 13.8 13.8 32.8 21.5 53.2 21.5 20.3 0 39.2-7.5 53.1-21.3 13.8-13.8 21.5-32.6 21.5-53v-58.2H544v58.1c0 20.3 7.5 39.1 21.4 52.9 13.8 13.8 32.8 21.5 53.2 21.5 20.4 0 39.2-7.5 53.1-21.6 13.8-13.8 21.5-32.6 21.5-53v-58.2h31.9c29.3 0 53.2-23.8 53.2-53.1v-91.4c3.2.6 6.7 1 10.7 1 20.3 0 39.2-7.5 53.1-21.3 13.8-13.8 21.5-32.6 21.5-53v-235c-.1-20.3-7.6-39-21.4-52.9zM246 609.6c0 6.8-3.9 10.6-10.7 10.6-6.8 0-10.7-3.8-10.7-10.6V374.5c0-6.8 3.9-10.6 10.7-10.6 6.8 0 10.7 3.8 10.7 10.6v235.1zm131.1-396.8c37.5-27.3 85.3-42.3 135-42.3s97.5 15.1 135 42.5c32.4 23.7 54.2 54.2 62.7 87.5H314.4c8.5-33.4 30.5-64 62.7-87.7zm39.3 674.7c-.6 5.6-4.4 8.7-10.5 8.7-6.8 0-10.7-3.8-10.7-10.6v-58.2h21.2v60.1zm202.3 8.7c-6.8 0-10.7-3.8-10.7-10.6v-58.2h21.2v60.1c-.6 5.6-4.3 8.7-10.5 8.7zm95.8-132.6H309.9V364h404.6v399.6zm85.2-154c0 6.8-3.9 10.6-10.7 10.6-6.8 0-10.7-3.8-10.7-10.6V374.5c0-6.8 3.9-10.6 10.7-10.6 6.8 0 10.7 3.8 10.7 10.6v235.1zM576.1 225.2c-18.6 0-32 13.4-32 31.9s13.5 31.9 32 31.9c18.6 0 32.1-13.4 32.1-32-.1-18.6-13.4-31.8-32.1-31.8z"/></svg>
                            </i>
                        </span>
                        <span class="text">Download Chain Fortune</span>
                    </button>
                    <button onclick="window.open('')" class="dowload-btn">
                        <span class="dowload-btn-icon">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="64 64 896 896" focusable="false"><path d="M120.1 770.6L443 823.2V543.8H120.1v226.8zm63.4-163.5h196.2v141.6l-196.2-31.9V607.1zm340.3 226.5l382 62.2v-352h-382v289.8zm63.4-226.5h255.3v214.4l-255.3-41.6V607.1zm-63.4-415.7v288.8h382V128.1l-382 63.3zm318.7 225.5H587.3V245l255.3-42.3v214.2zm-722.4 63.3H443V201.9l-322.9 53.5v224.8zM183.5 309l196.2-32.5v140.4H183.5V309z"/></svg>
                            </i>
                        </span>
                        <span class="text">Windows</span>
                    </button>
                </div>

            </div>
            <div class="move_in image-card phone-mockup-card">
                <img style=" border-radius: 5px; max-width: 100%; transform: translateY(-0px)" src="/chain-fortune/images/chain-fortune-mockup.png" width="" alt="">
                <!-- <video style="max-width: 100%;" muted="" autoplay="" loop="" playsinline="" width="100%" src="../videos/phone.7651d28b4d4cb4ff9f92.mp4"></video> -->
            </div>
        </div>
        <!-- mobile app section end-->


        <!-- client security start -->
        <div>
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Client Security";
                $headText = "Client Security";
                include ("../components/heading_text.style.php");
                include("../components/heading_text.php");
            ?>
        </div>

        <div class="card-wrapper">
            <div class="move_in card">
                <div class="icon">
                    <img src="/chain-fortune/images/buy-crypto.png" width="68"  alt="">
                </div>
                <h3>Investor Compensation Scheme</h3>
                <p>At <?php include("../components/company_name.php"); ?>, We priotize the security of your investments. Through our Investor Compensation Scheme, we provie an additional layer of protection for clients, ensuring coverage in the unlikely event of insolvency or other unforeseen circumstances.</p>
            </div>

            <div class="move_in card">
                <div class="icon">
                    <img src="/chain-fortune/images/regulation.png" width="51"  alt="">
                </div>
                <h3>Regulation</h3>
                <p><?php include("../components/company_name.php"); ?> operates under strict regulatory compliance, adhering to the highest standards set by global authorities. Our commitment to transparency and accountablity ensures a safe and trustworthy trading environment for all clients.</p>
            </div>

            <div class="move_in card">
                <div class="icon">
                    <img src="/chain-fortune/images/negative balance protection.png" width="55"  alt="">
                </div>
                <h3>Negative Balance Protection</h3>
                <p>With <?php include("../components/company_name.php"); ?>'s Negative Balance Protection, your losses are limited to your account balance. This feature ensures that you'll never owe more than you invest, providing peace of mind even in volatile market conditions.</p>
               
            </div>
        </div>
        <!-- client security end -->


        <div class="mediaWrapper-NmVdGcIc">
            <div class="mediaFrame-NmVdGcIc">
                <video width="100%" style="border-radius: 40px;" class="video-NmVdGcIc item-NmVdGcIc" muted="" autoplay="" loop="" playsinline="" disableremoteplayback="" poster="https://static.tradingview.com/static/bundles/chart.91804d5594db36618275.webp"><source src="https://static.tradingview.com/static/bundles/chart.hvc1.6ad975a60abab376b872.mp4" type="video/mp4;codecs=hvc1.1.0.L150.b0">
                    <source src="https://static.tradingview.com/static/bundles/chart.c1cfe204b1c203ff7dd2.webm" type="video/webm">
                    <source src="https://static.tradingview.com/static/bundles/chart.avc1.786d26d6f5289b0db8aa.mp4" type="video/webm;codecs=avc1">
                </video>
            </div>
        </div>






        <!-- company overview start-->
        <div>
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Company Overview";
                $headText = "Company Overview";
                include ("../components/heading_text.style.php");
                include("../components/heading_text.php");
            ?>
        </div>
        <style>
            .card-wrapper2 .move_in:nth-of-type(even){
                opacity: 0;
                transform: translateX(1000px);
                transition: opacity 0.6s ease-out, transform 1s ease;
            }
            .card-wrapper2 .move_in:nth-of-type(odd){
                opacity: 0;
                transform: translateX(-1000px);
                transition: opacity 0.6s ease-out, transform 1s ease;
            }
            .card-wrapper2 .move_in.visible{
                opacity: 1;
                transform: translateY(0);
            }
        </style>
        <div class="card-wrapper2">
            <div class="move_in image-card">
                <video class="crypto-app-video" style="max-width: 100%;" muted="" autoplay="" loop="" playsinline="" width="100%" src="../video/phone.7651d28b4d4cb4ff9f92.mp4"></video>
            </div>
            <div class="move_in text-card">
                <h3>Company Overview</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut, ratione vel saepe illum dolor sit ab!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut, ratione vel saepe illum dolor sit ab!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut, ratione vel saepe illum dolor sit ab!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut, ratione vel saepe illum dolor sit ab!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut, ratione vel saepe illum dolor sit ab!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut, ratione vel saepe illum dolor sit ab!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut, ratione vel saepe illum dolor sit ab!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate ducimus possimus corrupti dolorum. Neque a modi quis iste quo reprehenderit exercitationem perferendis aut,!
                </p>
                
                <div style="margin-top: 15px;">
                    <style>
                        .button_component2{
                            width: 200px;
                        }
                        @media (max-width: 655px) {
                        .button_component2{
                            width: 200px;
                        }
                        }

                    </style>
                    <?php 
                        $buttonFilledText = "Learn more";
                        $buttonFilledHref = "../pages/about";
                        include("../components/button_filled.php"); 
                    ?>
                </div>

            </div>
        </div>
        <!-- company overview end-->








        <!-- trading assets, invest in cfd's, cryptocurrencies, forex etc. - start -->
        <div style="margin-top: 120px;">
            <!-- php script for the head text -->
            <?php 
                $headTextWaterMark = "Four Steps to start Trading";
                $headText = "Trading Assets, Invest in CFD's, Cryptocurrencies, Forex etc.";
                include ("../components/heading_text.style.php");
                include("../components/heading_text.php");
            ?>
        </div>
        
        <div class="card-wrapper3 ">
            <a href="#" class="move_in six-cols-card">
                <div class="icon">
                    <img src="/chain-fortune/images/precious-metals.png" width="55"  alt="">
                </div>
                <p>Precious Metal</p>
            </a>

            <a href="#" class="move_in six-cols-card">
                <div class="icon">
                    <img src="/chain-fortune/images/forex.png" width="55"  alt="">
                </div>
                <p>Forex</p>
            </a>

            <a href="#" class="move_in six-cols-card">
                <div class="icon">
                    <img src="/chain-fortune/images/shared-indexes.png" width="55"  alt="">
                </div>
                <p>Shared Indexes</p>
            </a>

            <a href="#" class="move_in six-cols-card">
                <div class="icon">
                    <img src="/chain-fortune/images/stocks.png" width="55"  alt="">
                </div>
                <p>Stocks</p>
            </a>

            <a href="#" class="move_in six-cols-card">
                <div class="icon">
                    <img src="/chain-fortune/images/energy-carriers.png" width="55"  alt="">
                </div>
                <p>Energy Carriers</p>
            </a>

            <a href="#" class="move_in six-cols-card">
                <div class="icon">
                    <img src="/chain-fortune/images/cryptocurrencies.png" width="55"  alt="">
                </div>
                <p>Cryptocurrencies</p>
            </a>

            <a href="#" class="move_in six-cols-card">
                <div class="icon">
                    <img src="/chain-fortune/images/commodities.png" width="55"  alt="">
                </div>
                <p>Commodities</p>
            </a>
            <div style="margin-top: 40px;"></div>
        </div>
        <!-- trading assets, invest in cfd's, cryptocurrencies, forex etc. - end -->





        <!-- client testimonials start -->
        <style>
            .testimonials-section{
                width: 100%;
                padding: 0px 1rem;
            }
            .testimonials-section .section-header{
                max-width: 700px;
                text-align: center;
                margin: 30px auto 40px;
            }
            .section-header h1{
                position: relative;
                font-size: 36px;
                color: var(--accent-clr);
            }
            .testimonials-container{
                position: relative;
            }
            .testimonials-container .testimonial-card{
                padding: 20px;
                border-radius: 1rem;
                transition: all 0.4s ease;
            }
            /* .testimonial-card:hover{
                border: 1px solid var(--accent-clr);
                box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);


            } */
            .testimonial-card .test-card-body{
                box-shadow: 0 3px 30px rgba(0, 0, 0, 0.412);
                padding: 20px;
            }
            /* .testimonial-card:hover .test-card-body{
                box-shadow: 0 0px 0px rgba(0, 0, 0, 0.412);

            } */

            .test-card-body .quote{
                display: flex;
                align-items: center;
            }
            .test-card-body .quote i{
                font-size: 45px;
                color: var(--text-clr);
                margin-right: 20px;
            }
            .test-card-body .quote h2{
                color: var(--text-clr);
            }
            .test-card-body p{
                margin: 10px 0px 15px;
                font-size: 14px;
                line-height: 1.8;
                color: var(--secondary-text-clr);
            }
            .test-card-body .ratings{
                margin-top: 20px;
            }
            .test-card-body .ratings span{
                font-size: 28px;
                color: var(--accent-clr);
                cursor: pointer;
            }
            .testimonial-card .profile{
                display: flex;
                align-items: center;
                margin-top: 25px;
            }
            .profile .profile-image{
                width: 50px;
                height: 50px;
                border-radius: 50%;
                overflow: hidden;
                margin-right: 15px;
            }
            .profile .profile-image img{
                width: 100%;
                height: 100%;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid var(--line-clr);
            }
            .testimonial-card:hover .profile-image img{
                border: 2px solid var(--accent-clr);

            }
            
            .profile .profile-desc{
                display: flex;
                flex-direction: column;
            }
            .profile-desc span:nth-child(1){
                font-size: 24px;
                font-weight: bold;
                color: var(--text-clr);
            }
            .profile-desc span:nth-child(2){
                font-size: 15px;
                color: var(--secondary-text-clr);
            }
            .owl-nav{
                position: absolute;
                right: 20px;
                bottom: -10px;
            }
            .owl-nav button{
                border-radius: 50% !important;
            }
            .owl-nav .owl-prev span,
            .owl-nav .owl-next span{
                height: 40px;
                width: 40px;
                padding: 10px !important;
                border-radius: 50%;
                background-color: var(--hover-clr) !important;
                color: var(--accent-clr);
                cursor: pointer;
                transition: 0.4s;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .owl-nav .owl-prev span:hover,
            .owl-nav .owl-next span:hover{
                background-color: var(--accent-clr) !important;
                color: var(--text-clr);
            }
            .owl-dots{
                margin-top: 15px;
            }
            .owl-dots .owl-dot span{
                background-color: var(--line-clr) !important;
                padding: 6px !important;
            }
            .owl-dot.active span{
                background-color: var(--accent-clr) !important;
            }

            .owl-theme .owl-nav [class*=owl-] {
                background: transparent;
            }
            .owl-theme .owl-nav [class*=owl-]:hover {
                background: transparent;
            }

        </style>
        <div class="testimonials-section move_in">
            <div style="margin-top: 10px;">
                <!-- php script for the head text -->
                <?php 
                    $headTextWaterMark = "Clients Testimonials";
                    $headText = "Clients Testimonials";
                    include ("../components/heading_text.style.php");
                    include("../components/heading_text.php");
                ?>
            </div>
            <!-- Owl Carousel Slider Starts -->
            <div class="owl-carousel owl-theme testimonials-container">
                <!-- carousel card start -->
                <div class="item testimonial-card">
                    <main class="test-card-body">
                        <div class="quote">
                            <i>
                                <img src="/chain-fortune/images/quotes.png"  alt="" srcset="">
                            </i>
                            <h2>Awesome Coding</h2>
                        </div>
                        <p>
                            I'm Bianca Allen from North Carolina, Currently living in Arizona with my Family, I came across <?php include("../components/company_name.php");?>, while browsing through facebook, I accessed the site and contact them via whatsapp and I started investing with $5000 and am making $51,560.00 Weekly.
                        </p>
                        <div class="ratings">
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">☆</span>
                        </div>
                    </main>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="/chain-fortune/images/alexis wilson.png">
                        </div>
                        <div class="profile-desc">
                            <span>Alexis Wilson</span>
                            <span>United States</span>
                        </div>
                    </div>
                </div>

                <div class="item testimonial-card">
                    <main class="test-card-body">
                        <div class="quote">
                            <i>
                                <img src="/chain-fortune/images/quotes.png"  alt="" srcset="">
                            </i>
                            <h2>Awesome Coding</h2>
                        </div>
                        <p>
                            I'm Bianca Allen from North Carolina, Currently living in Arizona with my Family, I came across <?php include("../components/company_name.php");?>, while browsing through facebook, I accessed the site and contact them via whatsapp and I started investing with $5000 and am making $51,560.00 Weekly.
                        </p>
                        <div class="ratings">
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">☆</span>
                        </div>
                    </main>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="/chain-fortune/images/hunter-hamilton.jpg">
                        </div>
                        <div class="profile-desc">
                            <span>Hunter Hamilton</span>
                            <span>United States</span>
                        </div>
                    </div>
                </div>

                <div class="item testimonial-card">
                    <main class="test-card-body">
                        <div class="quote">
                            <i>
                                <img src="/chain-fortune/images/quotes.png"  alt="" srcset="">
                            </i>
                            <h2>Awesome Coding</h2>
                        </div>
                        <p>
                            I'm Bianca Allen from North Carolina, Currently living in Arizona with my Family, I came across <?php include("../components/company_name.php");?>, while browsing through facebook, I accessed the site and contact them via whatsapp and I started investing with $5000 and am making $51,560.00 Weekly.
                        </p>
                        <div class="ratings">
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">★</span>
                            <span class="">☆</span>
                        </div>
                    </main>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="/chain-fortune/images/hunter-hamilton.jpg">
                        </div>
                        <div class="profile-desc">
                            <span>Hunter Hamilton</span>
                            <span>United States</span>
                        </div>
                    </div>
                </div>
                <!-- carousel card end -->
            </div>
            <!-- Owl Carousel Slider Ends -->

        </div>
        <script>
            $('.testimonials-container').owlCarousel({
                loop:true,
                // autoplay:true,
                smartSpeed: 2000,
                autoplayTimeout:6000,
			    autoplayHoverPause: false,
                margin:10,
                nav:true,
                navText:[
                        `<span>
                            <svg width="17px" viewBox="64 64 896 896" focusable="false">
                                <path fill="#fff" d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 000 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"/>
                            </svg>
                          </span>`,

                        `<span>
                            <svg width="17px" fill="#fff" viewBox="64 64 896 896" focusable="false" xmlns="http://www.w3.org/2000/svg"><path d="M869 487.8L491.2 159.9c-2.9-2.5-6.6-3.9-10.5-3.9h-88.5c-7.4 0-10.8 9.2-5.2 14l350.2 304H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h585.1L386.9 854c-5.6 4.9-2.2 14 5.2 14h91.5c1.9 0 3.8-.7 5.2-2L869 536.2a32.07 32.07 0 000-48.4z" /></svg>
                        </span>`
                ],
                        
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:1,
                        nav:true
                    },
                    768:{
                        items:2
                    },
                    
                }
            });
        </script>
        <div style="margin-top: 130px;"></div>
        <!-- client testimonials end -->
        <div style="margin-bottom: 130px;"></div>


        <style>
            .about-area{
                position: relative;
            }
            .about-area .container > .row{
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                padding: 4rem 1rem;

            }
            .about-text {
                margin-top: 25px;
            }
            .flat-content {
                display: block;
            }
            .ab-mark-text li {
                display: block;
                position: relative;
            }
            .ab-mark-text ul li{
                color: #ddd;
                padding: 12px 0px 12px 40px;
                display: block;
            }
            .ab-mark-text li::after {
                position: absolute;
                left: 0px;
                top: 13px;
                content: "\e64c";
                font-family: themify;
                width: 22px;
                height: 22px;
                line-height: 24px;
                text-align: center;
                border-radius: 50px;
                font-size: 11px;
                color: #fff;
                
                background:#FF06B7;
            }
            .top-text span {
                text-transform: uppercase;
                font-weight: 700;
                font-size: 16px;
                color: #FF06B7;
                margin-bottom: 25px;
                display: inline-block;
            }
            .top-text i {
                padding: 7px 10px 8px;
                background: #FF06B7;
                color: #fff;
                font-size: 15px;
                border-radius: 2px;
                line-height: 20px;
                margin-right: 3px;
            }
            .flat-text a{
                color: #ddd;
            }
            .flat-text a:hover{
                color: var(--text-clr);
            }
            .flat-text {
                font-size: 16px;
                padding: 4px 20px;
                border-radius: 4px;
                color: var(--text-clr);
                display: inline-block;
                margin-top: 20px;
                background: var(--accent-clr);
            }

            .about-images {
                border-radius: 5px;
                position: relative;
                z-index: 1;
            }
            .about-all {
                margin-left: 40px;
                position: relative;
            }
            .about-inner{
                position: relative;
                display: block;
                padding-top: 40px;
                padding-bottom: 10px;
            }
            .about-inner::before {
                position: absolute;
                content: "";
                left: 20px;
                top: 0;
                width: 12px;
                height: 12px;
                background: var(--hover-clr);
                border-radius: 50%;
            }
            .about-inner::after {
                position: absolute;
                content: "";
                left:20px;
                bottom: 0;
                width: 12px;
                height: 12px;
                background: var(--hover-clr);
                border-radius: 50%;
            }
            .about-all::before {
                position: absolute;
                left: 25px;
                top: 0;
                width:1px;
                height: 100%;
                background: var(--hover-clr);
                content: "";
            }
            .single-about {
                margin-bottom: 40px;
                border-radius: 3px;
            }
            .single-about:hover span{
                background: var(--accent-clr);
                transition: 0.04s;
            }
            .about-content {
                display: block;
            }
            .about-icon {
                float: left;
                font-size: 24px;
                color: var(--text-clr);
                line-height: 48px;
                text-align: center;
                transition: 0.4s;
                font-weight: 600;
                width: 50px;
                height: 50px;
                background: var(--hover-clr);
                position: relative;
                border-radius: 50px;
                border:1px solid var(--hover-clr);
            }
            .about-icon:hover{
                color:#fff;
            }
            .support-text {
                padding-left: 70px;
            }
            .support-text h4 {
                font-size: 20px;
                text-transform: capitalize;
                font-weight: 500;
                padding-bottom: 0px;
                letter-spacing: 1px;
                line-height: 28px;
            }
            .support-text h3 a{
                color: var(--text-clr);
            }
            .support-text p {
                margin-bottom: 0px;
            }
            .rotmate-image {
                position: absolute;
                top: -30px;
                z-index: -1;
                opacity: 0.3;
                width: 90%;
                left: 30px;
            }
            @media (max-width: 935px) {
                .about-area .container > .row{
                    grid-template-columns: repeat(1, 1fr);
                    gap: 15px;

                }
                .about-all {
                    margin-left: 8px;
                }

               
            }

        </style>
        <div class="about-area bg-color-3 fix area-padding" id="aboutThis">
            <div class="container">
                <div class="row d-flex flex-wrap align-items-center card-wrapper2">
                    <div class="move_in col-xl-6 col-lg-6 col-md-12 image-card">
                        <div class="about-content">
                            <div class="about-images wow fadeInLeft" data-wow-delay="0.7s">
                                <img src="/chain-fortune/images/business-person-looking-finance-graphs.jpg" style="max-width: 100%; border-radius: 5px;" alt="">
                                <div class="rotmate-image rotateme">
                                    <!-- <img src="/chain-fortune/images/circle.png" alt=""> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="move_in col-xl-6 col-lg-6 col-md-12 timeline text-card">
                        <div class="about-all">
                            <div class="about-inner">
                                <!-- Start about -->
                                <div class="single-about wow fadeInUp" data-wow-delay="0.3s">
                                    <span class="about-icon">01</span>
                                    <div class="support-text">
                                        <h3><a href="#">Decentralized System</a></h3>
                                        <p>
                                            This is at the heart of our innovations at 
                                            <?php include("../components/company_name.php"); ?>, 
                                            transforming the industries by offering transparent, immutable records of transactions.
                                        </p>
                                    </div>
                                </div>
                                <!-- Start about -->
                                <div class="single-about wow fadeInUp" data-wow-delay="0.5s">
                                    <span class="about-icon">02</span>
                                    <div class="support-text">
                                        <h3><a href="#">Blockchain Wallet</a></h3>
                                        <p>Our user-friendly interface makes it easy to send, receive, and store digital currencies, making it the perfect choice for both beginners and seasoned investors</p>
                                    </div>
                                </div>
                                <!-- Start about -->
                                <div class="single-about wow fadeInUp" data-wow-delay="0.7s">
                                    <span class="about-icon">03</span>
                                    <div class="support-text">
                                        <h3><a href="#">Web3 Project</a></h3>
                                        <p>We're revolutionizing the way we interact with the web by leveraging blockchain technology to create a decentralized, secure, and user-centric online experience.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End about -->
                    </div>
                </div>
            </div>
        </div>



        <!-- thrive start -->
        <style>
            .thrive-container{
                width: 100%;
                background: var(--black-clr);
                .wrapper{
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 10px;
                    padding: 2rem;
                    @media (max-width: 961px) {
                        grid-template-columns: repeat(2, 1fr);

                    }
                    @media (max-width: 640px) {
                        grid-template-columns: repeat(1, 1fr);

                    }
                    @media (max-width: 500px) {
                        padding: 0.6rem;

                    }
                }

                



                .phone-mockup1{
                    display: none;
                    margin: auto;
                    @media (max-width: 961px) {
                        display: block;
                        width: 89%;
                    }

                }


                .thrive-card{
                    display: block;

                    .trading-features{
                        display: grid;
                        grid-template-columns: repeat(1, 1fr);
                        gap: 2rem;
                        padding: 2rem;
                        max-width: 1400px;
                        margin: 0 auto;

                        .feature-card{
                            text-align: center;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            gap: 10px;

                            .feature-card__tag{
                                display: inline-block;
                                padding: 0.5rem 0rem;
                                background: var(--hover-clr);
                                border-radius: 20px;
                                font-size: 0.775rem;
                                margin-bottom: 1rem;
                                color: var(--secondary-text-clr);
                                width: 120px;   
                            }
                        }
                        
                    }
                
                    .phone-mockup2{
                        margin: auto;
                        max-width: 100%;
                    }
                }
                .phone-mockup-wrapper2{
                    @media (max-width: 961px) {
                        display: none;
                    }

                }


            }

        </style>

        <div class="thrive-container">
            <div style="padding-top: 2rem; margin-bottom: 1rem;">
                <!-- php script for the head text -->
                <?php 
                    $headTextWaterMark = "Three Major Measures to Safeguard Asset Security";
                    $headText = "Thrive in the gold & oil markets";
                    include("../components/heading_text.style.php");
                    include("../components/heading_text.php");
                    
                ?>
                <style>
                    .head-text::after{
                        display: none;
                    }
                </style>
                
            </div>
            <div style="margin: auto; width: 87%;">
                <p style="text-align: center; margin-bottom: 3rem;">
                Trading conditions can make or break a strategy, that's why you need the best.
                </p>
            
            </div>
            <div class="phone-mockup-wrapper1 move_in" style="width: 70%; margin:auto;">
                <img class="phone-mockup1" src="/chain-fortune/images/xl_trade_without_tradeoffs_sm_454bd5e843.jpg" width="300" alt="" srcset="">
            </div>
            <div class="wrapper">
                <div class="thrive-card">
                    <section class="trading-features">
                        <div class="feature-card move_in">
                            <span class="feature-card__tag">Withdrawals</span>
                            <h2 class="feature-card__title">Instant withdrawals</h2>
                            <p class="feature-card__description">Get your deposits and withdrawals approved the moment you click the button.</p>
                        </div>

                        <div class="feature-card move_in">
                            <span class="feature-card__tag">Execution speed</span>
                            <h2 class="feature-card__title">Ultra-fast execution</h2>
                            <p class="feature-card__description">Execute your orders in milliseconds, no matter how big they are.</p>
                        </div>

                        <div class="feature-card move_in">
                            <span class="feature-card__tag">Spreads</span>
                            <h2 class="feature-card__title">The best spreads on gold</h2>
                            <p class="feature-card__description">Trade with the tightest & most stable spreads in the market.</p>
                        </div>
                    </section>
                </div>

                <div class="thrive-card phone-mockup-wrapper2">
                    <img class="phone-mockup2" src="/chain-fortune/images/xl_trade_without_tradeoffs_sm_454bd5e843.jpg" width="360" alt="" srcset="">
                </div>

                <div class="thrive-card">
                    <section class="trading-features">
                        <div class="feature-card move_in">
                            <span class="feature-card__tag">Swaps</span>
                            <h2 class="feature-card__title">No overnight fees</h2>
                            <p class="feature-card__description">Hold your leveraged positions for as long as you like, swap-free. T&C apply.</p>
                        </div>

                        <div class="feature-card move_in">
                            <span class="feature-card__tag">Support</span>
                            <h2 class="feature-card__title">24/7 live support</h2>
                            <p class="feature-card__description">Get answers in minutes. Contact our support team 24/7 by phone, email, or live chat.</p>
                        </div>

                        <div class="feature-card move_in">
                            <span class="feature-card__tag">Platforms</span>
                            <h2 class="feature-card__title">Reliable platforms</h2>
                            <p class="feature-card__description">Experience the ultimate in stability and execution speed. No matter the size of your order.</p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- thrive end -->


        <?php include("../pages/test.php"); ?>





        <!-- market overview start -->
        <div style="margin-top: 10px; margin-bottom: 30px;">
            <!-- php script for the head text -->
            <?php 
                // $headTextWaterMark = "Clients Testimonials";
                $headText = "Market Overview";
                include ("../components/heading_text.style.php");
                include("../components/heading_text.php");
            ?>
        </div>
        <div class="col-sm-6 col-lg-6" style="margin-inline: 1rem;">
            <div class="p-3 shadow-none border">
                <div class="row p-2">
                    <div class="col-12 p-0">
                        <div class="nk-block-head-content"></div>
                    </div>
                    <div class="col-12 border rounded">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container" style="width: 100%; height: 500px;">
                            <iframe 
                                scrolling="no" 
                                allowtransparency="true" 
                                frameborder="0" 
                                src="https://www.tradingview-widget.com/embed-widget/market-overview/?locale=en#%7B%22colorTheme%22%3A%22dark%22%2C%22dateRange%22%3A%2212M%22%2C%22showChart%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22isTransparent%22%3Atrue%2C%22showSymbolLogo%22%3Atrue%2C%22showFloatingTooltip%22%3Afalse%2C%22width%22%3A%22100%25%22%2C%22height%22%3A500%2C%22tabs%22%3A%5B%7B%22title%22%3A%22Crypto%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22BINANCE%3ABTCUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AETHUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ABNBUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AXRPUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AADAUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ADOGEUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ALTCUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ADOTUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ATRXUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ASOLUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3ASHIBUSDT%22%7D%2C%7B%22s%22%3A%22BINANCE%3AUSDCUSDT%22%7D%5D%7D%5D%7D" 
                                title="Crypto Market Overview" 
                                lang="en" 
                                style="user-select: none; box-sizing: border-box; display: block; height: 100%; width: 100%;">
                            </iframe>
                            <style>
                                .tradingview-widget-copyright {
                                    font-size: 13px !important;
                                    line-height: 32px !important;
                                    text-align: center !important;
                                    font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif !important;
                                    color: #B2B5BE !important;
                                }

                                .tradingview-widget-copyright .blue-text {
                                    color: #2962FF !important;
                                }

                                .tradingview-widget-copyright a {
                                    text-decoration: none !important;
                                    color: #B2B5BE !important;
                                }

                                .tradingview-widget-copyright a:hover .blue-text {
                                    color: #1E53E5 !important;
                                }
                            </style>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                </div>
            </div>
        </div>

        <!-- market overview end -->

    </div>
    <!-- sections wrapper end -->

    


    
    <?php 
        include "../components/scroll_up.php";
        include "../components/index_footer.php";
        include "../components/bottom_crypto_ticker.php";
    ?>
    <script src="/chain-fortune/js/scroll_animation.js"></script>
    <script src="/chain-fortune/js/Three.mjs"></script>
    <script async src="https://unpkg.com/three@0.157.0/build/three.min.js"></script>
    <script>
        window.addEventListener('load', () => {
        // Scene setup
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 2000);
        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setClearColor(0x11121a); 
        document.body.insertBefore(renderer.domElement, document.body.firstChild);

        // Lighting
        const ambientLight = new THREE.AmbientLight(0x404040, 1);
        scene.add(ambientLight);

        const directionalLight = new THREE.DirectionalLight(0xffffff, 2);
        directionalLight.position.set(1, 1, 1);
        scene.add(directionalLight);

        // Create background stars
        const starsGeometry = new THREE.BufferGeometry();
        const starsMaterial = new THREE.PointsMaterial({ color: 0xFFFFFF, size: 0.1, transparent: true });
        
        // Generate random star positions
        const starsVertices = [];
        for (let i = 0; i < 15000; i++) {
            const x = (Math.random() - 0.5) * 2000;
            const y = (Math.random() - 0.5) * 2000;
            const z = (Math.random() - 0.5) * 2000;
            starsVertices.push(x, y, z);
        }
        starsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(starsVertices, 3));
        const stars = new THREE.Points(starsGeometry, starsMaterial);
        scene.add(stars);

        // Create prominent stars
        const prominentStarsGeometry = new THREE.BufferGeometry();
        const prominentStarsMaterial = new THREE.PointsMaterial({ color: 0xFFFAF0, size: 1.2, transparent: true, opacity: 0.95 });
        
        // Generate prominent star positions
        const prominentStarsVertices = [];
        for (let i = 0; i < 150; i++) {
            const x = (Math.random() - 0.5) * 1200;
            const y = (Math.random() - 0.5) * 1200;
            const z = (Math.random() - 0.5) * 1200;
            prominentStarsVertices.push(x, y, z);
        }
        prominentStarsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(prominentStarsVertices, 3));
        const prominentStars = new THREE.Points(prominentStarsGeometry, prominentStarsMaterial);
        scene.add(prominentStars);

        // Create extra large stars
        const largeStarsGeometry = new THREE.BufferGeometry();
        const largeStarsMaterial = new THREE.PointsMaterial({ color: 0xFFE5CC, size: 2.5, transparent: true, opacity: 1 });
        
        // Generate large star positions
        const largeStarsVertices = [];
        for (let i = 0; i < 50; i++) {
            const x = (Math.random() - 0.5) * 600;
            const y = (Math.random() - 0.5) * 600;
            const z = (Math.random() - 0.5) * 600;
            largeStarsVertices.push(x, y, z);
        }
        largeStarsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(largeStarsVertices, 3));
        const largeStars = new THREE.Points(largeStarsGeometry, largeStarsMaterial);
        scene.add(largeStars);

        // Create Earth
        const earthGroup = new THREE.Group();
        scene.add(earthGroup);

        const textureLoader = new THREE.TextureLoader();
        
        // Earth parameters
        const earthRadius = 50;
        const earthGeometry = new THREE.SphereGeometry(earthRadius, 64, 64);
        
        // Load Earth textures
        const earthMaterial = new THREE.MeshPhongMaterial({
            map: textureLoader.load('https://threejs.org/examples/textures/planets/earth_atmos_2048.jpg'),
            bumpMap: textureLoader.load('https://threejs.org/examples/textures/planets/earth_normal_2048.jpg'),
            bumpScale: 0.5,
            specularMap: textureLoader.load('https://threejs.org/examples/textures/planets/earth_specular_2048.jpg'),
            specular: new THREE.Color(0x333333),
            shininess: 25
        });
        
        const earth = new THREE.Mesh(earthGeometry, earthMaterial);
        earthGroup.add(earth)
        
        // Add clouds
        const cloudGeometry = new THREE.SphereGeometry(earthRadius + 0.5, 64, 64);
        const cloudMaterial = new THREE.MeshPhongMaterial({
            map: textureLoader.load('https://threejs.org/examples/textures/planets/earth_clouds_1024.png'),
            transparent: true,
            opacity: 0.8
        });
        
        const clouds = new THREE.Mesh(cloudGeometry, cloudMaterial);
        earthGroup.add(clouds);

        // Cryptocurrency logos
        const cryptoLogos = [
            { name: 'Bitcoin', url: 'https://cryptologos.cc/logos/bitcoin-btc-logo.png' },
            { name: 'Ethereum', url: 'https://cryptologos.cc/logos/ethereum-eth-logo.png' },
            { name: 'Litecoin', url: 'https://cryptologos.cc/logos/litecoin-ltc-logo.png' },
            { name: 'Dogecoin', url: 'https://cryptologos.cc/logos/dogecoin-doge-logo.png' },
            { name: 'BNB', url: 'https://cryptologos.cc/logos/bnb-bnb-logo.png' },
            { name: 'Cardano', url: 'https://cryptologos.cc/logos/cardano-ada-logo.png' },
            { name: 'Solana', url: 'https://cryptologos.cc/logos/solana-sol-logo.png' },
            { name: 'Ripple', url: 'https://cryptologos.cc/logos/xrp-xrp-logo.png' },
            { name: 'Polkadot', url: 'https://cryptologos.cc/logos/polkadot-new-dot-logo.png' }
        ];

        // Create orbital rings for crypto logos
        const orbitalRings = [];
        
        // Create 3 orbital rings at different heights
        const ringRadii = [earthRadius * 2, earthRadius * 2.5, earthRadius * 3];
        
        for (let i = 0; i < 3; i++) {
            const ringGroup = new THREE.Group();
            scene.add(ringGroup);
            
            // Set different tilt angles for each ring
            ringGroup.rotation.x = Math.PI / 2; // Make rings horizontal
            ringGroup.rotation.z = Math.PI * 0.1 * i; // Slight tilt for each ring
            
            orbitalRings.push(ringGroup);
        }

        // Load cryptocurrency logos as sprites and position them in circular rings
        cryptoLogos.forEach((crypto, index) => {
            textureLoader.load(crypto.url, (texture) => {
            const material = new THREE.SpriteMaterial({ 
                map: texture,
                transparent: true,
                opacity: 0.9
            });
            
            const sprite = new THREE.Sprite(material);
            
            // Determine which ring this logo belongs to
            const ringIndex = Math.floor(index / 3);
            const ringGroup = orbitalRings[ringIndex % orbitalRings.length];
            
            // Calculate position on the ring
            const logosPerRing = 3;
            const angleStep = (Math.PI * 2) / logosPerRing;
            const angle = (index % logosPerRing) * angleStep;
            
            const radius = ringRadii[ringIndex % ringRadii.length];
            const x = radius * Math.cos(angle);
            const z = radius * Math.sin(angle);
            
            sprite.position.set(x, 0, z);
            
            // Size based on which ring
            const size = 20;
            sprite.scale.set(size, size, 1);
            
            ringGroup.add(sprite);
            });
        });

        // Position camera
        camera.position.z = 200;
        //   camera.position.z = 5;


        // Animation variables
        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;
        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        // Mouse move event listener
        document.addEventListener('mousemove', (event) => {
            mouseX = (event.clientX - windowHalfX);
            mouseY = (event.clientY - windowHalfY);
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            
            // Smooth camera movement
            targetX = mouseX * 0.0005;
            targetY = mouseY * 0.0005;
            
            // Rotate stars
            stars.rotation.y += 0.0002;
            prominentStars.rotation.y += 0.0001;
            largeStars.rotation.y += 0.00005;
            
            // Rotate Earth
            earth.rotation.y += 0.001;
            clouds.rotation.y += 0.0012;
            
            // Very slow rotation of the orbital rings
            orbitalRings.forEach((ring, index) => {
            ring.rotation.y += 0.0001 * (index + 1);
            
            // Make all sprites in the ring face the camera
            ring.children.forEach(sprite => {
                sprite.lookAt(camera.position);
            });
            });
            
            // Camera rotation based on mouse position
            camera.position.x += (targetX * 100 - camera.position.x) * 0.05;
            camera.position.y += (-targetY * 100 - camera.position.y) * 0.05;
            camera.lookAt(scene.position);
            
            renderer.render(scene, camera);
        }
        
        animate();
        });
    </script>



 

</body>
</html>