<!doctype html>
<html>
<head>
    <title>Applicant Cabinet</title>
    <style>
        .logout-link {
            background: none;
            border: none;
            color: blue; /* Link color */
            text-decoration: underline; /* Underline for link style */
            cursor: pointer; /* Pointer cursor for better UX */
            font: inherit; /* Inherit font styles from parent */
        }
    </style>
</head>
<body>
    <p>This is applicant cabinet</p>
    <p>First Name and Last Name: <?php echo $applicant["firstname"] . " " . $applicant["lastname"]; ?></p>
    <form action="/logout/" method="GET" style="display: inline; ">
        <button type="submit">Logout</button>
    </form>
</body>
</html>