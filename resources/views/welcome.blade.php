<!DOCTYPE html>
<html>
<title>HOME</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1 {font-family: "Rubik", sans-serif}
body, html {height: 100%}
.bgimg {
  background-image: url({{ asset('res/homescreen2.jpg')}});
  min-height: 100%;
  background-position: center;
  background-size: cover;
}
a {text-decoration: none;}
a:hover {
  color: hotpink;
}
</style>
<body>

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top">Data penyebaran Covid-19</h1>
	  <hr class="w3-border-grey" style="margin:auto;width:40%">
	  <div class="w3-large w3-center tes">
		  <h2><a href="/datacovid19">LIHAT PENYEBARAN</a></h2>
  	</div>
  </div>
  <div class="w3-display-bottommiddle w3-padding-large" style='text-align:center;'>
    <h4>Made By<br>Muhammad Rizky Yusfian Yusuf</h4>
  </div>
</div>

</body>
</html>
