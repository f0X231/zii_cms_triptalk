<!DOCTYPE html>
<html>
<head>
    <title>Error 500: Server Don't response</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Fira+Code&display=swap");
        * {
          margin: 0;
          padding: 0;
          font-family: "Fira Code", monospace;
        }
        
        body {
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          height: 100vh;
          background-color: #ecf0f1;
        }
        
        .container {
          text-align: center;
          margin: auto;
          padding: 4em;
        }
        .container img {
          width: 256px;
          height: 225px;
        }
        .container h1 {
          margin-top: 1rem;
          font-size: 35px;
          text-align: center;
        }
        .container h1 span {
          font-size: 60px;
        }
        .container p {
          margin-top: 1rem;
        }
        .container p.info {
          margin-top: 4em;
          font-size: 12px;
        }
        .container p.info a {
          text-decoration: none;
          color: #5454ce;
        }
        </style>
</head>
<body>
    <div class="container">
        <img src="https://i.imgur.com/qIufhof.png" />
        <h1><span>{{ __('pagesError.500.code') }}</span><br />{{ __('pagesError.500.error') }}</h1>
        <p>{{ __('pagesError.500.desc') }}</p>
    </div>
</body>
</html>
