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
                    <a href="https://github.com/alessonmarques/bbb-abstract" class="btn btn-lg btn-dark fw-bold border-white bg-dark">
                        <svg height="32" class=" color-white text-white" viewBox="0 0 16 16" version="1.1" width="32" aria-hidden="true">
                            <path fill-rule="evenodd" fill="#fff" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                        </svg>
                        Know more on github.
                    </a>
                </p>
            </main>

            <footer class="mt-auto text-white-50">
                <p>by <a href="https://twitter.com/a_lessonm" class="text-white">@a_lessonm</a>.</p>
            </footer>
        </div>

    </body>
    
</html>