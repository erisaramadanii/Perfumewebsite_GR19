<?php
if (!isset($_COOKIE['cookie_consent'])):
?>
<style>
#cookie-modal {
    position: fixed;
    bottom: 20px;
    left: 20px;
    width: 350px;
    background-color: white;
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    font-family: Arial, sans-serif;
    border-radius: 8px;
}
#cookie-modal p {
    font-size: 14px;
    margin-bottom: 15px;
}
#cookie-modal button {
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    font-size: 14px;
}
#accept-btn {
    background-color: #4CAF50;
    color: white;
    margin-right: 10px;
}
#reject-btn {
    background-color: #f44336;
    color: white;
}
#cookie-modal a {
    color: #007BFF;
    text-decoration: none;
}
</style>

<div id="cookie-modal">
    <p>Ne përdorim cookies dhe teknologji të ngjashme për të ofruar shërbime dhe përmirësuar përvojën tuaj në <strong>Jean Paul Gaultier</strong>. 
        <a href="privacy.php" target="_blank">Lexo Politikën e Privatësisë</a>.
    </p>
    <button id="accept-btn" onclick="setCookieConsent('accepted')">Prano të gjitha</button>
    <button id="reject-btn" onclick="setCookieConsent('rejected')">Refuzo të gjitha</button>
</div>

<script>
function setCookieConsent(value) {
    document.cookie = "cookie_consent=" + value + "; path=/; max-age=" + (60 * 60 * 24 * 30);
    document.getElementById('cookie-modal').style.display = 'none';
}
</script>
<?php endif; ?>
