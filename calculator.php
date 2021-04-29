<!DOCTYPE html>

<html lang="pt-br">
<head>

    <meta charset="utf-8">

    <!--Styles-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../static/css/stylejs.css?<?php echo time(); ?>" media="screen" />

    <!--Java Script-->
    <script type="text/javascript" src="../brython/brython.js"></script>
    <script type="text/javascript" src="../brython/brython_stdlib.js"></script>

</head>

<body onload="brython()">
    <div class="row" style="font-size:12px">
        <div class="col s12 m3 push-m3">
            <h5 class="light"><center><b>Calculadora</b></center></h5>
            <center>
                <form>
                    <script type="text/python" >

                        from browser import document, html

                        # Construction de la calculatrice
                        calc = html.TABLE()
                        calc <= html.TR(html.TD(html.DIV("0", id="result", align="right"), colspan=3) + html.TD("C"))
                        lines = ["789/", "456*", "123-", "0.=+"]

                        calc <= (html.TR(html.TD(x) for x in line) for line in lines)
                        document <= calc

                        result = document["result"] # direct acces to an element by its id

                        def action(event):
                            """Handles the "click" event on a button of the calculator."""
                            # The element the user clicked on is the attribute "target" of the
                            # event object
                            element = event.target
                            # The text printed on the button is the element's "text" attribute
                            value = element.text
                            if value not in "=C":
                                # update the result zone
                                if result.text in ["0", "error"]:
                                    result.text = value
                                else:
                                    result.text = result.text + value
                            elif value == "C":
                                # reset
                                result.text = "0"
                            elif value == "=":
                                # execute the formula in result zone
                                try:
                                    result.text = eval(result.text)
                                except:
                                    result.text = "error"

                        # Associate function action() to the event "click" on all buttons
                        for button in document.select("td"):
                            button.bind("click", action)

                    </script>
                </form>
            </center>
        </div>
    </div>
</body>
</html>
