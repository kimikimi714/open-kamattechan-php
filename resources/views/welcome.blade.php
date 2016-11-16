<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://unpkg.com/vue/dist/vue.js"></script>
        <title>Laravel</title>
    </head>
    <body>
    @verbatim
        <div class="container">
            Hello, {{ name }}.
        </div>
    @endverbatim

<script>
var app = new Vue({
  el: '.container',
  data: {
    name: 'Vue'
  }
})
</script>

    </body>
</html>
