<!DOCTYPE html>
<html>

<head>
    <title>Adding image to dropdown list</title>
    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <center>
        <h1 style="color: green">GeeksforGeeks</h1>

        <div class="dropdown">
            <button class="dropbtn" id="dropbtn">
                <img id="selectedFlag" src="https://media.geeksforgeeks.org/wp-content/uploads/20200630132503/iflag.jpg" width="20" height="15">
                India
            </button>

            <div class="dropdown-content">
                <a href="#" onclick="changeFlag('India', 'https://media.geeksforgeeks.org/wp-content/uploads/20200630132503/iflag.jpg')">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20200630132503/iflag.jpg" width="20" height="15"> India
                </a>
                <a href="#" onclick="changeFlag('USA', 'https://media.geeksforgeeks.org/wp-content/uploads/20200630132504/uflag.jpg')">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20200630132504/uflag.jpg" width="20" height="15"> USA
                </a>
                <a href="#" onclick="changeFlag('England', 'https://media.geeksforgeeks.org/wp-content/uploads/20200630132502/eflag.jpg')">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20200630132502/eflag.jpg" width="20" height="15"> England
                </a>
                <a href="#" onclick="changeFlag('Brazil', 'https://media.geeksforgeeks.org/wp-content/uploads/20200630132500/bflag.jpg')">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20200630132500/bflag.jpg" width="20" height="15"> Brazil
                </a>
            </div>
        </div>
    </center>

    <script>
        function changeFlag(country, flagUrl) {
            document.getElementById("dropbtn").innerHTML = `<img id="selectedFlag" src="${flagUrl}" width="20" height="15"> ${country}`;
        }
    </script>
</body>

</html>