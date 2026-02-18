<?php
// size_guide.php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Size Guide - AMMS</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container">
            <a href="index.php" class="logo">AMMS</a>
            <nav>
                <a href="index.php">Home</a>
                <a href="products.php">Shop</a>
                <a href="about.php">About</a>
            </nav>
        </div>
    </header>

    <main class="container" style="padding:60px 20px;max-width:900px;margin:60px auto;">
        <h2>Size Guide</h2>
        <p style="color:var(--text-light);max-width:650px;">
            Use this guide to find your best fit. Measurements are in centimetres and refer to body measurements, not the
            garment itself.
        </p>

        <section style="margin-top:30px;">
            <h3>Women's Tops & Dresses</h3>
            <table>
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>SA/UK</th>
                        <th>Bust</th>
                        <th>Waist</th>
                        <th>Hip</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>XS</td>
                        <td>30</td>
                        <td>78–82</td>
                        <td>60–64</td>
                        <td>84–88</td>
                    </tr>
                    <tr>
                        <td>S</td>
                        <td>32</td>
                        <td>82–86</td>
                        <td>64–68</td>
                        <td>88–92</td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>34–36</td>
                        <td>86–94</td>
                        <td>68–76</td>
                        <td>92–100</td>
                    </tr>
                    <tr>
                        <td>L</td>
                        <td>38–40</td>
                        <td>94–102</td>
                        <td>76–84</td>
                        <td>100–108</td>
                    </tr>
                    <tr>
                        <td>XL</td>
                        <td>42–44</td>
                        <td>102–110</td>
                        <td>84–92</td>
                        <td>108–116</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section style="margin-top:30px;">
            <h3>Men's Tops</h3>
            <table>
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Chest</th>
                        <th>Waist</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>S</td>
                        <td>88–94</td>
                        <td>76–82</td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>94–100</td>
                        <td>82–88</td>
                    </tr>
                    <tr>
                        <td>L</td>
                        <td>100–106</td>
                        <td>88–94</td>
                    </tr>
                    <tr>
                        <td>XL</td>
                        <td>106–112</td>
                        <td>94–100</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section style="margin-top:30px;">
            <h3>How to Measure</h3>
            <ul>
                <li><strong>Bust / Chest</strong> – Measure around the fullest part, keeping the tape horizontal.</li>
                <li><strong>Waist</strong> – Measure around the narrowest part of your waist.</li>
                <li><strong>Hip</strong> – Measure around the fullest part of your hips.</li>
            </ul>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> AMMS. Power in Simplicity.</p>
            </div>
        </div>
    </footer>
</body>

</html>

