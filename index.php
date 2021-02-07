<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="theme-color" content="#7952b3">
        <meta name="author" content="Alesson Marques da Silva">
        <title>bbb-abstract</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
        
        <!-- Custom styles for this template -->
        <style>
            /*
            * Globals
            */


            /* Custom default button */
            .btn-secondary,
            .btn-secondary:hover,
            .btn-secondary:focus {
            color: #333;
            text-shadow: none; /* Prevent inheritance from `body` */
            }


            /*
            * Base structure
            */

            body {
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
            }

            .cover-container {
            max-width: 42em;
            }


            /*
            * Header
            */

            .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
            }

            .nav-masthead .nav-link:hover,
            .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
            }

            .nav-masthead .nav-link + .nav-link {
            margin-left: 1rem;
            }

            .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
            }


        </style>
    </head>

    <body class="d-flex h-100 text-center text-white bg-dark">

        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <div>
                    <span class="tp3"></span>
                    <nav class="nav nav-masthead justify-content-center float-md-end">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="getBigBrotherBrasilData.php">GET</a>
                        <a class="nav-link" href="putBigBrotherBrasilData.php">PUT</a>
                    </nav>
                </div>
            </header>

            <main class="px-3">
                <h1>bbb-abstract</h1>
                <p class="lead">An app to study web crawlers <br> with the hype of Big Brothers Brasil</p>
                <p class="lead">
                    <a href="https://github.com/alessonmarques/bbb-abstract" class="btn btn-lg btn-dark fw-bold border-white bg-dark">Know more on github.</a>
                </p>
            </main>

            <footer class="mt-auto text-white-50">
                <p>by <a href="https://twitter.com/a_lessonm" class="text-white">@a_lessonm</a>.</p>
            </footer>
        </div>

    </body>
    
</html>