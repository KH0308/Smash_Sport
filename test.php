<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src= "js/test.js"></script>
    <link rel="stylesheet" href="css/style3.css">
    <title>Pop up test</title>
</head>
<body>
    <button class="btnOpen">Try</button>
    <section class="box">
        <div class="close">&times;</div>
        <div class="circle">
            <span class="try-head"></span>
            <span class="try-body"></span>

        </div>

        <div class="try-box">
            <div>
                <input type="email" class="email" required="required">
                <label for="email">Email</label>
            </div>

            <div>
                <input type="text" class="first_name" required="required">
                <label for="first_name">First Name</label>
            </div>

            <div>
                <input type="text" class="last_name" required="required">
                <label for="last_name">Last Name</label>
            </div>

            <button class="btnSubmit">
                Submit
            </button>
        </div>
    </section>
</body>
</html>
