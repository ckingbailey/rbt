<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    body {
      text-align: center;
    }
    #app {
      display: inline-block;
    }
    </style>
  </head>
  <body>
    <div id="app">
      <form id="form">
        <select id="dropdown">
          <option>Option 1</option>
          <option>Option 2</option>
        </select>
      </form>
    </div>
    <script>
    var form = document.getElementById('form')
    var dd = document.getElementById('dropdown')
    var picInput = document.createElement('input')
    dd.addEventListener('change', event => {
      if (event.target.value === 'Option 1' &&
        !Array.from(form.children).includes(picInput)) {
        form.appendChild(picInput)
      } else if (Array.from(form.children).includes(picInput)) {
        form.removeChild(picInput)
      }
    })
    </script>
  </body>
</html>