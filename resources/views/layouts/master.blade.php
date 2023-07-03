<!DOCTYPE html>
<html lang="en">
<head>
    @include("layouts.header")
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <nav class="nav nav-pills nav-justified">
                           @yield("nav")
                        </nav>
                    </div>
                    <div class="card-body">
                        @yield("content")
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.footer")

  </body>
</html>