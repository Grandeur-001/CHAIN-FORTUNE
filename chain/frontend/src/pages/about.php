<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Chain Fortune</title>
    <style>
        @font-face {
            font-family: LOGO-FONT;
            src: url(../font/Varelmo.otf);
        }
        @font-face {
            font-family: LOGO-FONT2;
            src: url(../font/FLATLION2.TTF);
        }
        .about-banner{
            position: relative;
            background: var(--black-clr);
            overflow-x: hidden;
            scrollbar-width: none;
            height:100vh;

            .banner-video{
                width: 100%;

                > video{
                    max-width: 100%;
                }
            }
            .stars-bg{
                position: absolute;
                top: 0;
            }

            .banner-text{
                position: absolute;
                z-index: 3;
                top: 10rem;
                width: 100%;
                margin: auto;
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;

                h1{
                    font-size: 12rem;
                    font-weight: 900;
                    background: linear-gradient(180deg, var(--accent-clr), 10%, #000);
                    background-clip: text;
                    text-transform: uppercase;
                    color: transparent;
                    font-family:  LOGO-FONT;

                    @media (max-width: 855px) {
                        font-size: 9rem;
                    }
                    @media (max-width: 635px) {
                        font-size: 6rem;
                    }
                    @media (max-width: 435px) {
                        font-size: 5rem;
                    }
                    @media (max-width: 325px) {
                        font-size: 4rem;
                    }
                }

                h4{
                    font-size: 200px;
                    color:var(--text-clr);
                    font-weight: 400;
                    transform: translateY(-150px);
                    font-family:  LOGO-FONT2;

                    @media (max-width: 855px) {
                        font-size: 130px;
                        transform: translateY(-110px);
                    }

                    @media (max-width: 635px) {
                        font-size: 100px;
                        transform: translateY(-80px);
                    }
                    @media (max-width: 435px) {
                        font-size: 90px;
                        transform: translateY(-60px);
                    }
                    @media (max-width: 325px) {
                        font-size: 4rem;
                    }
                }
                p{
                    transform: translateY(-10vw);
                    text-align: center;
                    width: 70%;
                    line-height: 1.998rem;
                    font-size: 1.2rem;
                    color:var(--secondary-text-clr);        

                    b{
                        color: var(--text-clr);
                        font-size: 2rem;
                        margin-bottom: 1rem;

                        @media (max-width: 435px) {
                            line-height: 2.9rem;
                            font-size: 1.5rem;
                        }

                    }

                    @media (max-width: 435px) {
                        font-size: 1rem;
                        line-height: 1.698rem;
                        width: 100%;
                        padding-inline: 8vw;
                    }
                }
            }
        }

        .about-top-bottom{
            background: var(--black-clr);
            width: 100%;
            margin-top: 5rem;

            .wrapper{
                display: flex;
                justify-content: space-around;
                padding: 30px;

                @media (max-width: 1029px) {
                    flex-direction: column;
                    gap: 50px;
                }

                > div{
                    display: flex;
                    align-items: center;
                    gap: 16px;

                    .icon{
                        width: 72px;
                        height: 72px;
                        @media (max-width: 900px) {
                            width: 50px;
                            height: 50px;
                        }


                        > img{
                            max-width: 100%;
                        }
                    }

                    .text{
                        display: flex;
                        flex-direction: column;
                        gap: 8px;

                        h4{
                            font-size: calc(1.2rem + .6vw);
                            font-weight: 700;
                            line-height: 1.3;
                        }

                        p{
                            color: var(--secondary-text-clr);
                            font-size: calc(0.8rem + .4vw);
                            font-weight: 500;

                            @media (max-width: 500px) {

                            }

                        }
                    }
                }
            }
        }


    </style>
</head>
<body>
    <?php
        include("../components/index_header.php");
    ?>
    <div style="margin-top: 2rem;"></div>

    <section class="about-banner">
        <div class="banner-video">
            <video src="../video/home-banner-mobile-20240624 - Trim.mp4" style="max-width: 100%;" muted="" autoplay="" loop="" playsinline="" width="100%" ></video>
        </div>
        <div class="banner-stars stars-bg">

            <svg xmlns="http://www.w3.org/2000/svg" width="1353" height="783" viewBox="0 0 1353 783" fill="none">
                <g clip-path="url(#clip0_7054_3839)">
                    <circle cx="1353.84" cy="337.445" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="300.944" cy="598.718" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1157.16" cy="564.265" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="127.424" cy="501.133" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1226.21" cy="180.086" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1010.15" cy="559.896" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="50.7775" cy="302.14" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1248.94" cy="528.818" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="813.818" cy="521.693" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="519.727" cy="539.43" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="263.131" cy="660.236" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1050.36" cy="294.105" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="885.787" cy="223.605" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="596.707" cy="296.758" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1326.34" cy="753.274" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1032.4" cy="59.9738" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="310.465" cy="146.364" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="16.9923" cy="419.346" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="813" cy="65.4015" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1162.91" cy="561.948" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1331.86" cy="264.086" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="780.986" cy="221.308" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1215.89" cy="722.917" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="651.996" cy="124.999" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1280.15" cy="134.43" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="192.223" cy="434.046" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="521.016" cy="770.102" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="244.465" cy="489.367" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="528.318" cy="101.711" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="106.955" cy="497.261" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="944.693" cy="451.849" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1247.03" cy="557.992" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="218.846" cy="431.57" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="676.315" cy="611.374" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="230.158" cy="216.874" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="540.471" cy="440.627" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="672.658" cy="254.946" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="559.588" cy="324.976" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="481.432" cy="303.451" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="1240.33" cy="352.014" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="521.557" cy="513.329" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="874.482" cy="307.238" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="536.682" cy="232.295" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="490.701" cy="318.319" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="256.103" cy="278.129" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="530.705" cy="400.679" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="564.344" cy="424.116" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="273.686" cy="175.839" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="1125.88" cy="374.214" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="66.1328" cy="615.901" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="789.354" cy="62.7851" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="564.1" cy="511.36" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="15.1777" cy="699.826" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="1279.64" cy="498.629" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="657.512" cy="488.374" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="681.422" cy="209.44" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="42.2537" cy="330.574" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="322.924" cy="39.4334" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="550.015" cy="603.34" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="772.221" cy="523.128" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1152.87" cy="481.54" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="115.42" cy="589.175" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="130.693" cy="9.33089" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="302.994" cy="208.212" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="365.062" cy="284.262" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="306.994" cy="330.425" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="898.459" cy="424.54" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1324.13" cy="504.405" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1.97639" cy="416.055" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="558.627" cy="685.371" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1151.66" cy="194.665" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="48.2811" cy="1.53987" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="805.588" cy="186.358" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1010.87" cy="301.493" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="657.254" cy="23.6278" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="199.81" cy="630.827" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="404.707" cy="529.55" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1089.17" cy="367.043" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="356.551" cy="664.634" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1033.31" cy="573.668" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="992.89" cy="62.6834" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="677.838" cy="350.037" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="609.869" cy="30.0867" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="87.9491" cy="262.811" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1164.25" cy="141.472" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1007.08" cy="126.48" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1287.79" cy="617.571" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="200.15" cy="523.652" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="436.615" cy="677.571" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="446.127" cy="382.98" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="968.853" cy="670.287" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="231.486" cy="697.793" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="954.008" cy="421.615" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="718.508" cy="108.977" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="234.211" cy="121.597" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="42.2479" cy="681.274" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1206.28" cy="720.349" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="203.244" cy="483.593" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1170.6" cy="40.4647" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="951.416" cy="651.368" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="388.933" cy="186.321" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1273.65" cy="476.983" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="156.717" cy="548.805" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="58.8494" cy="729.846" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="737.736" cy="34.5584" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="7.93342" cy="264.293" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="607.771" cy="733.558" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="745.806" cy="121.081" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1039.9" cy="628.436" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="77.0252" cy="168.509" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="106.336" cy="254.759" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="614.006" cy="28.3992" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1116.03" cy="775.334" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1014.66" cy="382.718" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1185.71" cy="408.115" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="8.13069" cy="275.974" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="485.338" cy="295.099" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1020.85" cy="39.4617" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1026.79" cy="733.793" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="28.4647" cy="65.7117" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="656.004" cy="239.215" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="502.986" cy="456.003" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="485.99" cy="356.027" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="389.32" cy="86.5526" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="871.09" cy="54.2645" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="626.924" cy="4.18342" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1130.24" cy="4.7176" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="983.715" cy="195.349" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="152.844" cy="571.193" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="243.521" cy="561.331" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="380.162" cy="241.821" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="992.404" cy="721.784" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="326.402" cy="527.918" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="804.15" cy="331.793" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="431.717" cy="57.7149" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="694.906" cy="64.3807" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="578.437" cy="38.3084" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1044.1" cy="134.384" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="826.314" cy="764.318" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1022.81" cy="168.818" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1207.05" cy="384.94" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="397.857" cy="537.096" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="542.34" cy="87.1991" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="958.287" cy="130.155" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="616.18" cy="144.996" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1323.96" cy="378.003" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1178.65" cy="469.418" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="447.328" cy="722.749" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="64.5819" cy="145.268" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="786.57" cy="244.099" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="957.453" cy="674.843" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="685.191" cy="536.871" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="385.615" cy="397.099" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="530.873" cy="84.2371" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1111.72" cy="447.78" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="107.478" cy="635.459" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="315.236" cy="524.824" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="978.213" cy="563.702" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="461.822" cy="511.277" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="660.512" cy="68.6366" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="104.978" cy="507.162" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="259.383" cy="778.193" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1007.33" cy="232.277" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1305.2" cy="16.6903" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="344.234" cy="747.143" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="130.953" cy="208.718" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="817.217" cy="407.552" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="657.336" cy="506.477" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1218.53" cy="456.405" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="322.555" cy="684.068" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="522.547" cy="334.137" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="509.834" cy="136.352" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="981.629" cy="488.628" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="332.777" cy="475.061" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="824.965" cy="550.006" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="386.924" cy="327.827" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1344.18" cy="191.421" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1305.3" cy="653.365" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="88.5252" cy="599.384" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="629.117" cy="556.53" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="678.435" cy="216.912" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="726.242" cy="725.889" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="386.961" cy="408.659" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="369.119" cy="401.553" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1021.6" cy="293.112" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1167.34" cy="362.946" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1162.25" cy="207.94" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="715.193" cy="54.3023" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1064.81" cy="105.012" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="162.748" cy="149.787" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1045.36" cy="242.871" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="93.5741" cy="577.071" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1028.01" cy="656.571" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="505.01" cy="614.553" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="528.715" cy="629.449" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="881.908" cy="419.112" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="945.664" cy="94.868" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1196.06" cy="763.887" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1147.69" cy="356.421" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="78.9608" cy="434.346" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1060.72" cy="188.065" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1335.44" cy="739.858" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="769.373" cy="705.003" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="640.207" cy="460.821" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="79.6424" cy="719.318" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="405.056" cy="486.49" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="835.699" cy="32.159" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="312.316" cy="110.347" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="691.564" cy="726.865" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1254.71" cy="168.837" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="413.556" cy="445.84" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="97.2967" cy="221.327" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="348.752" cy="168.509" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1157.88" cy="53.1492" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="660.476" cy="776.186" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="115.471" cy="570.753" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="756.842" cy="226.972" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="555.594" cy="636.621" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="295.525" cy="537.706" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1152.01" cy="501.949" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1265.05" cy="307.053" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1052.16" cy="64.9617" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="659.754" cy="221.365" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="889.357" cy="77.3179" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="525.879" cy="482.749" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="805.471" cy="85.7645" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="0.947097" cy="531.378" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="207.615" cy="638.665" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1056.67" cy="673.212" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="856.592" cy="497.749" r="0.589675" fill="#B1CFF4"/>
                    <path d="M843.434 759.013L844.456 760.782H842.412L843.434 759.013Z" fill="#B1CFF4"/>
                    <path d="M772.68 582.444L773.702 584.214H771.658L772.68 582.444Z" fill="#B1CFF4"/>
                    <circle cx="786.951" cy="710.083" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="785.236" cy="744.958" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="817.776" cy="676.37" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="677.402" cy="730.389" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="687.494" cy="686.993" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="866.879" cy="708.8" r="0.589675" fill="#B1CFF4"/>
                    <path d="M749.731 739.757L750.752 741.527H748.709L749.731 739.757Z" fill="#B1CFF4"/>
                    <path d="M1345.91 406.851L1346.93 408.62H1344.89L1345.91 406.851Z" fill="#B1CFF4"/>
                    <path d="M736.283 516.472L737.305 518.241H735.262L736.283 516.472Z" fill="#B1CFF4"/>
                    <path d="M648.016 555.885L649.038 557.655H646.994L648.016 555.885Z" fill="#B1CFF4"/>
                    <path d="M209.344 292.062L210.366 293.832H208.322L209.344 292.062Z" fill="#B1CFF4"/>
                    <path d="M271.42 543.463L272.442 545.232H270.398L271.42 543.463Z" fill="#B1CFF4"/>
                    <path d="M865.776 75.6504L866.797 77.4201H864.754L865.776 75.6504Z" fill="#B1CFF4"/>
                    <path d="M1233.04 292.597L1234.06 294.366H1232.02L1233.04 292.597Z" fill="#B1CFF4"/>
                    <path d="M819.44 466.194L820.461 467.964H818.418L819.44 466.194Z" fill="#B1CFF4"/>
                    <circle cx="785.486" cy="517.792" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="634.164" cy="367.998" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="787.638" cy="483.856" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="711.748" cy="429.021" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="727.607" cy="440.233" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="751.92" cy="357.865" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="742.412" cy="506.308" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="605.871" cy="388.428" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="798.222" cy="510.462" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="705.83" cy="534.152" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="840.199" cy="447.003" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="796.582" cy="364.69" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="606.814" cy="501.19" r="0.589675" fill="#B1CFF4"/>
                    <path d="M732.527 455.338L733.549 457.108H731.506L732.527 455.338Z" fill="#B1CFF4"/>
                    <path d="M1035.21 461.159L1036.23 462.929H1034.19L1035.21 461.159Z" fill="#B1CFF4"/>
                    <path d="M958.703 674.862L959.725 676.632H957.682L958.703 674.862Z" fill="#B1CFF4"/>
                    <path d="M285.129 597.266L286.151 599.035H284.107L285.129 597.266Z" fill="#B1CFF4"/>
                    <circle cx="1338.01" cy="285.422" r="1.44248" transform="rotate(26.8111 1338.01 285.422)" fill="#B1CFF4"/>
                    <circle cx="1072.32" cy="174.679" r="2.16343" transform="rotate(26.8111 1072.32 174.679)" fill="#B1CFF4"/>
                    <circle cx="1140.84" cy="172.703" r="0.720943" transform="rotate(26.8111 1140.84 172.703)" fill="#B1CFF4"/>
                    <circle cx="1209.95" cy="264.69" r="0.720943" transform="rotate(26.8111 1209.95 264.69)" fill="#B1CFF4"/>
                    <circle cx="1269.43" cy="147.925" r="0.720943" transform="rotate(26.8111 1269.43 147.925)" fill="#B1CFF4"/>
                    <circle cx="1208.16" cy="151.422" r="0.720943" transform="rotate(26.8111 1208.16 151.422)" fill="#B1CFF4"/>
                    <circle cx="1191.59" cy="173.716" r="0.720943" transform="rotate(26.8111 1191.59 173.716)" fill="#B1CFF4"/>
                    <circle cx="1295.97" cy="212.96" r="0.720943" transform="rotate(26.8111 1295.97 212.96)" fill="#B1CFF4"/>
                    <circle cx="1106.65" cy="218.828" r="0.720943" transform="rotate(26.8111 1106.65 218.828)" fill="#B1CFF4"/>
                    <circle cx="1105.86" cy="169.018" r="0.720943" transform="rotate(26.8111 1105.86 169.018)" fill="#B1CFF4"/>
                    <circle cx="1123.68" cy="147.447" r="0.720943" transform="rotate(26.8111 1123.68 147.447)" fill="#B1CFF4"/>
                    <circle cx="1151.05" cy="152.622" r="0.720943" transform="rotate(26.8111 1151.05 152.622)" fill="#B1CFF4"/>
                    <circle cx="1047.8" cy="46.5067" r="0.720943" transform="rotate(26.8111 1047.8 46.5067)" fill="#B1CFF4"/>
                    <circle cx="1214.15" cy="277.544" r="0.720943" transform="rotate(26.8111 1214.15 277.544)" fill="#B1CFF4"/>
                    <path d="M1336.27 208.854L1336.41 211.349L1334.18 210.222L1336.27 208.854Z" fill="#B1CFF4"/>
                    <path d="M1321.56 275.116L1321.7 277.611L1319.47 276.484L1321.56 275.116Z" fill="#B1CFF4"/>
                    <path d="M650.195 740.507L651.217 742.277H649.174L650.195 740.507Z" fill="#B1CFF4"/>
                    <path d="M626.213 496.185L627.235 497.954H625.191L626.213 496.185Z" fill="#B1CFF4"/>
                    <path d="M163.219 440.497L163.469 441.427L164.399 441.677L163.469 441.927L163.219 442.857L162.969 441.927L162.039 441.677L162.969 441.427L163.219 440.497Z" fill="#B1CFF4"/>
                    <path d="M801.449 76.5127L801.7 77.4423L802.629 77.6925L801.7 77.9428L801.449 78.8724L801.199 77.9428L800.27 77.6925L801.199 77.4423L801.449 76.5127Z" fill="#B1CFF4"/>
                    <path d="M744.719 357.987L744.969 358.917L745.899 359.167L744.969 359.417L744.719 360.347L744.469 359.417L743.539 359.167L744.469 358.917L744.719 357.987Z" fill="#B1CFF4"/>
                    <path d="M1075.18 573.866L1075.43 574.796L1076.36 575.046L1075.43 575.296L1075.18 576.226L1074.93 575.296L1074 575.046L1074.93 574.796L1075.18 573.866Z" fill="#B1CFF4"/>
                    <path d="M273.551 33.9971L273.801 34.9266L274.731 35.1769L273.801 35.4272L273.551 36.3567L273.301 35.4272L272.371 35.1769L273.301 34.9266L273.551 33.9971Z" fill="#B1CFF4"/>
                    <path d="M26.7306 305.347L26.9809 306.276L27.9105 306.527L26.9809 306.777L26.7306 307.706L26.4803 306.777L25.5508 306.527L26.4803 306.276L26.7306 305.347Z" fill="#B1CFF4"/>
                    <path d="M1165.37 348.435L1165.62 349.364L1166.55 349.614L1165.62 349.865L1165.37 350.794L1165.12 349.865L1164.19 349.614L1165.12 349.364L1165.37 348.435Z" fill="#B1CFF4"/>
                    <path d="M310.09 732.528L310.34 733.458L311.27 733.708L310.34 733.958L310.09 734.888L309.84 733.958L308.91 733.708L309.84 733.458L310.09 732.528Z" fill="#B1CFF4"/>
                    <path d="M659.113 776.638L659.364 777.567L660.293 777.818L659.364 778.068L659.113 778.997L658.863 778.068L657.934 777.818L658.863 777.567L659.113 776.638Z" fill="#B1CFF4"/>
                    <path d="M570.791 486.097L571.041 487.026L571.971 487.277L571.041 487.527L570.791 488.456L570.541 487.527L569.611 487.277L570.541 487.026L570.791 486.097Z" fill="#B1CFF4"/>
                    <circle cx="868.352" cy="295.089" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1114.89" cy="362.187" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="1041.55" cy="265.82" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="738.926" cy="331.052" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="877.984" cy="238.201" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="876.299" cy="352.183" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="893.945" cy="426.441" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="838.361" cy="263.374" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1144.64" cy="260.468" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1133.13" cy="266.553" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="931.59" cy="290.899" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1133.61" cy="238.99" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="957.631" cy="402.302" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="763.976" cy="213.321" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="976.119" cy="381.865" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="995.262" cy="307.521" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="802.963" cy="388.053" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1084.41" cy="259.343" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1147.02" cy="216.209" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1031.87" cy="418.324" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1116.26" cy="277.53" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="956.982" cy="264.584" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1066.81" cy="381.612" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1155.87" cy="299.965" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1084.64" cy="365.561" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="558.615" cy="655.388" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="407.455" cy="670.418" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="503.998" cy="711.481" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="525.336" cy="688.315" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="430.01" cy="751.155" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="485.621" cy="666.311" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="465.974" cy="659.787" r="0.589675" fill="#B1CFF4"/>
                    <path d="M210.756 376.916L211.006 377.846L211.936 378.096L211.006 378.346L210.756 379.276L210.506 378.346L209.576 378.096L210.506 377.846L210.756 376.916Z" fill="#B1CFF4"/>
                    <path d="M348.742 509.075L348.993 510.005L349.922 510.255L348.993 510.505L348.742 511.435L348.492 510.505L347.562 510.255L348.492 510.005L348.742 509.075Z" fill="#B1CFF4"/>
                    <path d="M425.373 392.675L425.623 393.604L426.553 393.855L425.623 394.105L425.373 395.034L425.123 394.105L424.193 393.855L425.123 393.604L425.373 392.675Z" fill="#B1CFF4"/>
                    <path d="M440.815 715.672L441.065 716.602L441.994 716.852L441.065 717.102L440.815 718.032L440.564 717.102L439.635 716.852L440.564 716.602L440.815 715.672Z" fill="#B1CFF4"/>
                    <path d="M1216.27 462.425L1216.52 463.354L1217.45 463.605L1216.52 463.855L1216.27 464.784L1216.02 463.855L1215.09 463.605L1216.02 463.354L1216.27 462.425Z" fill="#B1CFF4"/>
                    <path d="M369.41 462.463L369.661 463.392L370.59 463.643L369.661 463.893L369.41 464.823L369.16 463.893L368.23 463.643L369.16 463.392L369.41 462.463Z" fill="#B1CFF4"/>
                    <path d="M390.006 779.601L390.256 780.53L391.186 780.78L390.256 781.031L390.006 781.96L389.756 781.031L388.826 780.78L389.756 780.53L390.006 779.601Z" fill="#B1CFF4"/>
                    <path d="M920.465 111.078L920.715 112.008L921.645 112.258L920.715 112.508L920.465 113.438L920.215 112.508L919.285 112.258L920.215 112.008L920.465 111.078Z" fill="#B1CFF4"/>
                    <circle cx="583.332" cy="610.428" r="0.589675" fill="#B1CFF4"/>
                    <path d="M483.656 651.8L483.907 652.729L484.836 652.98L483.907 653.23L483.656 654.159L483.406 653.23L482.477 652.98L483.406 652.729L483.656 651.8Z" fill="#B1CFF4"/>
                    <circle cx="433.174" cy="665.552" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="385.097" cy="684.987" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="402.922" cy="668.936" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="1060.22" cy="273.546" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="957.64" cy="208.624" r="0.589675" fill="#B1CFF4"/>
                    <path d="M897.32 249.669L898.342 251.439H896.299L897.32 249.669Z" fill="#B1CFF4"/>
                    <path d="M914.953 278.938L915.975 280.707H913.932L914.953 278.938Z" fill="#B1CFF4"/>
                    <path d="M952.76 394.128L953.782 395.898H951.738L952.76 394.128Z" fill="#B1CFF4"/>
                    <path d="M821.455 368.44L821.706 369.37L822.635 369.62L821.706 369.871L821.455 370.8L821.205 369.871L820.275 369.62L821.205 369.37L821.455 368.44Z" fill="#B1CFF4"/>
                    <path d="M853.598 220.56L853.848 221.489L854.778 221.739L853.848 221.99L853.598 222.919L853.348 221.99L852.418 221.739L853.348 221.489L853.598 220.56Z" fill="#B1CFF4"/>
                    <path d="M893.617 550.335L893.868 551.265L894.797 551.515L893.868 551.765L893.617 552.695L893.367 551.765L892.438 551.515L893.367 551.265L893.617 550.335Z" fill="#B1CFF4"/>
                    <path d="M1160.89 487.054L1161.14 487.983L1162.07 488.234L1161.14 488.484L1160.89 489.413L1160.64 488.484L1159.71 488.234L1160.64 487.983L1160.89 487.054Z" fill="#B1CFF4"/>
                    <path d="M385.385 308.291L385.635 309.22L386.565 309.471L385.635 309.721L385.385 310.65L385.135 309.721L384.205 309.471L385.135 309.22L385.385 308.291Z" fill="#B1CFF4"/>
                    <path d="M486.133 424.269L486.383 425.198L487.313 425.448L486.383 425.699L486.133 426.628L485.883 425.699L484.953 425.448L485.883 425.198L486.133 424.269Z" fill="#B1CFF4"/>
                    <path d="M633.819 95.6846L634.069 96.6141L634.998 96.8644L634.069 97.1147L633.819 98.0442L633.568 97.1147L632.639 96.8644L633.568 96.6141L633.819 95.6846Z" fill="#B1CFF4"/>
                    <circle cx="188.44" cy="230.43" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="170.402" cy="342.18" r="1.17984" fill="#B1CFF4"/>
                    <circle cx="117.812" cy="380.476" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="186.15" cy="390.357" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="249.381" cy="322.042" r="1.76951" fill="#B1CFF4"/>
                    <circle cx="153.476" cy="353.3" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="127.752" cy="346.587" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="147.963" cy="334.915" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="125.515" cy="406.371" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="125.791" cy="281.815" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="124.662" cy="234.668" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="247.635" cy="403.99" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="214.689" cy="293.834" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="255.5" cy="220.98" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="159.281" cy="375.077" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="204.404" cy="387.03" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="192.889" cy="394.296" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="241.402" cy="307.503" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="226.447" cy="310.999" r="0.589675" fill="#B1CFF4"/>
                    <circle cx="866.084" cy="455" r="3" fill="#B1CFF4"/>
                    <circle cx="279.884" cy="358.4" r="2.4" fill="#B1CFF4"/>
                    <circle cx="921.884" cy="260.001" r="2.4" fill="#B1CFF4"/>
                    <circle cx="626.684" cy="446" r="3.6" fill="#B1CFF4"/>
                    <circle cx="458.685" cy="374.001" r="2.4" fill="#B1CFF4"/>
                </g>

                <defs>
                    <clipPath id="clip0_7054_3839">
                        <rect width="1352.57" height="830.4" fill="white" transform="translate(0.287109 0.799805)"/>
                    </clipPath>
                </defs>     
            </svg>
        </div>

        <div class="banner-text">
            <h1>Chain</h1>
            <h4>Fortune</h4>
            <p><b>YOUR EASIEST WAY TO CRYPTO </b><br>
                At Chain Fortune, we believe in making crypto simple and accessible for everyone. Since 2018, our ultra-fast trading engine and a broad selection of tokens have empowered millions to explore the world of digital assets. As pioneers in financial services and blockchain technology, we are committed to simplifying crypto trading and unlocking its boundless possibilities.
            </p>
        </div>
    </section>

    <div class="about-top-bottom">
        <div class="wrapper">
            <div>
                <div class="icon">
                    <img src="/chain-fortune/images/journey.png" alt="">
                </div>
                <div class="text">
                    <h4>2018</h4>
                    <p>
                        When our journey began
                    </p>
                </div>
            </div>
            <div>
                <div class="icon">
                    <img src="/chain-fortune/images/country-region.png" alt="">
                </div>
                <div class="text">
                    <h4>170+</h4>
                    <p>
                    Countries and regions
                    </p>
                </div>
            </div>
            <div>
                <div class="icon">
                    <img src="/chain-fortune/images/users.png" alt="">
                </div>
                <div class="text">
                    <h4>30+ Million</h4>
                    <p>
                    Users worldwide
                    </p>
                </div>
            </div>
        </div>
    </div>



    <?php include("../components/index_footer.php"); ?>
    <script src="/chain-fortune/js/scroll_animation.js"></script>
</body>
</html>