<html>
<head>
    <style type="text/css">
        .content {
            display: none;
        }
    </style>
    <script type="text/javascript">

        window.onload = function(){
            var links = document.getElementById('menu').getElementsByTagName('a'),
                divs = document.getElementsByTagName('div'),
                sections = [],
                id = '';

            for (var i = 0, size = divs.length; i < size; i++) {
                if (divs[i].className.indexOf('content') != -1) {
                    sections.push(divs[i]);
                }
            }

            for (var i = 0, size = links.length; i < size; i++) {
                id = links[i].href;
                id = id.substring(id.lastIndexOf('/') + 1);
                id = id.substring(0,id.indexOf('.'));

                links[i].rel = id;

                links[i].onclick = function(e){
                    e.preventDefault();

                    for (var p = 0, sections_size = sections.length; p < sections_size; p++) {
                        sections[p].style.display = 'none';
                    }

                    document.getElementById(this.rel).style.display = 'block';
                    location.hash = '#!/' + this.rel;

                    return false;
                }
            }

            document.getElementById('one').style.display = 'block';
        };

    </script>
</head>
<body>
<div id="menu">
    <ul>
        <li>
    <a href="home.html">Home</a> -
        </li>
        <li>
    <a href="one.html">One</a> -
        </li>
        <li>
    <a href="two.k">Two</a> -
        </li>
        <li>
    <a href="three.html">Thrkee</a>
        </li>
    </ul>
</div>
<div id="home" class="content">
    Home content.
</div>
<div id="one" class="content">
    One content.
</div>
<div id="two" class="content">
    Two content.
</div>
<div id="three" class="content">
    Three content.
</div>
</body>
</html>
