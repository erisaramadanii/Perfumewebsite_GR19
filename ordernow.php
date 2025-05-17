
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Now</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
            position: relative;
            background-image: url('https://ascotcosmetics.co.za/wp-content/uploads/2023/09/Jean-Paul-Gaultier-Divine-5.jpg');
            background-size: cover; 
            background-position: center center;
            background-repeat: no-repeat;
            height: 100vh; 
            margin: 0;
        }
        .order-form {
            max-width: 900px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9); /* Përdorim një ngjyrë të bardhë me transparencë për të krijuar kontrast */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-top: 5px solid #d4af37;  /* Gold color */
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .tagline {
            font-size: 20px;
            font-style: italic;
            text-align: center;
            color: #d4af37;  /* Gold color for the tagline */
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #d4af37;  /* Gold color for the button */
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #c3a434;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border: 1px solid #c3e6cb;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-group div {
            flex: 1 1 calc(50% - 20px);
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .form-group div {
                flex: 1 1 100%;
            }
        }
    </style>
    <script>
        // JavaScript for form validation
        function validateForm() {
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const zipcode = document.getElementById('zipcode').value;

            // Check if phone number is valid (basic check)
            const phoneRegex = /^[0-9]{9,15}$/;
            if (!phoneRegex.test(phone)) {
                alert("Please enter a valid phone number (9-15 digits).");
                return false;
            }

            // Check if email is valid
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Check if zipcode is valid (basic check)
            const zipRegex = /^[0-9]{5,10}$/;
            if (!zipRegex.test(zipcode)) {
                alert("Please enter a valid postal code.");
                return false;
            }

            return true; // Submit form if everything is valid
        }
    </script>
</head>
<body>

<div class="order-form">
    <h2>Order Now</h2>
    <p class="tagline">The fragrance you're ordering will become part of your unique style.</p>

   <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Perfumewebsite_GR19-main/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/Perfumewebsite_GR19-main/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/Perfumewebsite_GR19-main/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $country = htmlspecialchars($_POST['country']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $zipcode = htmlspecialchars($_POST['zipcode']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $payment_method = htmlspecialchars($_POST['payment_method']);
    $delivery_method = htmlspecialchars($_POST['delivery_method']);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = 'erisaramadani20@gmail.com';
        $mail->Password = 'hhed ncxu zvxa cnit'; // Replace me App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('erisaramadani20@gmail.com', 'Order System');
        $mail->addAddress($email, "$first_name $last_name");
        $mail->addReplyTo('erisaramadani20@gmail.com', 'Order System');

        $mail->isHTML(true);
$mail->Subject = 'Order Confirmation';
$mail->Body = "
    <h2>Thank you for your order, $first_name $last_name!</h2>
    <p>We have received your order and will contact you soon when your order arrives.</p>
    <hr>
    <h3>Order Summary:</h3>
    <ul>
        <li><strong>Email:</strong> $email</li>
        <li><strong>Phone:</strong> $phone</li>
        <li><strong>Address:</strong> $address, $city, $zipcode, $country</li>
        <li><strong>Payment Method:</strong> $payment_method</li>
        <li><strong>Delivery Method:</strong> $delivery_method</li>
    </ul>
    <p>We appreciate your trust in us.</p>
    <br>
    <p>Kind regards,<br><strong>Jean Paul Gaultier Store Team</strong></p>
";

        $mail->send();
        echo "<div class='success'>Confirmation email sent successfully!</div>";
    } catch (Exception $e) {
        echo "<div class='error'>Email could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
    }

    // Mesazhi që i shfaqet në faqe
    echo "<div class='success'>
            Thank you, $first_name $last_name! Your order has been received.<br>
            <strong>Email:</strong> $email <br>
            <strong>Phone Number:</strong> $phone <br>
            <strong>Address:</strong> $address, $city, $country, $zipcode <br>
            <strong>Payment Method:</strong> $payment_method <br>
            <strong>Delivery Service:</strong> $delivery_method <br>
          </div>";
} else {
?>

    
    <form method="POST" action="ordernow.php" onsubmit="return validateForm()">
        <div class="form-group">
            <div>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div>
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
        </div>

        <label for="country">Country:</label>
        <select id="country" name="country" required>
            <option value="Kosovo">Kosovo</option>
            <option value="Albania">Albania</option>
            <option value="France">France</option>
            <option value="Georgia">Georgia</option>
            <option value="Germany">Germany</option>
            <option value="Greece">Greece</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="Ireland">Ireland</option>
            <option value="Italy">Italy</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kosovo">Kosovo</option>
           
        </select>

        <label for="address">Full Address:</label>
        <textarea id="address" name="address" required></textarea>

        <div class="form-group">
            <div>
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div>
                <label for="zipcode">Postal Code:</label>
                <input type="text" id="zipcode" name="zipcode" required>
            </div>
        </div>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="Credit/Debit Card">Credit/Debit Card</option>
            <option value="PayPal">PayPal</option>
            <option value="Bank Transfer">Bank Transfer</option>
        </select>

        <label for="delivery_method">Delivery Service:</label>
        <select id="delivery_method" name="delivery_method" required>
            <option value="Standard">Standard</option>
            <option value="Express">Express</option>
        </select>

        <input type="submit" value="Submit Order">
    </form>
    <?php } ?>
</div>

</body>
</html>
