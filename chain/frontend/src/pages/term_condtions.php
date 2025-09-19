<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions | Chain Fortune</title>
    <link rel="icon" type="image/png" href="/chain-fortune/images/logo/logo_2.png">
    <link rel="stylesheet" href="../styles/config/config.css">
    <link rel="stylesheet" href="../styles//colors/colors.css">
    <link rel="stylesheet" href="/chain-fortune../styles/style.css">  

    <style>

    </style>
    
</head>


<body>
    <?php include("../components/page_refresh_loader.php"); ?>

    <div class="terms-container">
        <h1>Terms and Conditions</h1>
        <p><strong>Last Updated:</strong> [Insert Date]</p>

        <p>Welcome to <em>Chain Fortune</em>! These Terms and Conditions ("Terms") govern your access to and use of the <em>Chain Fortune</em> website and services. By accessing or using our platform, you agree to comply with and be bound by these Terms. Please read them carefully before engaging in any activity on our site.</p>

        <div class="section">
            <h2>1. Acceptance of Terms</h2>
            <p>By registering, accessing, or using <em>Chain Fortune</em>, you confirm that you have read, understood, and agree to these Terms, as well as our Privacy Policy. If you do not agree, you must discontinue using our services immediately.</p>
        </div>

        <div class="section">
            <h2>2. Eligibility</h2>
            <ul>
                <li>You must be at least 18 years of age to use our platform.</li>
                <li>By using our services, you represent and warrant that you have the legal capacity to enter into these Terms.</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. Services Offered</h2>
            <p><em>Chain Fortune</em> provides investment opportunities in cryptocurrencies. Our services include:</p>
            <ul>
                <li>Various investment plans tailored to different risk levels and preferences.</li>
                <li>Real-time portfolio monitoring and management tools.</li>
                <li>Secure cryptocurrency wallet integration.</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. Investment Disclaimer</h2>
            <ul>
                <li><strong>Risk of Loss:</strong> Cryptocurrency investments carry inherent risks, including market volatility and the potential for significant financial loss. You acknowledge that you are solely responsible for your investment decisions.</li>
                <li><em>Chain Fortune</em> does not guarantee any specific return on investment (ROI).</li>
                <li>Past performance does not indicate future results.</li>
            </ul>
        </div>

        <div class="section">
            <h2>5. Account Registration</h2>
            <ul>
                <li>To use our services, you must create an account by providing accurate and complete information.</li>
                <li>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</li>
                <li>Notify us immediately of any unauthorized use of your account.</li>
            </ul>
        </div>

        <div class="section">
            <h2>6. Payment and Fees</h2>
            <ul>
                <li>All payments made on <em>Chain Fortune</em> are processed securely.</li>
                <li>You agree to pay any applicable fees as outlined in your chosen investment plan.</li>
                <li><em>Chain Fortune</em> reserves the right to update fees at any time. Users will be notified in advance of such changes.</li>
            </ul>
        </div>

        <div class="section">
            <h2>7. Prohibited Activities</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Engage in illegal or fraudulent activities.</li>
                <li>Use our platform for unauthorized purposes, such as money laundering or terrorist financing.</li>
                <li>Interfere with the functionality of our website or services.</li>
            </ul>
        </div>

        <div class="section">
            <h2>8. Termination of Service</h2>
            <p><em>Chain Fortune</em> reserves the right to suspend or terminate your account at our sole discretion if:</p>
            <ul>
                <li>You violate these Terms.</li>
                <li>We suspect fraudulent or malicious activity associated with your account.</li>
                <li>Your account remains inactive for an extended period.</li>
            </ul>
        </div>

        <div class="section">
            <h2>9. Intellectual Property</h2>
            <ul>
                <li>All content on <em>Chain Fortune</em>, including text, graphics, logos, and software, is the property of <em>Chain Fortune</em> or its licensors.</li>
                <li>You may not copy, reproduce, or distribute any content without prior written consent.</li>
            </ul>
        </div>

        <div class="section">
            <h2>10. Limitation of Liability</h2>
            <ul>
                <li><em>Chain Fortune</em> shall not be liable for any direct, indirect, incidental, or consequential damages arising out of your use of our services.</li>
                <li>We do not assume responsibility for third-party actions or services linked to our platform.</li>
            </ul>
        </div>

        <div class="section">
            <h2>11. Privacy Policy</h2>
            <p>Your privacy is important to us. Please review our Privacy Policy to understand how we collect, use, and safeguard your information.</p>
        </div>

        <div class="section">
            <h2>12. Changes to Terms</h2>
            <ul>
                <li><em>Chain Fortune</em> reserves the right to update these Terms at any time.</li>
                <li>Any changes will be effective immediately upon posting on our website. Continued use of our platform signifies acceptance of the updated Terms.</li>
            </ul>
        </div>

        <div class="section">
            <h2>13. Governing Law</h2>
            <p>These Terms are governed by the laws of [Insert Jurisdiction]. Any disputes shall be resolved in the courts of [Insert Jurisdiction].</p>
        </div>

        <div class="contact-info">
            <h2>14. Contact Us</h2>
            <p>If you have any questions about these Terms, please contact us at:</p>
            <p><strong>Chain Fortune Support</strong><br>
            Email: <a href="mailto:support@chainfortune.com">support@chainfortune.com</a><br>
            Phone: [Insert Phone Number]</p>
        </div>

        <p>By using <em>Chain Fortune</em>, you acknowledge that you have read, understood, and agree to these Terms and Conditions.</p>
    </div>
    <?php 
        $buttonOutlinedText = "GO BACK";
        $buttonOutlinedHref = "#";
    ?>
     
    <div style="font-size: 14px;" id="go_back"> <?php include "../components/button_outlined.php"; ?></div>

    <script>
        document.getElementById('go_back').addEventListener('click', function () {
            window.history.back();
        });
    </script>
        <script>
            const Styles = `

                * {
                    font-family: var(--index-font);
                }

                body {
                    background-color: var(--base-clr);
                    color: var(--text-clr);
                    line-height: 1.6;
                    padding: 20px;
                    max-width: 100%;
                    overflow-x: hidden;
                    flex-direction: column;
                }

                h1, h2 {
                    color: var(--accent-clr);
                    margin-bottom: 15px;
                }

                h1 {
                    font-size: 24px;
                    text-align: center;
                    padding-bottom: 10px;
                    border-bottom: 1px solid var(--line-clr);
                    width: 100%;

                }

                h2 {
                    font-size: 20px;
                    margin-top: 30px;
                }

                p, ul {
                    margin-bottom: 15px;
                }

                ul {
                    padding-left: 20px;
                }

                li {
                    margin-bottom: 10px;
                    list-style-type: disc;
                }

                hr {
                    border: none;
                    border-top: 1px solid var(--line-clr);
                    margin: 20px 0;
                }

                a {
                    color: var(--accent-clr);
                    text-decoration: none;
                }



                strong {
                    color: var(--accent-clr);
                }

                em {
                    font-style: italic;
                    color: var(--secondary-text-clr);
                }

                .terms-container {
                    margin: 0 auto;
                    background-color: var(--hover-clr);
                    border-radius: 10px;
                    padding: 20px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    flex-direction: column;
                }

                .section {
                    background-color: var(--base-clr);
                    border-radius: 8px;
                    padding: 15px;
                    margin-bottom: 20px;
                    width: 100%;
                }

                .contact-info {
                    background-color: var(--hover-clr);
                    border-radius: 8px;
                    padding: 13px;
                    margin-top: 20px;
                    width: 100%;

                }
                #go_back{
                    position: fixed;
                    z-index: 20;
                    bottom: 30px;
                    right: 30px;
                }

                @media (max-width: 600px) {
                    body {
                        padding: 10px;
                    }

                    h1 {
                        font-size: 22px;
                    }

                    h2 {
                        font-size: 18px;
                    }
                }
            `
            const css = document.createElement('style');
            css.appendChild(document.createTextNode(Styles));
            document.head.appendChild(css);
        </script>
</body>
</html>  